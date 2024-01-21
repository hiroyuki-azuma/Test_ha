@extends('app')
   
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:2rem;">商品新規登録画面(ここはcreate.blade.php)</h2>
        </div>
    </div>
</div>
 
<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     
    <!-- 商品名 -->
    <div class="mb-3">
        <dl style="display: flex;flex-wrap: wrap; margin-top: 60px; margin-bottom: 1rem;">
            <dt style=" width: 30%;"><label for="product_name" class="form-label">商品名</label></dt>
            <dd style=" width: 70%;"><input type="text" name="product_name" class="form-control" placeholder="名前"></dd>
        </dl>
    </div>

    <!-- 商品名 -->
    <div class="mb-3">
        <dl style="display: flex;flex-wrap: wrap; margin-bottom: 1rem;">
            <dt style=" width: 30%;"><label for="product_name" class="form-label">商品名</label></dt>
            <dd style=" width: 70%;"><input id="product_name" type="text" name="product_name" class="form-control" required></dd>
        </dl>
    </div>

    <!-- 商品名 -->
    <div class="mb-3">
        <dl style="display: flex;flex-wrap: wrap; margin-bottom: 1rem;">
            <dt style=" width: 30%;"><label for="product_name" class="form-label">商品名</label></dt>
            <dd style=" width: 70%;"><input id="product_name" type="text" name="product_name" class="form-control" required></dd>
        </dl>
    </div>

    <!-- 商品名 -->
    <div class="mb-3">
        <dl style="display: flex;flex-wrap: wrap; margin-bottom: 1rem;">
            <dt style=" width: 30%;"><label for="product_name" class="form-label">商品名</label></dt>
            <dd style=" width: 70%;"><input id="product_name" type="text" name="product_name" class="form-control" required></dd>
        </dl>
    </div>

    <!-- 商品名 -->
    <div class="mb-3">
        <dl style="display: flex;flex-wrap: wrap; margin-bottom: 1rem;">
            <dt style=" width: 30%;"><label for="product_name" class="form-label">商品名</label></dt>
            <dd style=" width: 70%;"><input id="product_name" type="text" name="product_name" class="form-control" required></dd>
        </dl>
    </div>

    <!-- 商品名 -->
    <div class="mb-3">
        <dl style="display: flex;flex-wrap: wrap; margin-bottom: 1rem;">
            <dt style=" width: 30%;"><label for="product_name" class="form-label">商品名</label></dt>
            <dd style=" width: 70%;"><input id="product_name" type="text" name="product_name" class="form-control" required></dd>
        </dl>
    </div>


        <!-- ここは名前 -->
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <h4 style="text-align:left">商品名</h4>
            <!-- <h4>商品名</h4> -->
                <input type="text" name="product_name" class="form-control" placeholder="名前">
                @error('product_name')
                <span style="color:red; float: left;">名前を20文字以内で入力してください</span>
                @enderror
            </div>
        </div>

        <!-- メーカー選択ここから -->
        <div class="col-12 mb-2 mt-2">
            <h4 style="text-align:left">メーカー名</h4>
            <div class="form-group">
                <select name="company_id" class="form-select">
                    <option>メーカー名を選択してください</otion>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</otion>
                    @endforeach
                </select>
                @error('company')
                <span style="color:red; float: left;">メーカー名を選択してください</span>
                @enderror
            </div>
        </div>
        
        <!-- ここは価格 -->
        <div style="margin: bottom 100px;">
        <!-- <div class="col-12 mb-2 mt-2"  style="margin: bottom 100px;"> -->
            <h4 style="text-align:left">価格</h4>
            <div class="form-group">
                <input type="text" name="price" class="form-control" placeholder="価格">
                @error('price')
                <span style="color:red; float: left;">価格を半角数字で入力してください</span>
                @enderror
            </div>
        </div>

        <!-- ここは在庫数 -->
        <div class="col-12 mb-2 mt-2">
            <h4 style="text-align:left">在庫数</h4>
            <div class="form-group">
                <input type="text" name="stock" class="form-control" placeholder="在庫数">
                @error('stock')
                <span style="color:red; float: left;">在庫数を半角数字で入力してください</span>
                @enderror
            </div>
        </div>

        <!-- ここはコメント -->
        <div class="col-12 mb-2 mt-2">
            <h4 style="text-align:left">コメント</h4>
            <div class="form-group">
            <textarea class="form-control" style="height:100px" name="comment" placeholder="コメント"></textarea>
            @error('comment')
                <span style="color:red; float: left;">コメントを140文字以内で入力してください</span>
                @enderror
            </div>
        </div>

        <!-- ここは商品画像 -->
        <div style="text-align:left;" class="col-12 mb-2 mt-2">
            <div class="form-group">
            <h4 style="text-align:left">商品画像</h4>
                <label for="img_path" class="font-semibold leading-none mt-4">商品画像 （1MBまで）</label>
                <div>
                    <input id="img_path" type="file" name="img_path">
                </div>
            </div>
        </div>
        
        <!-- ボタンここから -->
        <div class="pull-right" style="text-align:center;">
            <button type="submit" class="btn btn-primary btn-lg mt-2">登録</button>

            <button type="button"  class="btn btn-warning btn-lg mt-2" >
                <a style="text-decoration: none; color : #ffffff;" href="{{ url('/products') }}">戻る</a>
            </button>
        </div>

</form>
@endsection