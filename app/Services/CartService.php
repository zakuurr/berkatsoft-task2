<?php

namespace App\Services;

use App\Exceptions\BadParameter;
use App\Exceptions\BadParameterException;
use App\Exceptions\EmptyDataException;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class CartService extends BaseService
{
    private const CART_SELECT_COLUMN = [

        "product_id",
        "qty",
    ];



    protected $repository;

    public function __construct()
    {
        $this->repository = new CartRepository();
    }
    /**
     * Description : use to get all data organization
     *
     * @return object of eloquent model
     */

    public function getAllData(): object
    {
        $data = $this->repository->with(['product'])->getAllData();
        if ($data->count() == 0) {
            throw new EmptyDataException();
        }

        return $data;
    }


    /**
     * Description : use to get organization by id
     *
     * @param int $id of organization
     * @return object of eloquent model
     */
    public function getDataById(string $id): object
    {
        $data = $this->repository->getDataById($id, self::CART_SELECT_COLUMN);
        if (empty($data)) {
            throw new EmptyDataException();
        }
        return $data;
    }


    /**
     * Description : use to add new organization
     *
     * @param array $requestedData data that want to store
     * @return object of eloquent model
     */
    public function addNewData(array $requestedData): object
    {
        return $this->repository->addNewData($requestedData);
    }

    public function updateDataById(string $id, array $requestedData): object
    {
        $this->checkData($id);
        return $this->repository->updateDataById($id, $requestedData);
    }

    public function deleteDataById(string $id): bool
    {
        $this->checkData($id);
        return $this->repository->deleteDataById($id);
    }



}
