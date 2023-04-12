<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
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
                "name" => "Reza Kurnia",
                "phone" => "0865121212",
                "email" => "ezakurnia50@gmail.com",
                "address" => "Bandung",
            ],
          
        ];

        DB::table('customers')->insert($data);
    }
}
