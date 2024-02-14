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

        //メーカー名が選択された場合、companiesテーブルからcompany_idが一致する商品を$queryに代入
        if ( !empty( $company_id ) ) {
            $query->where( 'company_id', 'LIKE', $company_id );
        }

        //下記を表示させるとキーワード検索とプルダウンは機能する。全件表示されない。キーワード検索ボックスに何もいれないで「検索」ボタンを押すとデータを引っ張ってこなくなる。
        $products = $query->get();

        // 下記を表示させると全件表示されるが検索できなくなる。
        // $products = Product::all();

        // Companyのデータを全部持ってくる。
        $companies = Company::all();


        // dd( $company_id );

        return view( 'index', compact( 'products', 'keyword', 'companies', 'company_id') );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        $companies = Company::all();
        return view( 'create' )
        ->with( 'companies', $companies );
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

        // return redirect()->route( 'products.index' );

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

        // return redirect()->route( 'products.index' );
        // 成功しましたメッセージ
        return redirect()->route( 'products.index' )->with( 'success', '商品を更新しました' );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */

    public function destroy( Product $product ) {
        $product->delete();
        return redirect()->route( 'products.index' )
        ->with( 'success', '商品'.$product->product_name.'を削除しました' );
    }
}
