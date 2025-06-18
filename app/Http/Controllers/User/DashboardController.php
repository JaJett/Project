<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    public function index()
{
    $userId = auth()->id();

    $latestOrderItem = OrderItem::with('order.user', 'menu')
        ->whereHas('order', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
        ->latest()
        ->first();

    $totalProdukTerjual = OrderItem::whereHas('order', function ($q) use ($userId) {
        $q->where('user_id', $userId)
          ->where('status', 'selesai');
    })->sum('quantity');

    $totalKeuntungan = OrderItem::whereHas('order', function ($q) use ($userId) {
        $q->where('user_id', $userId)
          ->where('status', 'selesai');
    })->join('menus', 'order_items.menu_id', '=', 'menus.id')
      ->selectRaw('SUM(order_items.quantity * menus.price) as total')
      ->value('total');

    // 👉 Jumlah Pesanan Hari Ini
    $jumlahPesananHariIni = \App\Models\Order::where('user_id', $userId)
        ->whereDate('created_at', today())
        ->count();

    // 👉 Produk Terlaris
    $produkTerlaris = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->join('menus', 'order_items.menu_id', '=', 'menus.id')
        ->where('orders.user_id', $userId)
        ->where('orders.status', 'selesai')
        ->select('menus.name as nama', \DB::raw('SUM(order_items.quantity) as jumlah'))
        ->groupBy('menus.name')
        ->orderByDesc('jumlah')
        ->first();

    // 👉 Pendapatan Hari Ini
    $pendapatanHariIni = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->join('menus', 'order_items.menu_id', '=', 'menus.id')
        ->where('orders.user_id', $userId)
        ->where('orders.status', 'selesai')
        ->whereDate('orders.created_at', today())
        ->selectRaw('SUM(order_items.quantity * menus.price) as total')
        ->value('total');

    $pesananBelumSelesai = \App\Models\Order::where('user_id', $userId)
    ->where('status', '!=', 'selesai')
    ->count();



    return view('user.dashboard', compact(
        'latestOrderItem',
        'totalProdukTerjual',
        'totalKeuntungan',
        'jumlahPesananHariIni',
        'produkTerlaris',
        'pendapatanHariIni',
        'pesananBelumSelesai'

    ));
}

}
