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
    public function index()
    {
        $totalMenus = Menu::count();
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();

        // Ambil total penjualan dari order yang statusnya selesai
        $totalPenjualan = Order::where('status', 'selesai')
            ->with('items') // eager loading
            ->get()
            ->flatMap(function ($order) {
                return $order->items;
            })
            ->sum(function ($item) {
                return $item->price * $item->quantity;
            });

        // Ambil 5 menu terbaru
        $latestMenus = Menu::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalMenus',
            'totalUsers',
            'totalAdmins',
            'totalPenjualan',
            'latestMenus'
        ));
    }

    public function salesReport(Request $request)
    {
        $query = OrderItem::with(['order', 'menu'])
            ->whereHas('order', function ($q) {
                $q->where('status', 'selesai');
            });

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        } elseif ($request->filled('from')) {
            $query->whereDate('created_at', $request->from);
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

    public function statistics()
    {
        // Penjualan per hari (7 hari terakhir)
        $penjualanHarian = Order::where('status', 'selesai')
            ->whereDate('created_at', '>=', now()->subDays(6))
            ->get()
            ->groupBy(function ($order) {
                return $order->created_at->format('Y-m-d');
            })->map(function ($orders) {
                return $orders->flatMap->items->sum(function ($item) {
                    return $item->price * $item->quantity;
                });
            });

        // Menu terlaris
        $menuTerlaris = OrderItem::whereHas('order', function ($query) {
                $query->where('status', 'selesai');
            })
            ->selectRaw('menu_id, SUM(quantity) as total')
            ->groupBy('menu_id')
            ->with('menu')
            ->orderByDesc('total')
            ->take(5)
            ->get();


        // Aktivitas kasir
        $aktivitasKasir = Order::where('status', 'selesai')
            ->with('user')
            ->get()
            ->groupBy('user_id')
            ->map(function ($orders, $userId) {
                return [
                    'nama' => $orders->first()->user->name ?? 'Tidak Diketahui',
                    'jumlah_transaksi' => $orders->count(),
                ];
            });

        return view('admin.statistics.index', compact('penjualanHarian', 'menuTerlaris', 'aktivitasKasir'));
    }

}
