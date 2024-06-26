<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// 下記は追記
// Productモデルを使用
use App\Models\Product;
// Saleモデルを使用
use App\Models\Sale;
// DBクラスの使用を追加
use Illuminate\Support\Facades\DB; 
use Exception;


class SalesController extends Controller {

    public function purchase(Request $request) {

        try {
            DB::transaction(function () use ($request) {

                // ① salesテーブルにレコードを追加する
                // 自動販売機から「売れた商品 = 商品ID」の情報を取得する
                $soldItemsID = $request->input('product_id');

                // 登録を行う前の在庫チェック
                $product = Product::find($soldItemsID);

                // ③ 在庫が0の商品を購入しようとした場合、エラーとなり購入できないこと
                if (!$product) {
                    throw new Exception('商品が見つかりません');
                }

                if ($product->stock <= 0) {
                    throw new Exception('在庫がありません');
                }

                // ② productsテーブルの在庫数を減算する
                // リクエスト（削除）された商品を一つ減らす
                $product->decrement('stock', 1);

                //  ① salesテーブルにレコードを追加する
                $sale = new Sale([
                    'product_id' => $soldItemsID,
                ]);

                $sale->save();

                return response()->json('購入成功');
            });

        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400); // エラーメッセージを返す
        }
    }
}

