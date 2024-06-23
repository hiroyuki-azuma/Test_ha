<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// 下記は追記
// Productモデルを使用
use App\Models\Product;
// Saleモデルを使用
use App\Models\Sale;

class SalesController extends Controller {

    public function purchase( Request $request ) {

        DB::transaction(function () {
        // ① salesテーブルにレコードを追加する
        // 自動販売機から「売れた商品 = 商品ID」の情報を取得する
        $soldItemsID = $request->input( 'product_id' );

            // 登録を行う前の在庫チェック
        // ③ 在庫が0の商品を購入しようとした場合、エラーとなり購入できないこと
        // もしも在庫がない（０以下の）商品の場合、エラーにする
        if ( $product->stock <= 0 ) {
            return response()->json( '在庫がありません' );
            // throw new Exception('在庫がありません');
        }

            // 在庫を引く
        // ② productsテーブルの在庫数を減算する
        // リクエスト（削除）された商品を一つ減らす
        $sales = Product::where( 'id', $request->id )->decrementQuantity( 'stock', 1 );
        
        //salesテーブルへの登録処理
        // ① salesテーブルにレコードを追加する
        $sale = new Sale([
            'product_id' => $soldItemsID,
        ]);

        $sales->save();
        return response()->json( '購入成功' );
        });   
    }
}


