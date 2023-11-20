<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function list_orders()
    {
        $orders = Order::with('product')->get();

        return view('order.list_orders', compact('orders'));
    }

    public function filter_orders(Request $request)
    {
        $validatedData = $request->validate([
            'status_filter' => 'required'
        ]);

        if ($validatedData['status_filter'] === "pending") {
            $orders = Order::where('status', 'pending')->with('product')->get();
        } elseif ($validatedData['status_filter'] === "completed") {
            $orders = Order::where('status', 'completed')->with('product')->get();
        } else {
            $orders = Order::with('product')->get();
        }

        return view('order.list_orders', compact('orders'));
    }

    public function complete_order($id)
    {
        $product = Order::find($id);

        if ($product) {
            $product->update([
                'status' => 'completed',
            ]);
        }

        return Redirect::route('list_orders');
    }
}
