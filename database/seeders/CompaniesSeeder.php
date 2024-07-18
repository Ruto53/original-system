<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company; 

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('companies')->insert([
            [
              'company_name' => 'A社',
              'street_address' => '東京都渋谷区渋谷1-2-3',
              'representative_name' => '佐藤一郎',

            ],
    
            [
                'company_name' => 'B社',
                'street_address' => '大阪府阿倍野区阿倍野筋4-5-6',
                'representative_name' => '鈴木弘',
  
            ],
    
            [
                'company_name' => 'C社',
                'street_address' => '福岡県福岡市中央区天神7-8-9',
                'representative_name' => '高橋清',
  
            ],
            
            ]);
    }
}
