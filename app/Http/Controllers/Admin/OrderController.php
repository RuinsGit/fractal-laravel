<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderProducts.product'])
            ->latest()
            ->get();
        return view('back.pages.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderProducts.product']);
        return view('back.pages.order.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sifariş statusu uğurla yeniləndi.'
        ]);
    }

    public function destroy(Order $order)
    {
        $order->orderProducts()->delete();
        $order->delete();

        return redirect()->route('admin.order.index')
            ->with('success', 'Sifariş uğurla silindi.');
    }
}
