@extends('app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:2rem; margin-bottom: 60px;">商品詳細画面(ここはshow.blade.php)</h2>
            <!-- <h2 style="font-size:2rem;text-align:center;">商品詳細画面(ここはshow.blade.php)</h2> -->
        </div>

    </div>
</div>
 
<div style="text-align:left;">
<!-- ここはeditと違う中身 -->
    <div class="row">
    
        <!-- 商品ID -->
        <dl class="row mt-3" >
            <dt class="col-sm-3">商品ID</dt>
            <dd class="col-sm-9">{{ $product->id }}</dd>
        </dl>

        <!-- 商品画像 -->
        <dl class="row mt-3" >
            <dt class="col-sm-3">商品画像</dt>
            <dd class="col-sm-9">
                @if($product->img_path)
                    <img src="{{ asset('storage/images/'.$product->img_path)}}" class="mx-auto" style="height:50px;">
                    <div>(画像ファイル：{{$product->img_path}})</div>
                @endif
            </dd>
        </dl>

        <!-- 商品名 -->
        <dl class="row mt-3" >
            <dt class="col-sm-3">商品名</dt>
            <dd class="col-sm-9">{{ $product->product_name }}</dd>
        </dl>

        <!-- メーカー名 -->
        <dl class="row mt-3" >
            <dt class="col-sm-3">メーカー名</dt>
            <dd class="col-sm-9">
                 @foreach ($companies as $company)
                        @if($company->id==$product->company_id)<h6>{{ $company->company_name }}</h6>@endif
                @endforeach
            </dd>
        </dl>

        <!-- 価格 -->
        <dl class="row mt-3" >
            <dt class="col-sm-3">価格</dt>
            <dd class="col-sm-9">{{ $product->price }}</dd>
        </dl>

        <!-- 在庫数 -->
        <dl class="row mt-3" >
            <dt class="col-sm-3">在庫数</dt>
            <dd class="col-sm-9">{{ $product->stock }}</dd>
        </dl>

        <!-- コメント -->
        <dl class="row mt-3" >
            <dt class="col-sm-3">コメント</dt>
            <dd class="col-sm-9">{{ $product->comment }}</dd>
        </dl>

    </div>
</div>


<div style="text-align:center;">
    <form action="{{ route('product.edit',$product->id) }}" method="put">

        @csrf
        
        <!-- ボタンここから -->
        <div class="pull-right">
        <button type="submit" class="btn btn-primary btn-lg mt-2">  編集  </button>

        <button type="button"  class="btn btn-warning btn-lg mt-2" >
            <a style="text-decoration: none; color : #ffffff;" href="{{ url('/products') }}">  戻る  </a>
        </button>
        </div>
    </form>
</div>
@endsection