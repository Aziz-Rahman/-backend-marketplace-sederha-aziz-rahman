<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function listProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function productDetail($id)
    {
        //get product by ID
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function createProduct(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'merchant') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {

            $validated = $request->validate([
                'title' => 'required|string',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0',
            ]);

            $product = Product::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'merchant_id' => $user->id,
                'stock' => $validated['stock'],
            ]);

            return response()->json(['message' => 'Product created successfully', 'product' => $product]);

        } catch (\Exception $e) {

            // Kembalikan respon JSON dengan kesalahan validasi
            return response()->json([
                'error' => 'Error',
                'messages' => $e->getMessage()
            ], 422);
        }
    }

    public function updateProduct(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'merchant') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {

            $request->validate([
                // 'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
                'title'         => 'required|min:5',
                'description'   => 'required|min:10',
                'price'         => 'required|numeric',
                'stock'         => 'required|numeric'
            ]);

            $product = Product::findOrFail($request->id);

            // check if image is uploaded
            if ($request->hasFile('image')) 
            {
                // upload new image
                $image = $request->file('image');
                $image->storeAs('public/products', $image->hashName());

                // delete old image
                Storage::delete('public/products/'.$product->image);

                // update product with new image
                $product->update([
                    'image'         => $image->hashName(),
                    'title'         => $request->title,
                    'description'   => $request->description,
                    'price'         => $request->price,
                    'stock'         => $request->stock
                ]);
            } 
            else 
            {
                // update product without image
                $product->update([
                    'title'         => $request->title,
                    'description'   => $request->description,
                    'price'         => $request->price,
                    'stock'         => $request->stock
                ]);
            }

            return response()->json(['message' => 'Update product successfully']);

        } catch (\Exception $e) {

            // Kembalikan respon JSON dengan kesalahan validasi
            return response()->json([
                'error' => 'Error',
                'messages' => $e->getMessage()
            ], 422);
        }
    }

    public function deleteProduct($id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'merchant') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // get product by ID
        $product = Product::findOrFail($id);

        // delete image
        Storage::delete('public/products/'. $product->image);

        // delete product
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
