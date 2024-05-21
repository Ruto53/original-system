<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable=[
        'name',
        'company-id',
        'price',
        'stock',
        'comment',
        'created_at',
        'updated_at',                                               
                                                       
     ];          
    public function getList($keyword,$company_id) {
        $query = DB::table('products')->join('companies','company_id','=','companies.id')
                                         ->select('products.*','companies.company_name');
                                         

    if(!empty($keyword)) {
         $query->where('product_name', 'LIKE', "%{$keyword}%");
         } 
                                
    if($company_id) {
        $query->where('company_id',$company_id);
         } 

        $products = $query->get();
        return $products;                            

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
    
    public function registArticle($request,$img_path) {
        $products = DB::table('products')
                                               ->insert([  
                                                           'company_id' => $data->input('company-id'),
                                                           'product_name' => $data->input('product_name'),
                                                           'price'       => $data->input('price'),
                                                           'stock'       => $data->input('stock'),
                                                           'comment'     => $data->input('comment'),
                                                           'img_path'    => $img_path,
                                                         ]);               
                                             
    }

    public function newImage($array,$id) {
        $products = DB::table('products')      
                                                
                                                ->where ('id',$id)                                 
                                                ->update($array);

                                                       
    }
    
    public function InsertProducts($request,$img_path) {
        $products = DB::table('products') 
                                                ->insert([ 
                                                           'company_id' => $request->input('company-id'),
                                                           'product_name' => $request->input('product_name'),
                                                           'price'       => $request->input('price'),
                                                           'stock'       => $request->input('stock'),
                                                           'comment'    => $request->input('comment'),
                                                           'img_path'    => $img_path,
                                                        ]);
    
    }
    
   




}




