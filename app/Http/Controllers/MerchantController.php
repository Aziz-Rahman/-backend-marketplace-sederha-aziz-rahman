<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Checkout;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class MerchantController extends Controller
{
    public function viewOrders(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'merchant') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {

            $products = $user->products;
            $customerOrders  = [];

            foreach ($products as $product)
            {
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
            
        } catch (\Exception $e) {

            return response()->json([
                'error' => 'Error',
                'messages' => $e->getMessage()
            ], 422);
        }
    }
}
