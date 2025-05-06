<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.menu')->latest()->get();
        return view('user.orders.index', compact('orders'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('user.orders.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'pickup_date' => 'required|date',
            'menus' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name,
                'customer_address' => $request->customer_address,
                'customer_phone' => $request->customer_phone,
                'pickup_date' => $request->pickup_date,
                'status' => 'menunggu',
                'total_price' => 0,
            ]);

            $total = 0;

            foreach ($request->menus as $menuId => $quantity) {
                if ($quantity < 1) continue;

                $menu = Menu::find($menuId);
                if (!$menu) continue;

                $subtotal = $menu->price * $quantity;
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $quantity,
                    'price' => $menu->price,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $order->update(['total_price' => $total]);
        });

        return redirect()->route('user.orders.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function edit($id)
    {
        $order = Order::where('user_id', auth()->id())->with('items')->findOrFail($id);
        $menus = \App\Models\Menu::all();
        return view('user.orders.edit', compact('order', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'pickup_date' => 'required|date',
            'menus' => 'required|array',
        ]);

        DB::transaction(function () use ($request, $id) {
            $order = Order::where('user_id', auth()->id())->findOrFail($id);
            $order->items()->delete(); // hapus item lama

            $total = 0;

            foreach ($request->menus as $menuId => $qty) {
                if ($qty < 1) continue;
                $menu = \App\Models\Menu::find($menuId);
                if (!$menu) continue;

                $subtotal = $menu->price * $qty;
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menuId,
                    'quantity' => $qty,
                    'price' => $menu->price,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $order->update([
                'pickup_date' => $request->pickup_date,
                'total_price' => $total
            ]);
        });

        return redirect()->route('user.orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Pastikan hanya pemilik pesanan yang bisa mengubah
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:menunggu,diproses,siap,selesai,dibatalkan',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('user.orders.index')->with('success', 'Status pesanan diperbarui.');
    }

    public function destroy($id)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($id);

        // Hapus semua item terkait dulu (jika pakai foreign key constraints, ini wajib)
        $order->items()->delete();

        $order->delete();

        return redirect()->route('user.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    // OrderController.php
    public function print(Order $order)
    {
        $order->load('items.menu'); // pastikan relasi sudah dimuat
        $pdf = Pdf::loadView('user.orders.receipt', compact('order'));
        return $pdf->download('struk-' . $order->id . '.pdf');
    }

}
