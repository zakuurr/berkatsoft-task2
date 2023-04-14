<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\CartResource;
use App\Http\Resources\CartResourceCollection;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends ApiController
{

    private string $responseName = 'Carts';
    private array $responseMessage = [
        'index' => 'Get list Carts successfully',
        'store' => 'Add new Carts successfully',
       
    ];

    public function get_cart_user(CartService $service) : JsonResponse 
    {
        return $this->responseWithResourceCollection(
            new CartResourceCollection($service->getAllData()),
            $this->responseName,
            $this->responseMessage['index'],
            JsonResponse::HTTP_OK
        );
        
        // $carts = Cart::with('product')->get();
        // return CartResource::collection($carts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
        ]);
        
        // Check existing product
        if (Cart::where('product_id', $request->product_id)->exists()) {
            $cart = Cart::where('product_id', $request->product_id)->first();
            $cart->qty = $cart->qty + $request->qty;
            $cart->save();
            return new CartResource($cart);
        }
        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->qty = $request->qty;
        $cart->save();

        return new CartResource($cart);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return response()->noContent();
    }
}
