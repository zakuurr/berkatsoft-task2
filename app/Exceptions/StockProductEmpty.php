<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StockProductEmpty extends Exception
{
    public  $message;
    public function __construct(string $message = "stok barang kosong")
    {
        $this->message = $message;
    }
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'name' => 'stok barang kosong',
            'message' => $this->message,
            'error_code' => 404,
            'error' => true,
        ])->setStatusCode(404);
    }
}
