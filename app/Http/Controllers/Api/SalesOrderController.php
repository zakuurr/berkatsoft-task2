<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Http\Resources\SalesOrderResource;
use App\Http\Resources\SalesOrderResourceCollection;
use App\Models\Cart;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use App\Services\SalesOrderService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class SalesOrderController extends ApiController
{
    private string $responseName = 'Sales Order';
    private array $responseMessage = [
        'index' => 'Get list Sales Order successfully',
        'show' => 'Get Detail Sales Order successfully',
        'store' => 'Add new Sales Order successfully',
        'update' => 'Update Sales Order successfully',
        'destroy' => 'Delete Sales Order successfully',
        'destroy_failed' => 'Delete Sales Order failed, the data is not exists',
    ];

    public function index(SalesOrderService $service): JsonResponse
    {



        return $this->responseWithResourceCollection(
            new SalesOrderResourceCollection($service->getAllData()),
            $this->responseName,
            $this->responseMessage['index'],
            JsonResponse::HTTP_OK
        );
    }

    // public function index()
    // {
    //     // $sales = SalesOrder::with('customer', 'sales_order_details.product')->get();
    //     // return SaleResource::collection($sales);

    // }

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

    // public function show($id)
    // {
    //     $sale = SalesOrder::with('customer', 'sales_order_details', 'sales_order_details.product')->findOrFail($id);
    //     return new SaleResource($sale);
    // }

    public function show(SalesOrderService $service, string $id): ?JsonResponse
    {
        return $this->responseWithResource(
            new SalesOrderResource($service->getDataById($id)),
            $this->responseName,
            $this->responseMessage["show"],
            JsonResponse::HTTP_OK
        );
    }

    // public function destroy(SalesOrder $sale)
    // {
    //     $sale->sales_order_details()->delete();
    //     $sale->delete();

    //     return response()->noContent();
    // }

    public function destroy(SalesOrderService $service, string $id): JsonResponse
    {
        $service->deleteDataById($id);
        return $this->apiResponse([
            "success" => true,
            "name" => $this->responseName,
            "message" => $this->responseMessage["destroy"]
        ], JsonResponse::HTTP_OK);
    }
}
