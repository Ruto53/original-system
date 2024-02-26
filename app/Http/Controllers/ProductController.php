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
        $query = Product::query();

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        } 
        $company_id = $request->input('company-id');

        if($company_id) {
            $query->where('company_id',$company_id);
        }    
    

        $products = $query->get();
        $companies = company::all();

        return view('index', ['products' => $products, 'companies' => $companies], compact('products', 'keyword') );  
    }
    
    public function create()
    {
        $companies = company::all();

        return view ('create',['companies'=>$companies]);
       
    }

    public function store(Request $request)
    {   

        $model = new Product();
        $registerProduct = $model->InsertProducts($request);
        return view('products.create');
        
        $input = $request->all();
        Priduct::create($input);
        return redirect()->route('products.store')
        ->with('success','商品を登録しました');
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
    
    public function edit($id)
    {   
        $companies = company::all();
        $products = Product::find($id);

        return view('edit', ['products' => $products, 'companies' => $companies] );        
    }

    public function update(Request $request, $id)
    {   
        $products = Product::find($id);
        $updateProducts = $this->products->updateProducts($request, $products);

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
    }





