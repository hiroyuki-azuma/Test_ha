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

    public function index(Request $request) {

        
        $keyword = $request->input('keyword');

        $query = Product::query();


        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%")
                ->orWhere('company_id', 'LIKE', "%{$keyword}%");
        }

        $products = $query->get();

        

        return view('index', compact('products', 'keyword'));
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
            'price' => 'required|integer',
            // 'company' => 'required|integer',
            'comment' => 'required|max:140',
        ] );

        $product = new Product;
        $product->company_id = $request->input( [ "company_id" ] );
        $product->product_name = $request->input( [ "product_name" ] );
        $product->price = $request->input( [ "price" ] );
        // $product->company = $request->input( [ "company" ] );
        $product->comment = $request->input( [ "comment" ] );
        $product->save();

        // return redirect()->route('products.index');
        
        // 成功しましたメッセージ
        return redirect()->route('products.index')->with('success','商品を登録しました');


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
            'company_id' => 'required|integer',
            'product_name' => 'required|max:20',
            'price' => 'required|integer',
            // 'company' => 'required|integer',
            'comment' => 'required|max:140',
        ] );

        $product->company_id = $request->input( [ "company_id" ] );
        $product->product_name = $request->input( [ "product_name" ] );
        $product->price = $request->input( [ "price" ] );
        // $product->company = $request->input( [ "company" ] );
        $product->comment = $request->input( [ "comment" ] );
        $product->save();

        // return redirect()->route('products.index');
        // 成功しましたメッセージ
        return redirect()->route('products.index')->with('success','商品を更新しました');
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
        ->with('success','商品'.$product->product_name.'を削除しました');
    }
}
