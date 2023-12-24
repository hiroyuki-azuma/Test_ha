@extends('app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">文房具登録画面(ここはshow.blade.php)</h2>
        </div>

    </div>
</div>
 
<div style="text-align:left;">
<!-- ここはeditと違う中身 -->
    <div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                {{ $product->product_name }}                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                {{ $product->price }}                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                @foreach ($companies as $company)
                    @if($company->id==$product->company) {{ $company->company_name }} @endif
                @endforeach         
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            {{ $product->comment }}                
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