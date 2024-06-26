@extends('app')

  
@section('content')
    <div class="row" id="headpart">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:2rem; margin-bottom: 100px;">商品一覧画面</h2>
            </div>

            <h4>検索条件で絞り込み</h4>

        <!-- //* 検索機能ここから *// -->
            <form action="{{ route('products.index') }}" method="GET" class="row g-3" id="search">

                <!-- キーワード検索の入力欄 -->
                <div class="col-sm-12 col-md-3">
                    <input type="text" name="keyword" value="{{ $keyword }}" placeholder="検索したい商品名">
                </div>

                <!-- 最小価格の入力欄 -->
                <div class="col-sm-12 col-md-2">
                    <input type="number" name="min_price"  placeholder="最小価格" value="{{ request('min_price') }}">
                </div>

                <!-- 最大価格の入力欄 -->
                <div class="col-sm-12 col-md-2">
                    <input type="number" name="max_price"  placeholder="最大価格" value="{{ request('max_price') }}">
                </div>

                <!-- 最小在庫数の入力欄 -->
                <div class="col-sm-12 col-md-2">
                    <input type="number" name="min_stock"  placeholder="最小在庫" value="{{ request('min_stock') }}">
                </div>

                <!-- 最大在庫数の入力欄 -->
                <div class="col-sm-12 col-md-2">
                    <input type="number" name="max_stock"  placeholder="最大在庫" value="{{ request('max_stock') }}">
                </div>


                <select name="company_id" class="form-select">
                    <option value="">メーカー名を選択してください</option>
                    @foreach ($companies as $company)
                    <!-- セレクトボックスのオプション「メーカーを選択してください」にvalueが設定されていないため、何も選択していないと値が「メーカーを選択してください」になってしまうため、value=""で対応。 -->
                        <option value="{{ $company->id }}" @if(old('company_id', $company_id ?? '') == $company->id) selected @endif>{{ $company->company_name }}</option>

                    @endforeach
                </select>

                <!-- 非同期処理用にid="form-btn"を追記 -->
                <div class="col-sm-12 col-md-1">
                    <!-- <input type="submit" value="検索" class="form-btn"> -->
                    <button class="btn btn-outline-secondary" type="submit" id="form-btn">検索</button>
                </div>

            </form>

                <!-- 検索条件をリセットするためのリンクボタン -->
                <a href="{{ route('products.index') }}" class="btn btn-success mt-3">検索条件を元に戻す</a>
        <!-- //*検索機能ここまで*// -->

            <div class="text-left" style="text-align:right;">
                <!-- <a class="btn btn-success" href="#">新規登録</a> -->
                <a class="btn btn-success" href="{{ route('product.create') }}">新規登録</a>
            </div>
        </div>
    </div>

    <!-- 成功しましたメッセージ -->
    <div class="row">
        <div class="col-lg-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success mt-1"><p>{{ $message }}</p></div>
            @endif
        </div>
    </div>


    <!-- ここからコンテンツ -->
    <table class="table table-bordered" id="targetTable">
        <tr>
            <th>@sortablelink('id', '商品番号')</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>@sortablelink('price', '価格')</th>
            <th>@sortablelink('stock', '在庫数')</th>
            <th>メーカー</th>


            <!-- <th>商品画像</th>
            <th>ドリンク名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー</th> -->
            <th></th>
            <th></th>

        </tr>
        @foreach ($products as $product)
        <tr>
            <td style="text-align:left">{{ $product->id }}</td>

            <td style="text-align:left">
                @if($product->img_path)
                    <div>(画像ファイル：{{$product->img_path}})</div>
                    <img src="{{ asset('storage/images/'.$product->img_path)}}" class="mx-auto" style="height:50px;">
                @endif
            </td>

            <td>{{ $product->product_name }}</td>
            <td style="text-align:left">{{ $product->price }}円</td>
            <td style="text-align:left">{{ $product->stock }}個</td>
            <!-- ↓ここのみCompanyテーブルからデータを持ってくる -->
            <td style="text-align:left">{{ $product->company->company_name }}</td>
            <td style="text-align:center">
              <a class="btn btn-sm btn-primary" href="{{ route('product.show',$product->id) }}">詳細</a>
            </td>

            <!-- 削除ボタン追記ここから -->
            <td style="text-align:center">
                <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");' id="delete-btn">削除</button>
                </form>
            </td>
            <!-- 削除ボタン追記ここまで -->

        </tr>
        @endforeach
    </table>
    <!-- ここまでコンテンツ -->
     <!-- JavaScriptでソートを実装 -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let headers = document.querySelectorAll('#targetTable th');
        headers.forEach(function (header) {
            header.addEventListener('click', function () {
                let link = this.querySelector('a');
                if (link) {
                    window.location.href = link.href;
                }
            });
        });
    });
</script>


@endsection
