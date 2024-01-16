@extends('app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:2rem;">商品編集画面(ここはedit.blade.php)</h2>
        </div>
    </div>
</div>
 
<div style="text-align:center;">
<!-- ここはcreateと違う中身 -->
<form action="{{ route('product.update',$product->id) }}" method="POST">
    @method('PUT')
    @csrf
    


    <div class="row">

        <!-- 商品画像 -->
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <textarea class="form-control" style="height:100px" name="img_path" placeholder="商品画像">{{ $product->img_path }}</textarea>
                @error('img_path')
                <span style="color:red;">商品画像を140文字以内で入力してください</span>
                @enderror
            </div>
        </div>

        <!-- 商品名 -->
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" placeholder="名前">
                @error('product_name')
                <span style="color:red;">名前を20文字以内で入力してください</span>
                @enderror
            </div>
        </div>

        <!-- 価格 -->
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="価格">
                @error('price')
                <span style="color:red;">価格を数字で入力してください</span>
                @enderror
            </div>
        </div>

        <!-- 在庫数 -->
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="stock" value="{{ $product->stock }}" class="form-control" placeholder="在庫数">
                @error('stock')
                <span style="color:red;">在庫数を数字で入力してください</span>
                @enderror
            </div>
        </div>

        <!-- メーカー -->
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <select name="company_id" class="form-select">
                    <option>分類を選択してください</otion>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}"@if($company->id==$product->company_id) selected @endif>{{ $company->company_name }}</otion>
                    @endforeach
                </select>
                @error('company')
                <span style="color:red;">分類を選択してください</span>
                @enderror
            </div>
        </div>

        <!-- コメント -->
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <textarea class="form-control" style="height:100px" name="comment" placeholder="詳細">{{ $product->comment }}</textarea>
                @error('comment')
                <span style="color:red;">詳細を140文字以内で入力してください</span>
                @enderror
            </div>
        </div>


        <!-- ボタンここから -->
        <div class="pull-right">
            <button type="submit" class="btn btn-primary btn-lg mt-2">  更新  </button>

            <button type="button"  class="btn btn-warning btn-lg mt-2" >
                <a style="text-decoration: none; color : #ffffff;" href="{{ route('product.show',$product->id) }}">  戻る  </a>
            </button>
        </div>


    </div>      
</form>
</div>
@endsection