<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\SalesOrder as Sale;

class SalesOrderDetailController extends Controller
{
    public function store(SaleRequest $request)
    {
        $product = Sale::create($request->validated());

        return new SaleResource($product);
    }

    public function update(SaleRequest $request, Sale $product)
    {
        $product->update($request->validated());

        return new SaleResource($product);
    }

    public function destroy(Sale $product)
    {
        $product->delete();

        return response()->noContent();
    }
}
