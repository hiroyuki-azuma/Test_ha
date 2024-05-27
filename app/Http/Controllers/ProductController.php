<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
// 下記は追記しました
use App\Models\Company;

class ProductController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index( Request $request ) {

        // キーワード検索フォームに入力された値を取得
        $keyword = $request->input( 'keyword' );
        // セレクトボックス検索フォームに入力された値を取得。
        $company_id = $request->input( 'company_id' );

        $query = Product::query();

        // もしキーワード検索がされたら、productsテーブルから一致する商品を$queryに代入
        if ( !empty( $keyword ) ) {
            $query->where( 'product_name', 'LIKE', "%{$keyword}%" );
        }

            // 最小価格が指定されている場合、その価格以上の商品をクエリに追加
    if($min_price = $request->min_price){
        $query->where('price', '>=', $min_price);
    }

    // 最大価格が指定されている場合、その価格以下の商品をクエリに追加
    if($max_price = $request->max_price){
        $query->where('price', '<=', $max_price);
    }

    // 最小在庫数が指定されている場合、その在庫数以上の商品をクエリに追加
    if($min_stock = $request->min_stock){
        $query->where('stock', '>=', $min_stock);
    }

    // 最大在庫数が指定されている場合、その在庫数以下の商品をクエリに追加
    if($max_stock = $request->max_stock){
        $query->where('stock', '<=', $max_stock);
    }

        //メーカー名が選択された場合、companiesテーブルからcompany_idが一致する商品を$queryに代入
        if ( !empty( $company_id ) ) {
            $query->where( 'company_id', '=', $company_id );
        }
    
        $products = $query->get();

        // Companyのデータを全部持ってくる。
        $companies = Company::all();

        return view( 'index', compact( 'products', 'keyword', 'companies', 'company_id') );
        // 非同期処理用に追記
        // return response()->json($products,$companies);


    }


    public function getUsersBySearchName($userName)
    {
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create(Request $request) {
        $companies = Company::all();
        return view( 'create' )
        ->with( 'companies', $companies );

        try {
            // トランザクションの開始
            \DB::beginTransaction();

            if ($request->hasFile('image')) {
                // 画像の保存処理 成功したらファイル名 失敗したら例外を返す
                $image_path = Company::IMAGE_DIR . Company::saveImage($request->file('image'));
            }

            // データの作成（この時点ではDBには保存されない）
            $companies = Company::make($request->all());
            $companies->image_path = $image_path ?? '';

            // 作成したデータをDBに保存 失敗したら例外を返す
            $companies->saveOrFail();

            // 全ての保存処理が成功したので処理を確定する
            \DB::commit();

            return ['message' => '保存に成功しました。'];
        } catch (\Throwable $e) {
            // 例外が起きたらロールバックを行う
            \DB::rollback();

            // 失敗した原因をログに残す
            \Log::error($e);

            // フロントにエラーを通知
            throw $e;
        }
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $request->validate( [
            'company_id' => 'required|integer',
            'product_name' => 'required|max:20',
            'img_path'=>'image|max:1024',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:140',
        ] );

        $product = new Product;
        $product->company_id = $request->input( [ 'company_id' ] );
        $product->product_name = $request->input( [ 'product_name' ] );
        $product->price = $request->input( [ 'price' ] );
        $product->stock = $request->input( [ 'stock' ] );
        $product->comment = $request->input( [ 'comment' ] );

        // 画像保存用のソース
        if ( request( 'img_path' ) ) {
            $name = request()->file( 'img_path' )->getClientOriginalName();
            request()->file( 'img_path' )->move( 'storage/images', $name );
            $product->img_path = $name;
        }

        $product->save();

        // 成功しましたメッセージ
        return redirect()->route( 'products.index' )->with( 'success', '商品を登録しました' );

    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */

    public function show( Product $product ) {
        $companies = Company::all();
        return view( 'show', compact( 'product' ) )
        ->with( 'companies', $companies );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */

    public function edit( Product $product ) {
        $companies = Company::all();
        return view( 'edit', compact( 'product' ) )
        ->with( 'companies', $companies );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Product $product ) {
        $request->validate( [
            'company_id' => 'required|integer',
            'product_name' => 'required|max:20',
            'img_path'=>'image|max:1024',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:140',
        ] );

        $product->company_id = $request->input( [ 'company_id' ] );
        $product->product_name = $request->input( [ 'product_name' ] );
        $product->price = $request->input( [ 'price' ] );
        $product->stock = $request->input( [ 'stock' ] );
        $product->comment = $request->input( [ 'comment' ] );

        // 画像保存用のソース
        if ( request( 'img_path' ) ) {
            $name = request()->file( 'img_path' )->getClientOriginalName();
            request()->file( 'img_path' )->move( 'storage/images', $name );
            $product->img_path = $name;
        }

        $product->save();

        // 成功しましたメッセージ
        return redirect()->route( 'products.index' )->with( 'success', '商品を更新しました' );

        try {
            // トランザクションの開始
            \DB::beginTransaction();

            // 更新対象の商品を検索
            $product = Product::findOrFail($id);

            if ($request->hasFile('image')) {
                // 画像の更新処理 成功したらファイル名 失敗したら例外を返す
                $image_path = Product::IMAGE_DIR . Product::updateImage($request->file('image'), $product->image_path);
            }

            // データの更新（この時点ではDBのデータは更新されない）
            $product->fill($request->all());
            $product->image_path = $image_path ?? '';

            // 更新したデータをDBに保存 失敗したら例外を返す
            $product->saveOrFail();

            // 全ての更新処理が成功したので処理を確定する
            \DB::commit();

            return ['message' => '更新に成功しました。'];
        } catch (ModelNotFoundException $e) {
            // データが見つからなかっただけならロギング不要
            throw $e;
        } catch (\Throwable $e) {
            // 例外が起きたらロールバックを行う
            \DB::rollback();

            // 失敗した原因をログに残す
            \Log::error($e);

            // フロントにエラーを通知
            throw $e;
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */

    public function destroy($product) {

        try {
            Product::destroy($product);
            return ['message' => '削除しました。'];

        } catch (\Throwable $e) {
            \Log::error($e);
            throw $e;
        }

    }
}
