<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerRepository extends BaseRepository
{
    protected  $model;
    public function __construct()
    {
        $this->model = new Customer;
    }
}

?>
