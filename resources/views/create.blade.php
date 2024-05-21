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
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(session('successMessage'))
        {{ session('successMessage') }}
    @endif    
     
     <div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
        
                <input type="text" name="product_name" class="form-control" placeholder="商品名">
                @error('product_name')
                <span style="color:red;">商品名を20文字以内で入力してください</span>
                @enderror
            </div>
        </div>
            <div class="left">
            <div class="form-group">    
             <select name="company-id" class="custom-select form-control pl-4">
                <option>メーカーを選択してください</option>
                @error('company-id')
                <span style="color:red;">メーカー名を選択してください</span>
                @enderror
             @foreach ($companies as $company)
             <option value= "{{ $company->id }}" {{ old('form-select', $products->company_id ??'') == $company->id ? 'selected' : ''}}>
             {{ $company->company_name }}
            　
            </opion>
             @endforeach
            </select>  
            </div>
        </div>
       
       </div>   
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="price" class="form-control" placeholder="価格">
                @error('price')
                <span style="color:red;">価格を数字で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <input type="text" name="stock" class="form-control" placeholder="在庫数">
               @error('stock')
               <span style="color:red;">価格を数字で入力してください</span>
               @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <textarea class="form-control" style="height:100px" name="comment" placeholder="コメント"></textarea>
            @error('shosai')
               <span style="color:red;">コメントを140文字以内で入力してください</span>
               @enderror
            </div>
        </div>
         </div>
         </div> 
        <div class="col-12 mb-2 mt-2">
            <p> <p class="text-left"></p><br/>
         <input type="file" name="img_path" size="50" text-align:left;/><br/> 
                <button type="submit" class="btn btn-primary w-100">登録</button>  
        </div>
    </div>      
</form>
</div>
@endsection
   