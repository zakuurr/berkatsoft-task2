<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UnauthorizedException as ExceptionsUnauthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerResourceCollection;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends ApiController
{
    private string $responseName = 'Customers';
    private array $responseMessage = [
        'index' => 'Get list Customers successfully',
        'show' => 'Get Customers successfully',
        'store' => 'Add new Customers successfully',
        'update' => 'Update Customers successfully',
        'destroy' => 'Delete Customers successfully',
        'destroy_failed' => 'Delete Customers failed, the data is not exists',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(CustomerService $service): JsonResponse
    {



        return $this->responseWithResourceCollection(
            new CustomerResourceCollection($service->getAllData()),
            $this->responseName,
            $this->responseMessage['index'],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerService $service, CustomerRequest $request): JsonResponse
    {
        $stored = $service->addNewData($request->validated());

        return $this->responseWithResource(
            new CustomerResource($stored),
            $this->responseName,
            $this->responseMessage["store"],
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerService $service, string $id): ?JsonResponse
    {
        return $this->responseWithResource(
            new CustomerResource($service->getDataById($id)),
            $this->responseName,
            $this->responseMessage["show"],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerService $service, CustomerRequest $request, string $id): JsonResponse
    {
        $updated = $service->updateDataById($id, $request->validated());

        return $this->responseWithResource(
            new CustomerResource($updated),
            $this->responseName,
            $this->responseMessage["update"],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerService $service, string $id): JsonResponse
    {
        $service->deleteDataById($id);
        return $this->apiResponse([
            "success" => true,
            "name" => $this->responseName,
            "message" => $this->responseMessage["destroy"]
        ], JsonResponse::HTTP_OK);
    }
}
