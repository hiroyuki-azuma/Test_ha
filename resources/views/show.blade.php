@extends('app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:2rem;">商品詳細画面(ここはshow.blade.php)</h2>
            <!-- <h2 style="font-size:2rem;text-align:center;">商品詳細画面(ここはshow.blade.php)</h2> -->

        </div>

    </div>
</div>
 
<div style="text-align:left;">
<!-- ここはeditと違う中身 -->
    <div class="row">

        <div class="col-12 mb-2 mt-2">
            <h3 class="form-group">ID:{{ $product->id }}</h3>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <h4>商品画像
                @if($product->img_path)
                    <div>(画像ファイル：{{$product->img_path}})</div>
                    <img src="{{ asset('storage/images/'.$product->img_path)}}" class="mx-auto" style="height:50px;">
                @endif   </h4>           
            </div>
        </div>



        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <h4>商品名：{{ $product->product_name }}</h4>              
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                @foreach ($companies as $company)
                    @if($company->id==$product->company_id)<h4> メーカー名： {{ $company->company_name }}</h4>@endif
                @endforeach         
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <h4>価格：{{ $product->price }}</h4>            
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <h4>在庫数：{{ $product->stock }}</h4>          
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <h4>コメント：{{ $product->comment }}</h4>          
            </div>
        </div>
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