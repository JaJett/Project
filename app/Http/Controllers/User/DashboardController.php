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

        return view('user.dashboard', compact('latestOrderItem'));

    }
}
