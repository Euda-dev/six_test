<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StoreController extends Controller
{
    public function page_product($id)
    {

        $product = Product::with('stocks')->find($id);

        return view('store.page_product', compact('product'));

    }

    public function home()
    {

        $products = Product::where('status', 'active')->get();

        return view('store.home', compact('products'));

    }

    public function checkout($quantity, $id)
    {
        $product = Product::find($id);

        return view('store.checkout', compact('product', 'quantity'));
    }

    public function checkout_post(Request $request, $quantity, $id)
    {
        $stock = Stock::where('id_product', $id)->first();

        if (($stock->quantity - $quantity) < 0) {
            return Redirect::route('page_product', ['id' => $id])->withErrors(['message' => 'Produto Esgotado.']);
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'cpf' => 'required',
        ]);

        $order = Order::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'cpf' => $validatedData['cpf'],
            'id_product' => $id,
            'quantity' => $quantity,
        ]);


        if ($stock) {
            $stock->update([
                'quantity' => ($stock->quantity - $quantity),
            ]);
        }

        return Redirect::route('order_success');
    }
}
