<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Cart;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    public function index()
    {
        $sales = SalesOrder::with('customer', 'sales_order_details.product')->get();
        return SaleResource::collection($sales);
    }

    public function count()
    {
        $sales = SalesOrder::count();
        return $sales;
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
        ]);

        // Check if cart is empty
        if (Cart::count() == 0) {
            return response()->json([
                'message' => 'Cart is empty'
            ], 422);
        }

        $sale = new SalesOrder();
        $sale->customer_id = $request->customer_id;
        $sale->save();
        $sale->uuid = 'UUID-' . $sale->id;
        $sale->save();
        $grand_total = 0;

        $carts = Cart::all();
        foreach ($carts as $cart) {
            $sale_detail = new SalesOrderDetail();
            $sale_detail->product_id = $cart->product_id;
            $sale_detail->sales_order_id = $sale->id;
            $sale_detail->qty = $cart->qty;
            $grand_total += $cart->product->price * $cart->qty;
            $sale_detail->save();
        }
        $sale->grand_total = $grand_total;
        $sale->save();

        $carts = Cart::all();
        foreach($carts as $cart) {
            $cart->delete();
        }

        return new SaleResource($sale);
    }

    public function show($id)
    {
        $sale = SalesOrder::with('customer', 'sales_order_details', 'sales_order_details.product')->findOrFail($id);
        return new SaleResource($sale);
    }

    public function destroy(SalesOrder $sale)
    {
        $sale->sales_order_details()->delete();
        $sale->delete();

        return response()->noContent();
    }
}
