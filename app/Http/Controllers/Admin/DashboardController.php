<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Order;




class DashboardController extends Controller
{
        public function index(Request $request)
        {
            $month = $request->input('month');

            $orders = Order::where('status', 'selesai')
                ->when($month, fn($q) => $q->whereMonth('pickup_date', $month))
                ->whereYear('pickup_date', now()->year)
                ->with('items')
                ->get();

            $totalMenus = Menu::count();
            $totalUsers = User::count();
            $totalAdmins = User::where('role', 'admin')->count();

            $totalPenjualan = $orders->flatMap->items->sum(fn($item) => $item->price * $item->quantity);

            $penjualanHarian = $orders->groupBy(function ($order) {
                return $order->pickup_date->format('Y-m-d');
            })->map(function ($orders) {
                return $orders->flatMap->items->sum(fn($item) => $item->price * $item->quantity);
            });

            $pendapatanBulanan = Order::where('status', 'selesai')
                ->whereYear('pickup_date', now()->year)
                ->get()
                ->groupBy(function ($order) {
                    return \Carbon\Carbon::parse($order->pickup_date)->format('F');
                })
                ->map(function ($orders) {
                    return $orders->flatMap->items->sum(fn($item) => $item->price * $item->quantity);
                });

            $menuTerlaris = OrderItem::with('menu')
                ->whereHas('order', fn($q) =>
                    $q->where('status', 'selesai')
                    ->when($month, fn($q) => $q->whereMonth('pickup_date', $month))
                )
                ->selectRaw('menu_id, SUM(quantity) as total')
                ->groupBy('menu_id')
                ->orderByDesc('total')
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'totalMenus',
                'totalUsers',
                'totalAdmins',
                'totalPenjualan',
                'penjualanHarian',
                'pendapatanBulanan',
                'menuTerlaris'
            ));
        }

    public function salesReport(Request $request)
    {
        $query = OrderItem::with(['order', 'menu'])
            ->whereHas('order', function ($q) {
                $q->where('status', 'selesai');
            });

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('pickup_date', [$request->from, $request->to]);
        } elseif ($request->filled('from')) {
            $query->whereDate('pickup_date', $request->from);
        }

        if ($request->filled('menu_id')) {
            $query->where('menu_id', $request->menu_id);
        }

        $items = $query->latest()->get();
        $totalPendapatan = $items->sum(fn($item) => $item->price * $item->quantity);
        $menus = \App\Models\Menu::orderBy('name')->get();

        return view('admin.reports.sales', compact('items', 'totalPendapatan', 'menus'));
    }

    public function salesReportPrint()
    {
        $items = OrderItem::with('order', 'menu')->latest()->get();
        return view('admin.reports.sales-print', compact('items'));
    }

}
