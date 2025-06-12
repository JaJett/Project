<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    public function index()
    {

        $latestOrderItem = OrderItem::with('order.user', 'menu')
        ->whereHas('order', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->latest()
        ->first();

        $totalProdukTerjual = OrderItem::whereHas('order', function ($q) {
            $q->where('user_id', auth()->id());
        })->sum('quantity');

        $totalKeuntungan = OrderItem::whereHas('order', function ($q) {
            $q->where('user_id', auth()->id());
        })->join('menus', 'order_items.menu_id', '=', 'menus.id')
          ->selectRaw('SUM(order_items.quantity * menus.price) as total')
          ->value('total');

        return view('user.dashboard', compact('latestOrderItem', 'totalProdukTerjual', 'totalKeuntungan'));
    }
}
