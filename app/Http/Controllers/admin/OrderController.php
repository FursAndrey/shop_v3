<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(15);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }

    public function cencel(Order $order)
    {
        $order->update(['status' => 2]);
        return redirect()->route('order.index')->with('warning', __('flushes.order_cenceled', ['order' => $order->id]));
    }
    
    public function success(Order $order)
    {
        $order->update(['status' => 1]);
        return redirect()->route('order.index')->with('success', __('flushes.order_complited', ['order' => $order->id]));
    }
}
