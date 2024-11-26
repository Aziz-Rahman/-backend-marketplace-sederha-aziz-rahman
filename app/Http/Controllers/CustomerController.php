<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Checkout;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerController extends Controller
{
    public function listProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function addToCart(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {

            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);
            
            $product = Product::find($validated['product_id']);
            $totalPrice = $product->price * $validated['quantity'];
            
            $existingCart = Cart::where('customer_id', $user->id) 
                ->where('product_id', $product->id)
                ->first();

            // Pengecekan stok 1
            if ($validated['quantity'] > $product->stock) 
            {
                return response()->json(['status' => 'fail', 'message' => 'Insufficient stock'], 201);
            }

            if ($existingCart) 
            {
                $existingCart->quantity += $validated['quantity'];

                // Pengecekan stok ke 2 setelah qty ditambahkan dg stok sebelumnya
                if ($existingCart->quantity > $product->stock) 
                {
                    return response()->json(['status' => 'fail', 'message' => 'Insufficient stock'], 201);
                }

                $existingCart->save();
            } 
            else 
            {
                Cart::create([
                    'product_id' => $product->id,
                    'quantity' => $validated['quantity'],
                    'price' => $product->price,
                    'discount' => !empty($product->discount) ? $product->discount : 0,
                    'customer_id' => $user->id
                ]);
            }

            return response()->json(['status' => 'success', 'message' => 'Item added to cart'], 201);

        } catch (\Exception $e) {

            // Kembalikan respon JSON dengan kesalahan validasi
            return response()->json([
                'error' => 'Error',
                'messages' => $e->getMessage()
            ], 422);
        }
    }

    public function checkout(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $address = $request->input('customer_address');
        $city = $request->input('customer_city');
        $postal_code = $request->input('postal_code');
        $phone = $request->input('customer_phone');

        // ---------------------------------------------------------------------

        try {

            // Validasi data pengiriman
            $validated = $request->validate([
                'customer_address' => 'required|string|max:255',
                'customer_city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:6',
                'customer_phone' => 'required|string|max:15',
            ]);
            
            $cartItemOrder = Cart::where('customer_id', $user->id)->with('product')->get();

            // Hitung total belanja
            $total = Cart::where('customer_id', $user->id)
            ->sum(\DB::raw('quantity * price')); // blm dimasukan diskon peritem, jika kedepannya ada, maka dapat dimasukan disini

            // ---------------------------------------------------------------------
            // KETENTUAN
            // belanja diatas 15rbu dapat free ongkir
            // belanja diatas 50rbu dapat diskon10% 

            $discount = $total > 50000 ? $total * 0.10 : 0; // dapat 10% 
            $shippingCost = $total > 15000 ? 0 : 5000; // dapat free ongkir


            DB::beginTransaction();

            // Memeriksa apakah ada item di keranjang
            if ($cartItemOrder->isNotEmpty()) 
            {
                 // Proses checkout 
                $invoice = Checkout::create([
                    'customer_id' => $user->id,
                    'customer_name' =>$user->name,
                    'customer_address' => $address,
                    'customer_city' => $city,
                    'customer_pos_code' => $postal_code,
                    'customer_phone' => $phone,
                    'total_price' => $total, // total belanja blm dipotong diskon akhir & shipping 
                    'total_discount' => $discount,
                    'shipping_cost' => $shippingCost,
                    'final_total_price' => $total - $discount + $shippingCost
                ]);

                // order_details
                foreach ($cartItemOrder as $cartItem) 
                {
                    // Mengakses informasi produk
                    $product = $cartItem->product; // Ini akan mengakses relasi product

                    if ($product) 
                    {
                        $insertDetail = OrderDetail::create([
                            'checkout_id' => $invoice->id,
                            'product_id' => $product->id, // ID produk
                            'image' => $product->image,
                            'title' => $product->title,
                            'description' => $product->description,
                            'quantity' => $cartItem->quantity,
                            'price' => $cartItem->price,
                            'subtotal' => $cartItem->price * $cartItem->quantity,
                            'discount' => $cartItem->discount,
                        ]);
                    }
                }
                
                // Kosongkan keranjang
                Cart::where('customer_id', $user->id)->delete();

                DB::commit();

                return response()->json([
                    'status' => 'success', 
                    'message' => 'Invoice created successfully!',
                    'invoice' => $invoice->id, 
                ], 201);
            } 
            else 
            {
                print_r('Something when wrong'); die;
            }

        } catch (\Exception $e) {

            DB::rollBack();
            // Kembalikan respon JSON dengan kesalahan validasi
            return response()->json([
                'error' => 'Error',
                'messages' => $e->getMessage()
            ], 422);
        }
    }
}
