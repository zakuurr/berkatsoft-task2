<?php

namespace App\Services;

use App\Exceptions\BadParameter;
use App\Exceptions\BadParameterException;
use App\Exceptions\EmptyDataException;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerService extends BaseService
{
    private const CUSTOMER_SELECT_COLUMN = [

        "id",
        "name",
        "email",
        "phone",
        "address",
        "created_at",
    ];



    protected $repository;

    public function __construct()
    {
        $this->repository = new CustomerRepository();
    }
    /**
     * Description : use to get all data organization
     *
     * @return object of eloquent model
     */

    public function getAllData(): object
    {
        $data = $this->repository->getAllData(self::CUSTOMER_SELECT_COLUMN);
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
        $data = $this->repository->getDataById($id, self::CUSTOMER_SELECT_COLUMN);
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
