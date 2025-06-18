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

    $totalPenjualan = Order::where('status', 'selesai')
        ->with('items')
        ->get()
        ->flatMap(function ($order) {
            return $order->items;
        })
        ->sum(function ($item) {
            return $item->price * $item->quantity;
        });

    $latestMenus = Menu::latest()->take(5)->get();

    $penjualanHarian = Order::where('status', 'selesai')
        ->whereBetween('pickup_date', [now()->subDays(30)->startOfDay(), now()->endOfDay()])
        ->with('items')
        ->get()
        ->groupBy(function ($order) {
            return $order->pickup_date->format('Y-m-d');
        })
        ->map(function ($orders) {
            return $orders->flatMap->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
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
        'latestMenus',
        'penjualanHarian',
        'pendapatanBulanan',
        'menuTerlaris'
    ));
}


}
