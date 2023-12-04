<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->insert([
          [
            
            'product_name' => 'cocacola',
            'price' => '130',
            'stock' => '50',
            'manufacture_name' => '日本コカコーラ株式会社',
            'comment' => 'ああああ',
            'img_path' => '※',
            
          ],
          [
            'product_name' => 'おーいお茶',
            'price' => '130',
            'stock' => '50',
            'manufacture_name' => '株式会社伊藤園',
            'comment' => 'ああああ',
            'img_path' => '※',
              
          ],
          [
            'product_name' => '天然水',
            'price' => '130',
            'stock' => '70',
            'manufacture_name' => 'サントリー株式会社',
            'comment' => 'ああああ',
            'img_path' => '※',
          ],
          ]);
  
    }
}
