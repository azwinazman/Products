<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    //
    public function index() {
        $products = Product::all();
        return response()->json($products,200);
    }

    public function store(Request $request) {
        $validated = $request->validate(
            ['name' => 'string',
             'description' => 'nullable|string',
             'price' => 'required|numeric|decimal:0,2|between:0,99999999.99',
             'stock' => 'integer'
              ]
        );

        $product = Product::create($validated);

        return response()->json(
            ['success' => true,
             'data' => $product]
        );
    }
}
