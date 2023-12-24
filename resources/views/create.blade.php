@extends('app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:2rem;">商品新規登録画面(ここはcreate.blade.php)</h2>
        </div>
    </div>
</div>
 
<div style="text-align:center;">
<form action="{{ route('product.store') }}" method="POST">
    @csrf
     
     <div class="row">

        <!-- ここは名前 -->
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="product_name" class="form-control" placeholder="名前">
                @error('product_name')
                <span style="color:red; float: left;">名前を20文字以内で入力してください</span>
                @enderror
            </div>
        </div>

        <!-- ここは価格 -->
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="price" class="form-control" placeholder="価格">
                @error('price')
                <span style="color:red; float: left;">名前を20文字以内で入力してください</span>
                @enderror
            </div>
        </div>

        <!-- ここはコメント -->
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <textarea class="form-control" style="height:100px" name="comment" placeholder="コメント"></textarea>
            @error('comment')
                <span style="color:red; float: left;">なんか書いてよーーーーー</span>
                @enderror
            </div>
        </div>

        <!-- メーカー選択ここから -->
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <select name="company" class="form-select">
                    <option>分類を選択してください</otion>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</otion>
                    @endforeach
                </select>
                @error('company')
                <span style="color:red; float: left;">名前を20文字以内で入力してください</span>
                @enderror
            </div>
        </div>
        
        <!-- ボタンここから -->
        <div class="pull-right">
            <button type="submit" class="btn btn-primary btn-lg mt-2">登録</button>

            <button type="button"  class="btn btn-warning btn-lg mt-2" >
                <a style="text-decoration: none; color : #ffffff;" href="{{ url('/products') }}">戻る</a>
            </button>
        </div>

    </div>      
</form>
</div>
@endsection