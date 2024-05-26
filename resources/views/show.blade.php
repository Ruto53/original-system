@extends('list')
   
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">商品情報詳細画面</h2>
        </div>
        @if(session('successMessage'))
        {{ session('successMessage') }}
        @endif    
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <label class="col-sm-2 col-form-label">商品情報ID</label>
                {{ $products->id }}                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <label class="col-sm-2 col-form-label">商品画像</label>    
            <img src="{{ asset($products->img_path) }}"width=200px>
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <label class="col-sm-2 col-form-label">商品名</label>        
                {{ $products->product_name }}                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <label class="col-sm-2 col-form-label">メーカー名</label>    
                {{ $products->company_name }}                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <label class="col-sm-2 col-form-label">価格</label>        
                {{ $products->price }}     
        </div>    
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <label class="col-sm-2 col-form-label">在庫数</label>        
                {{ $products->stock }}                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <label class="col-sm-2 col-form-label">コメント</label>     
            <textarea class="form-control" style="height:100px" name="shosai" placeholder="コメント"></textarea>
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
        <td><a href="{{ route('products.edit', ['id'=>$products->id])}}" class="btn btn-primary">編集</a></td>
        </div>
    </div>
</div>

@endsection
   