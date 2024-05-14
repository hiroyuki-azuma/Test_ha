console.log('Hello World');

// 検索機能の非同期処理化
//まずはフォームの入力値を取得
//serializeでフォームタグの入力値を一括取得できる。
let formData = $('#search').serialize();


// 検索ボタンをクリックしたら発火させる
$('#form-btn').on("click",function(){
  $.ajax({
  type:"get",       
  url: '/products', //web.phpのURLと同じ形にする
  //jsonでも良いのだが、コントローラーから前の通りreturn viewで
  //返した方が楽なのでおすすめ
  dataType:"html", 
  data: formData //追加。フォームの値を送る。

})
// 通信が成功した時
.done(function() {

// 変数let itemsに親要素tableからtdタグの要素を抽出
  // let items = $("table").find("td");
  // let items = table.filter(td);
  let items = table.filter( function (value) {
    // tdを抽出
    return value === td;
  })

  // console.log(items);

  // 現在表示されている検索結果反映前のテーブルlet formDataを上記で抽出した新しいテーブルlet itemsに差し替え
  $("formData").replaceWith("items");

});
});


// 削除処理の非同期処理化
// 削除処理についても非同期にて行われるよう改修する
// 削除を行なった商品については、画面更新せずに一覧から非表示となること




