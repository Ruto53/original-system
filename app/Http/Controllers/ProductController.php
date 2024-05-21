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

    public function index(Request $request)

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

    public function store(ArticleRequest $request)
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

    public function show($id)
    {
        $model = new Product();
        $products = $model->getCompaniesList($id);


        return view ('show',['products' => $products]);

    }

    public function destroy($id)
    {   
        $model = new Product;
        $model -> destroyProduct($id);
        return redirect()->route('products.index');
    }
    
    public function edit(Request $request, $id)
    {   
        $companies = company::all();
        $products = Product::find($id);
        $image = $request->file('img_path');
        $model = new Product();

        $array = [
            'product_name' => $request->input('product_name'),
            'company-id' => $request->input('company-id'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'comment' => $request->input('comment'),
            // 'img_path' => $image_path
        ];
        return view('edit', ['products' => $products, 'companies' => $companies] )->with('message','更新が完了しました'); 

        $validator = Valiator::make($request->all(),[
            'price' => 'required',
            'stock' => 'required',
            'comment' => 'required',
        ]);    

        if($image){
            $file_name = $image->getClientOriginalName();
            $image->storeAs('public/img',$file_name);
            $img_path = 'storage/img'.$file_name;

            $array['img_path'] = $image_path;

            $model->newImage($array,$id);

        }else{
            $model->newImage($array,$id);
    
        }
        $model->newImage ($array,$id);
        
    }

    public function update(Request $request, $id)
    {   
        $products = Product::find($id);
        $updateProducts = $this->products->updateProducts($request, $products);

        return redirect()->route('products.index');

        $validator = Valiator::make($request->all(),[
            'price' => 'required',
            'stock' => 'required',
            'comment' => 'required',
        ]);
        if($validator->falis()){
            return redirect('products/'.$id.'/edit')
            ->withInput()
            ->withErrors($validator);
        }    
        $products = Product::find($id);
        $products->price = $request->price;
        $products->stock = $request->stock;
        $products->comment = $request->comment;
        $products->save();


        return redirect()->route('products.index');
    }

    public function showRegistForm() {

        $companies = company::all();

        return view('regist',['companies' => $companies]);
    
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





