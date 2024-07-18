<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \DB::table('sales')->insert([
        [
          'products_id' => '123',
        ],

        [
          'products_id' => '456',
        ],

        [
          'products_id' => '789',
        ],
        
        ]);
    }
}
