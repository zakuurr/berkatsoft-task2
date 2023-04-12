<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "H&M",
                "type" => "Hoodie",
                "desc" => "Hoodie H&M",
                "price" => 100000,
                "stok" => 1
            ],
            [
                "name" => "Greenlight",
                "type" => "T-Shirt",
                "desc" => "T-Shirt Greenlight",
                "price" => 100000,
                "stok" => 1
            ],

        ];

        DB::table('products')->insert($data);
    }
}
