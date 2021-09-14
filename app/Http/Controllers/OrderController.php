<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->with('partner')->paginate();
        return view('orders.index', ['orders' => $orders]);
    }
}
