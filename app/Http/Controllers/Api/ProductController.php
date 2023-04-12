<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UnauthorizedException as ExceptionsUnauthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    private string $responseName = 'Products';
    private array $responseMessage = [
        'index' => 'Get list Products successfully',
        'show' => 'Get Products successfully',
        'store' => 'Add new Products successfully',
        'update' => 'Update Products successfully',
        'destroy' => 'Delete Products successfully',
        'destroy_failed' => 'Delete Products failed, the data is not exists',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(ProductService $service): JsonResponse
    {



        return $this->responseWithResourceCollection(
            new ProductResourceCollection($service->getAllData()),
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
    public function store(ProductService $service, ProductRequest $request): JsonResponse
    {
        $stored = $service->addNewData($request->validated());

        return $this->responseWithResource(
            new ProductResource($stored),
            $this->responseName,
            $this->responseMessage["store"],
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductService $service, string $id): ?JsonResponse
    {
        return $this->responseWithResource(
            new ProductResource($service->getDataById($id)),
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
    public function update(ProductService $service, ProductRequest $request, string $id): JsonResponse
    {
        $updated = $service->updateDataById($id, $request->validated());

        return $this->responseWithResource(
            new ProductResource($updated),
            $this->responseName,
            $this->responseMessage["update"],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductService $service, string $id): JsonResponse
    {
        $service->deleteDataById($id);
        return $this->apiResponse([
            "success" => true,
            "name" => $this->responseName,
            "message" => $this->responseMessage["destroy"]
        ], JsonResponse::HTTP_OK);
    }
}
