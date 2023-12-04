<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function getList() {
        $products = DB::table('products')->join('companies','company_id','=','companies.id')
                                         ->select('products.*','companies.company_name')
                                         ->get();return $products;
    } 
    public function getCompaniesList($id) {
        $products = DB::table("products")       ->join('companies', 'company_id', '=', 'companies.id')
                                                ->select('products.*','companies.company_name')
                                                ->where('products.id', '=', $id) ->first();
        return $products;                                        
    } 

    public function destroyProduct($id) {
        $products = DB::table('products')
                                               ->where('products.id', '=', $id) ->delete();
    }

    public function updateProducts($request, $products)
    {

        ([
            'product_name' => $request->product_name
        ])->save();
    }
    
    public function registArticle($data) {
        $products = DB::table('products')
                                               ->insert([  
                                                           'company_id' => $data->input('company_id'),
                                                           'product_name' => $data->input('product_name'),
                                                           'price'       => $data->input('price'),
                                                           'stock'       => $data->input('stock'),
                                                           'comment'     => $data->input('comment'),
                                                           'img_path'    => $data->input('img_path'),
                                                        ]);
    }
    
    
    

}
