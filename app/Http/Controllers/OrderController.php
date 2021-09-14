<?php

namespace App\Http\Controllers;

use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->with('partner')->paginate();
        return view('orders.index', ['orders' => $orders]);
    }

    public function show(Order $order)
    {
        return view('orders.show', ['order' => $order]);
    }

    public function update(Order $order)
    {
        $validated = request()->validate([
            'client_email' => 'required|email',
            'partner_name' => 'required',
        ]);
        return response()->json(['message' => 'all ok']);
    }
}
