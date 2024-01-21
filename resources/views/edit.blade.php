@extends('app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:2rem; margin-bottom: 60px;">商品編集画面(ここはedit.blade.php)</h2>
        </div>
    </div>
</div>
 
<div style="text-align:center;">
<!-- ここはcreateと違う中身 -->
<form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    
    <div class="row">
        <!-- ID -->
        <div class="mb-1">
            <dl style="display: flex;flex-wrap: wrap; margin-top: 10px; margin-bottom: 1rem;">
                <dt style=" width: 30%;"><label for="ID" class="form-label">ID</label></dt>
                <dd style=" width: 70%; text-align:left;">商品情報ID:{{ $product->id }}</dd>
            </dl>
        </div>

        <!-- 商品名 -->
        <div class="mb-1">
            <div class="form-group">
                <dl style=" display: flex;flex-wrap: wrap;">
                    <dt style=" width: 30%;"><label for="product_name" class="form-label">商品名</label></dt>
                    <dd style=" width: 70%;"><input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" placeholder="名前"></dd>
                        @error('product_name')
                        <span style="color:red;">名前を20文字以内で入力してください</span>
                        @enderror
                </dl>
            </div>
        </div>

        <!-- メーカー名 -->
        <div class="mb-3">
            <dl style=" display: flex;flex-wrap: wrap;">
                <dt style=" width: 30%;"><label for="product_name" class="form-label">メーカー名</label></dt>
                    <dd style=" width: 70%;">
                        <select name="company_id" class="form-select">
                            <option>メーカー名を選択してください</otion>
                            @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"@if($company->id==$product->company_id) selected @endif>{{ $company->company_name }}</otion>
                                @endforeach
                        </select>
                    </dd>
                    @error('company')
                        <span style="color:red;">メーカー名を選択してください</span>
                    @enderror
            </dl>
        </div>

        <!-- 価格 -->
        <div class="mb-1">
            <div class="form-group">
                <dl style=" display: flex;flex-wrap: wrap;">
                <dt style=" width: 30%;"><label for="price" class="form-label">価格</label></dt>
                    <dd style=" width: 70%;"><input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="価格"></dd>
                        @error('product_name')
                        <span style="color:red;">価格を数字で入力してください</span>
                        @enderror
                </dl>
            </div>
        </div>



        <!-- 在庫数 -->
        <div class="mb-3">
            <dl style=" display: flex;flex-wrap: wrap;">
                <dt style=" width: 30%;"><label for="stock" class="form-label">在庫数</label></dt>
                <dd style=" width: 70%;"><input type="text" name="stock" value="{{ $product->stock }}" class="form-control" placeholder="在庫数"></dd>
                @error('stock')
                    <span style="color:red;">在庫数を数字で入力してください</span>
                @enderror
            </dl>
        </div>

        <!-- コメント -->
        <div class="mb-3">
            <dl style=" display: flex;flex-wrap: wrap;">
            <dt style=" width: 30%;"><label for="comment" class="form-label">コメント</label></dt>
            <dd style=" width: 70%;"><textarea class="form-control" style="height:100px" name="comment" placeholder="コメント">{{ $product->comment }}</textarea></dd>
            @error('comment')
                <span style="color:red;">コメントを140文字以内で入力してください</span>
            @enderror
            </dl>
        </div>

        <!-- 商品画像 -->
        <div class="mb-3">
            <dl style=" display: flex;flex-wrap: wrap;">
                <dt style=" width: 30%;"><label for="img_path" class="font-semibold leading-none mt-4" style=" margin-top: -1.5rem!important;">商品画像 （1MBまで）</label></dt>
                <dd style=" width: 70%;"><input id="img_path" type="file" name="img_path"></dd>
            </dl>
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