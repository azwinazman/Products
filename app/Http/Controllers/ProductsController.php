<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{
    //
    public function index() {
        abort_if(Gate::denies('products-view'), 403, "You're not allowed to view");
        $products = Product::all();
        return response()->json($products,200);
        //return response()->json(['message' => 'Connected!']);
    }

    /*public function store(Request $request) {
        
        abort_if(Gate::denies('products-create'), 403, "You're not an admin");
        $validated = $request->validate(
            ['name' => 'string',
             'description' => 'nullable|string',
             'price' => 'required|numeric|decimal:0,2|between:0,99999999.99',
             'stock' => 'integer'
              ]
        );

        //$product = Product::create($validated);
        $product = auth()->user()->products()->create($validated);

        return response()->json(
            ['success' => true,
             'data' => $product], 201
        );
    }*/

    public function store(Request $request)
    {
        // 1. Permission check using the Gate facade
        abort_if(Gate::denies('products-create'), 403, "You're not an admin");

        // 2. Validation
        $validated = $request->validate([
            'name' => 'required|string', // Added 'required' to ensure name isn't empty
            'description' => 'nullable|string',
            'price' => 'required|numeric|decimal:0,2|between:0,99999999.99',
            'stock' => 'required|integer' // Added 'required' to prevent null stock
        ]);

        $product = Product::create(
            [ 'name' => $validated['name'],
              'description' => $validated['description'],
              'price' => $validated['price'],
              'stock' => $validated['stock'],
              'user_id' => Auth::id() ]
        );

        

        // 4. Return JSON response
        return response()->json([
            'success' => true,
            'data' => $product
        ], 201);
    }

    public function update(Request $request, $id) {
        abort_if(Gate::denies('products-update'), 403, "You're not allowed to update");
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
        abort_if(Gate::denies('products-view'), 403, "You're not allowed to view");
        $product = Product::findOrFail($id);

        return response()->json($product,200);
    }

    public function destroy($id) {
        abort_if(Gate::denies('products-delete'), 403, "You're not allowed to delete");
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
