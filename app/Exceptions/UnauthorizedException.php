<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UnauthorizedException extends Exception
{
    use ApiResponseTrait;

    public $message;
    public $code;

    public function __construct($message = 'You are unauthorized to do this request', $code = 401)
    {
        $this->message = $message;
        $this->code = $code;
    }
    public function render()
    {
        return $this->apiResponse([
            'success'   => false,
            'name'      => 'Unauthorized',
            'message'   => $this->getMessage(),
            'error_code' => $this->getCode(),
            'error' => true,
        ], $this->getCode());
    }
}
