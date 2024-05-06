@extends('list')

@section('content')
<div class="container small">
  <h1>商品情報編集画面</h1>
  <form action="{{ route('products.update', ['id'=>$products->id]) }}" method="POST">
  @csrf
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
            <textarea class="form-control" name="comment" value="{{ $products->comment }}" style="height:100px" name="shosai" placeholder="コメント"></textarea>
            @error('comment')
        　　　<span style="color:red;">>コメントを140文字以内で入力してください</span>
        　　　@enderror
            </div>
        </div>
         <form action="#" method="post" enctype="multipart/form-data">
         <p> <p class="text-left"></p><br />
         <input type="file" name="filename" size="50" text-align:left;/><br />
         </p>
         </form>
         </div>
         </div>     
      <div class="form-group">
        <label for="products_name">{{ __('商品の編集') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="products_name" id="products_name">
      </div>
      <div class="d-flex justify-content-between pt-3">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary" role="button">
            <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('一覧画面へ') }}
        </a>
        <button type="submit">
        <input type="file" name="img_path" size="50" text-align:left;/><br/> 
        <td><a href="{{ route('products.edit', ['id'=> $products->id]) }}" class="btn btn-info">更新</a></td>
        </button>
      </div>
    </fieldset>
  </form>
</div>
@endsection
