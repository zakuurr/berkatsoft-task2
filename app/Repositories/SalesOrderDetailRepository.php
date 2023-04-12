<?php

namespace App\Repositories;

use App\Models\SalesOrderDetail;
use Illuminate\Support\Facades\DB;

class SalesOrderDetailRepository extends BaseRepository
{
    protected  $model;
    public function __construct()
    {
        $this->model = new SalesOrderDetail;
    }
}

?>
