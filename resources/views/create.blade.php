@extends('list')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">商品新規登録画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>
        </div>
    </div>
</div>
 
<div style="text-align:right;">
<form action="{{ route('products.create') }}" method="POST">
    @csrf
     
     <div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="商品名">
            </div>
        </div>
            <div class="left">
            <div class="form-group">    
             <select name="company-id" class="custom-select form-control pl-4">
                <option>メーカーを選択してください</option>
             @foreach ($companies as $company)
             <option value= "{{ $company->id }}" {{ old('form-select', $products->company_id ??'') == $company->id ? 'selected' : ''}}>
             {{ $company->company_name }}
            </opion>
             @endforeach
            </select>  
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="kakaku" class="form-control" placeholder="価格">
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <input type="text" name="kakaku" class="form-control" placeholder="在庫数">
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <textarea class="form-control" style="height:100px" name="shosai" placeholder="コメント"></textarea>
            </div>
        </div>
         <form action="#" method="post" enctype="multipart/form-data">
         <p> <p class="text-left"></p><br />
         <input type="file" name="filename" size="50" text-align:left;/><br />
         </p>
         </form>
         </div>
         </div> 
        <div class="col-12 mb-2 mt-2">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                <button type="submit" class="btn btn-primary w-100">登録</button>
            </form>    
        </div>
    </div>      
</form>
</div>
@endsection
   