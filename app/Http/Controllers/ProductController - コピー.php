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

    public function index() {
        // $products = Product::latest()->paginate( 5 );

                // 結合のタイミングで追記
                $products = Product::select([
                    'b.id',
                    'b.product_name',
                    'b.price',
                    'b.comment',
                    'r.company_name as company',
                    ])
                    ->from('products as b')
                    ->join('companies as r', function($join) {
                    $join->on('b.company', '=', 'r.id');
                    })
                    ->orderBy('b.id', 'DESC')
                    ->paginate(20);

        return view( 'index', compact( 'products' ) )
        ->with( 'i', ( request()->input( 'page', 1 ) - 1 ) * 5 );
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
            'product_name' => 'required|max:20',
            'price' => 'required|integer',
            'company' => 'required|integer',
            'comment' => 'required|max:140',
        ] );

        $product = new Product;
        $product->product_name = $request->input( [ "product_name" ] );
        $product->price = $request->input( [ "price" ] );
        $product->company = $request->input( [ "company" ] );
        $product->comment = $request->input( [ "comment" ] );
        $product->save();

        // return redirect()->route('products.index');
        
        // 成功しましたメッセージ
        return redirect()->route('products.index')->with('success','文房具を登録しました');


    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */

    public function show( Product $product ) {
        $companies = Company::all();
        return view('show',compact('product'))
        ->with('companies',$companies);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */

    public function edit( Product $product ) {
        $companies = Company::all();
        return view('edit',compact('product'))
        ->with('companies',$companies);
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
            'product_name' => 'required|max:20',
            'price' => 'required|integer',
            'company' => 'required|integer',
            'comment' => 'required|max:140',
        ] );

        $product->product_name = $request->input( [ "product_name" ] );
        $product->price = $request->input( [ "price" ] );
        $product->company = $request->input( [ "company" ] );
        $product->comment = $request->input( [ "comment" ] );
        $product->save();

        // return redirect()->route('products.index');
        // 成功しましたメッセージ
        return redirect()->route('products.index')->with('success','文房具を更新しました');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */

    public function destroy( Product $product ) {
        $product->delete();
        return redirect()->route('products.index')
        ->with('success','文房具'.$product->product_name.'を削除しました');
    }
}
