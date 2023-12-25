@extends('app')

  
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:2rem;">商品一覧ページ（ここはindex.blade.php）</h2>
            </div>


        <!-- //* 検索機能ここから *// -->
        <div class="col-12 mb-1 mt-5">
        <form action="{{ route('products.index') }}" method="GET">
            <input type="text" name="keyword" value="{{ $keyword }}">
                <input type="submit" value="検索">
            </form>
        </div>
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
    <table class="table table-bordered">
        <tr>
            <th>商品番号</th>
            <th>ドリンク名</th>
            <th>価格</th>
            <th>メーカー</th>
            <th></th>
            <th></th>

        </tr>
        @foreach ($products as $product)
        <tr>
            <td style="text-align:left">{{ $product->id }}</td>
            <td>{{ $product->product_name }}</td>
            <!-- <td><a href="{{ route('product.show',$product->id) }}">{{ $product->product_name }}</a></td> -->
            <td style="text-align:left">{{ $product->price }}円</td>
            <!-- ↓ここのみCompanyテーブルからデータを持ってくる -->
            <td style="text-align:left">{{ $product->company }}</td>
            <td style="text-align:center">
              <!-- <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">変更</a> -->
              <a class="btn btn-sm btn-primary" href="{{ route('product.show',$product->id) }}">詳細</a>
            </td>

            <!-- 削除ボタン追記ここから -->
            <td style="text-align:center">
                <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
                </form>
            </td>
            <!-- 削除ボタン追記ここまで -->


        </tr>
        @endforeach
    </table>

    <!-- ここまでコンテンツ -->

@endsection
