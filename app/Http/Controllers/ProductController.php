<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function list_products()
    {
        $products = Product::with('stocks')->get();

        return view('product.list_products', compact('products'));
    }

    public function filter_products(Request $request)
    {
        $validatedData = $request->validate([
            'status_filter' => 'required'
        ]);

        if ($validatedData['status_filter'] === "active") {
            $products = Product::where('status', 'active')->with('stocks')->get();
        } elseif ($validatedData['status_filter'] === "inactive") {
            $products = Product::where('status', 'inactive')->with('stocks')->get();
        } else {
            $products = Product::with('stocks')->get();
        }

        return view('product.list_products', compact('products'));
    }


    public function add_products_get()
    {

        return view('product.add_products');
    }

    public function add_products_post(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'image' => 'required',
            'value' => 'required',
            'quantity' => 'required|integer',
            'description' => '',
        ]);

        $product = Product::create([
            'name' => $validatedData['name'],
            'image' => $validatedData['image'],
            'value' => $validatedData['value'],
            'description' => $validatedData['description'],
        ]);

        $stock = Stock::create([
            'id_product' => $product->id,
            'quantity' => $validatedData['quantity'],
        ]);

        return Redirect::route('list_products');
    }

    public function edit_products_get($id)
    {

        $product = Product::with('stocks')->find($id);

        return view('product.edit_products', compact('product'));
    }

    public function edit_products_post(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'image' => 'required',
            'value' => 'required',
            'quantity' => 'required|integer',
            'description' => '',
        ]);

        $product = Product::find($id);

        if ($product) {
            $product->update([
                'name' => $validatedData['name'],
                'image' => $validatedData['image'],
                'value' => $validatedData['value'],
                'description' => $validatedData['description'],
            ]);

            $stock = Stock::where('id_product', $product->id)->first();
            if ($stock) {
                $stock->update([
                    'quantity' => $validatedData['quantity'],
                ]);
            }
        }

        return Redirect::route('list_products');
    }

    public function disabled_product($id)
    {

        $product = Product::find($id);

        if ($product) {
            $product->update([
                'status' => 'inactive',
            ]);
        }

        return Redirect::route('list_products');
    }

    public function active_product($id)
    {

        $product = Product::find($id);

        if ($product) {
            $product->update([
                'status' => 'active',
            ]);
        }

        return Redirect::route('list_products');
    }
}
