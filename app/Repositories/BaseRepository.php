<?php
namespace App\Repositories;

use App\Exceptions\EmptyDataException;
use App\Traits\RepositoryFilter;
use App\Traits\RepositorySearch;

interface IRepository
{

    public function getAllDataPaginated(array $columns = ["*"], int $perPage): ?object;
    public function getAllData(array $columns = ["*"]): ?object;
    public function getDataById(string $id, array $columns = ["*"]): ?object;
    public function addNewData(array $requestedData): object;
    public function updateDataById(string $id, array $requestedData): ?object;
    public function deleteDataById(string $id): string;


}

abstract class BaseRepository implements IRepository
{
    use RepositoryFilter, RepositorySearch;

    protected const DEFAULT_PER_PAGE = 5;
    protected const LIMIT = 5;
    protected  $model;


    public function getAllDataPaginated(array $columns = ["*"], int $perPage = self::DEFAULT_PER_PAGE): ?object
    {
        return $this->model
            ->select($columns)
            ->paginate($perPage);
    }
    public function getAllData(array $columns = ["*"]): ?object
    {
        return $this->model
            ->select($columns)
            ->get();
    }
    public function getDataById(string $id, array $columns = ["*"]): ?object
    {
        return $this->model
            ->select($columns)
            ->where("id", $id)
            ->first();
    }

    public function addNewData(array $requestedData): object
    {
        return $this->model
            ->create($requestedData);
    }

    public function updateDataById(string $id, array $requestedData, array $columns = ["*"]): ?object
    {
        $this->model
            ->where("id", $id)
            ->update($requestedData);

        return $this->model->find($id, $columns);
    }
    public function deleteDataById(string $id): string
    {
        return $this->model
            ->where("id", $id)
            ->delete();
    }


}


?>
