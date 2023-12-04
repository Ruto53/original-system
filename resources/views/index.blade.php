@extends('list')
  
@section('content')
    <div class="row">
        <div class="col-lg-12">   
            <div class="text-left">
                <h2 style="font-size:1rem;">商品情報一覧画面</h2>
            </div>
            <div class="text-right">
            <a class="btn btn-success" href="{{ route('products.create') }}">新規登録</a>
            </div>
        </div>
    </div>
    <div>
    <form action="{{ route('products.index') }}" method="GET">
     @csrf    
    <dl class="search-box card-body mb-0">
                <dt>商品名</dt>
                <dd>
                <input type="text" name="keyword" class="form-control" placeholder="商品名" value="{{ Request::get('keyword') }}">
                </dd>
                <div class="left">
                    <div class="form-group">
                     <select name="company-id" class="custom-sedlect form-control pl-4">   
                       <option>メーカーを選択してください</option>
                    @foreach ($companies as $company)
                    <option value= "{{ $company->id }}" >   
                    {{ $company->company_name }}
                    </option>
                    @endforeach
                    </select>
                    </div>   
                </div>    
            <div class="card-footer">
                <button type="submit" class="btn w-100 btn-success">検索</button>
            </div>
        </form>


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>product_name</th>
            <th>price</th>
            <th>stock</th>
            <th>manufacture_name</th>
            <th>comment</th>
            <th>img_path</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td style="text-align:right">{{ $product->id }}</td>
            <td>{{ $product->product_name }}</td>
            <td style="text-align:right">{{ $product->price }}円</td>
            <td style="text-align:right">{{ $product->stock }}本</td>
            <td style="text-align:right">{{ $product->manufacture_name }}</td>
            <td style="text-align:right">{{ $product->comment }}</td>
            <td style="text-align:right">{{ $product->img_path }}</td>
            <td style="text-align:center">
            <form action="{{route('products.destroy',$product->id)}}"method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
            </form>
            </td>
            <td><a href="{{ route('products.show', ['id'=> $product->id]) }}" class="btn btn-primary">詳細</a></td>
            <td><a href="{{ route('products.edit', ['id'=> $product->id]) }}" class="btn btn-info">編集</a></td>

        </tr>
        @endforeach
    </table>
 

@endsection
