<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Checkout;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class MerchantController extends Controller
{
    public function createProduct(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'merchant') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

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
    }

    public function updateProduct(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'merchant') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

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

    public function viewOrders(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'merchant') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $products = $user->products;
        $customerOrders  = [];

        foreach ($products as $product)
        {
            // print_r($product->orderDetails);
            foreach ($product->orderDetails as $orderDetail)
            {
                if ($orderDetail->checkout) 
                {
                    $customerId = $orderDetail->checkout->customer_id;
                    $customerName = $orderDetail->checkout->customer_name; // Assuming there's a customer_name field

                    // Check if this customer_id is already in the array
                    if (!isset($customerOrders[$customerId])) 
                    {
                        // Add customer data if not already present
                        $customerOrders[$customerId] = [
                            'customerID' => $customerId,
                            'customerName' => $customerName,
                        ];
                    }
                }
            }   
        }   

        // Convert associative array to a simple array
        $customerOrderList = array_values($customerOrders);

        // Return the grouped customer orders
        return response()->json(['customerOrder' => $customerOrderList]);
    }
}
