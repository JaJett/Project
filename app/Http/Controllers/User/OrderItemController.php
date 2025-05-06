<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderItemController extends Controller
{
    public function index()
    {
        $items = OrderItem::with('order.user', 'menu')->latest()->get();
        return view('user.order_items.index', compact('items'));
    }

    public function show(OrderItem $orderItem)
    {
        $orderItem->load('order.user', 'menu');
        return view('user.order_items.show', compact('orderItem'));
    }

    public function print(OrderItem $orderItem)
    {
        $orderItem->load('order', 'menu');

        $pdf = Pdf::loadView('user.order_items.receipt', compact('orderItem'));
        return $pdf->stream('struk_pesanan.pdf');
    }

    public function create()
    {
        $menus = Menu::all();

        // Cari order draft terakhir milik user
        $order = Order::where('user_id', auth()->id())
                        ->where('status', 'menunggu')
                        ->latest()
                        ->first();

        // Jika belum ada, buat order baru
        if (!$order) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'pickup_date' => now(), // Bisa diubah oleh user nanti
                'status' => 'draft',
            ]);
        }

        return view('user.order_items.create', compact('menus', 'order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'order_id' => 'required|exists:orders,id',
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        OrderItem::create([
            'order_id' => $request->order_id,
            'menu_id' => $menu->id,
            'quantity' => $request->quantity,
            'price' => $menu->price,
            'subtotal' => $menu->price * $request->quantity,
        ]);

        return redirect()->route('user.order-items.create')->with('success', 'Item berhasil ditambahkan.');
    }

}
