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
    

    public function edit($id)//編集画面表示
    {   
        $companies = DB::table('companies')->get();
        $model = new Product();
        $products = $model->getCompaniesList($id);

        return view('edit',['companies'=> $companies, 'product' => $product]);
    }
    
    public function registedit(Request $request, $id)//編集画面
    {   
       
        $model = new Product();
        $image = $request->file('img_path');

        if($image){
            $file_name = $image->getClientOriginalName();
            $image->storeAs('public/img',$file_name);
            $img_path ='storage/img/'.$file_name;
            $model->registedit($request, $img_path, $id);
           
      }else{
        $model->registeditNoImg($request, $id);
        $img_path =null; 
      }
        
        $registerProduct = $model->InsertProducts($request,$img_path);

        return redirect()->route('products.edit');

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
        ;

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
    
    public function showList() {
        return view('list');
    }
    






    }





