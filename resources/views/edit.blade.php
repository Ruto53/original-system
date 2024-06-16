@extends('list')

@section('content')
<div class="container small">
  <h1>商品情報編集画面</h1>
  <form action="{{ route('products.update', ['id'=>$products->id]) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @if(session('successMessage'))
        {{ session('successMessage') }}
    @endif    
    <fieldset>
    <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                {{ $products->id }}                
            </div>
            </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="product_name" value="{{ $products->product_name }}"  class="form-control" placeholder="商品名">
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

             </option>
             @endforeach
            </select>  
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="price" value="{{ $products->price }}"  class="form-control" placeholder="価格">
                @error('price')
                <span style="color:red;">価格を数字で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <input type="text" name="stock" value="{{ $products->stock }}" class="form-control" placeholder="在庫数">
            @error('stock')
            <span style="color:red;">価格を数字で入力してください</span>
             @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <textarea class="form-control" name="comment" value="{{ $products->comment }}" style="height:100px" name="comment" placeholder="コメント"></textarea>
            @error('comment')
        　　　<span style="color:red;">>コメントを140文字以内で入力してください</span>
        　　　@enderror
            </div>
        </div>
         
        <div class="col-12 mb-2 mt-2">
        　<img src="{{ asset($products->img_path )}}" alt="商品画像"　class="img_view" width=300px>
        </div> 
        <div class="col-12 mb-2 mt-2">
         <label for="" class="form-label">画像</label>
         <input type="file" name="img_path">
        </div> 
        <a href="{{ route('products.index'}}" class="btn btn-outline-secondary" role="button">
            <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('一覧画面へ') }}
        </a>
        <button type="submit" class="btn btn-primary w-100">登録</button>  
        </button>

      </div>
    </fieldset>
  </form>
</div>
@endsection
