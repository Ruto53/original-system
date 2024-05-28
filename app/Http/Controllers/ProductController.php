<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Bunrui;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function redirectPath ()
    {
        return 'products/index';
    }

    public function index(Request $request)//一覧画面

    {   
        $keyword = $request->input('keyword');
        $company_id = $request->input('company-id');
        $companies = company::all();

        $model = new Product();
        $products = $model->getList($keyword,$company_id);

        return view('index', ['products' => $products, 'companies' => $companies], compact('products', 'keyword') );  
    }
    
    public function create()
    {
        $companies = company::all();

        return view ('create',['companies'=>$companies]);
       
    }

    public function store(ArticleRequest $request)//登録画面
    {   
       
        $model = new Product();
        $image = $request->file('img_path');
       
        if($image){
            $file_name = $image->getClientOriginalName();
            $image->storeAs('public/img',$file_name);
            $img_path ='storage/img/'.$file_name;
           
      }else{
        $img_path =null; 
      }
        
        $registerProduct = $model->InsertProducts($request,$img_path);
        return redirect()->route('products.create')->with('successMessage', '登録に成功しました。');

        $request->validate([
            'product_name'=>'required|max:20',
            'company-id'=>'required|integer',
            'price'=>'required|integer',
            'stock'=>'required|integer',
            'comment'=>'required|max:140',
        ]);

        
    }

    public function show(Request $request,$id) //詳細画面
    {
        $model = new Product();
        $products = $model->getCompaniesList($id);

        return view ('show',['products' => $products],compact('products'));
        

    }

    public function destroy($id)
    {   
         $model = new Product;
        $model -> destroyProduct($id);
        return redirect()->route('products.index');
    }
    
    public function edit(Request $request, $id)//編集画面
    {   
        $companies = company::all();
        $image = $request->file('img_path');
        $model= new Product();

        if($image){
            $file_name = $image->getClientOriginalName();
            $image->storeAs('public/img',$file_name);
            $img_path = 'storage/img'.$file_name;

            $array['img_path'] = $image_path;

        }else{
            $img_path =null; 
    
        }

        $registerProduct = $model->InsertProducts($request,$img_path);
        return view('edit', ['products' => $products,'companies' => $companies] ); 


        $request->validate([
            'product_name'=>'required|max:20',
            'company-id'=>'required|integer',
            'price'=>'required|integer',
            'stock'=>'required|integer',
            'comment'=>'required|max:140',
        ]);
       
    }
    
    public function update(ArticleRequest $request, $id)
    {   
        $products = Product::find($id);
        $model= new Product();
        $updateProducts=$model->updateProducts($request, $products);
        $model->newImage($array,$id);

        return redirect()->route('products.edit');

        $array = [
            'product_name' => $request->input('product_name'),
            'company-id' => $request->input('company-id'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'comment' => $request->input('comment'),
            // 'img_path' => $image_path
        ];
        
    }
   

    public function showRegistForm() {

        $companies = company::all();

        return view('regist',['companies' => $companies])->with('succesmessage','更新が完了しました');
    
    }

    public function registSubmit(ArticleRequest $request) {
        DB::beginTransaction();

        try {

            $model = new Products();
            $model->registProducts($request);  
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            DB::commit();
            return back();
        }
          return redirect(route('regist')); 
        }
    
    public function showList() {
        return view('list');
    }
    






    }





