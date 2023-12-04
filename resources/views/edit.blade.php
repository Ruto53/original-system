@extends('list')

@section('content')
<div class="container small">
  <h1>商品情報編集画面</h1>
  <form action="{{ route('products.update', ['id'=>$products->company_id]) }}" method="POST">
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
        <div class="left">
            <div class="form-group">    
             <select name="company-id" class="custom-select form-control pl-4">
                <option>メーカーを選択してください</option>
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
      <div class="form-group">
        <label for="products_name">{{ __('商品の編集') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="products_name" id="products_name">
      </div>
      <div class="d-flex justify-content-between pt-3">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary" role="button">
            <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('一覧画面へ') }}
        </a>
        <button type="submit" class="btn btn-success">
            {{ __('更新') }}
        </button>
      </div>
    </fieldset>
  </form>
</div>
@endsection
