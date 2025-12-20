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
        //return response()->json(['message' => 'Connected!']);
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
             'data' => $product], 201
        );
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);

        $validated = $request->validate(
            ['name' => 'string',
             'description' => 'nullable|string',
             'price' => 'required|numeric|decimal:0,2|between:0,99999999.99',
             'stock' => 'integer'
              ]
        );

        $product->update($validated);

        return response()->json(
            ['success' => true,
             'data' => $product],200
        );
    }

    public function show($id) {
        $product = Product::findOrFail($id);

        return response()->json($product,200);
    }

    public function destroy($id) {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(
                ['message' => 'Product not found.'], 404
            );
        }

        $product->delete();

        return response()->json(
            ['message' => 'Product deleted successfully.'], 200
        );
    }
}
