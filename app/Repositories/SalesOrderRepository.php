<?php

namespace App\Repositories;

use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Facades\DB;

class SalesOrderRepository extends BaseRepository
{
    protected  $model;
    public function __construct()
    {
        $this->model = new SalesOrderDetail();
    }


    public function addTransaction(array $requestedData): object
    {
        return $this->model->create($requestedData);
    }
}

?>
