<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Cart;
use App\Models\SalesOrder as Sale;
use App\Models\SaleOrderDetail;
use App\Models\SalesOrderDetail;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    public function index()
    {
        $sales = Sale::with('customer', 'sales_order_details.product')->get();
        return SaleResource::collection($sales);
    }

    public function count()
    {
        $sales = Sale::count();
        return $sales;
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
        ]);

        if (count($request->cartData) == 0) {
            return response()->json([
                'errors' => [
                    'cart' => ['Cart is empty']
                ],
                'message' => 'Cart is empty'
            ], 422);
        }

        $sale = new Sale();
        $sale->customer_id = $request->customer_id;
        $sale->save();
        $sale->uuid = 'UUID-' . $sale->id;
        $sale->save();
        $grand_total = 0;

        foreach ($request->cartData as $cart) {
            $sale_detail = new SalesOrderDetail();
            $sale_detail->product_id = $cart['id'];
            $sale_detail->sales_order_id = $sale->id;
            $sale_detail->qty = $cart['qty'];
            $grand_total += $cart['price'] * $cart['qty'];
            $sale_detail->save();
        }
        $sale->grand_total = $grand_total;
        $sale->save();

        return new SaleResource($sale);
    }

    public function show($id)
    {
        $sale = Sale::with('customer', 'sale_details', 'sale_details.product')->findOrFail($id);
        return new SaleResource($sale);
    }

    public function destroy(Sale $sale)
    {
        $sale->sale_details()->delete();
        $sale->delete();

        return response()->noContent();
    }
}