<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartRepository extends BaseRepository
{
    protected  $model;
    public function __construct()
    {
        $this->model = new Cart;
    }
}

?>
