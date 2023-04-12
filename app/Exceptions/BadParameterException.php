<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BadParameterException extends Exception
{
    public  $message;
    public function __construct(string $message = "Check your parameter")
    {
        $this->message = $message;
    }
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'name' => 'Bad Parameter',
            'message' => $this->message,
            'error_code' => 404,
            'error' => true,
        ])->setStatusCode(404);
    }
}
