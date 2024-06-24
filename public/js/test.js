console.log('Hello World');


// 検索機能の非同期処理化
//まずはフォームの入力値を取得
//serializeでフォームタグの入力値を一括取得できる。
let formData = $('#search').serialize();

// 検索ボタンをクリックしたら発火させる
$("#form-btn").click(function () {
  $.ajax({
    type: "GET",
    url: "/products",
    dataType: 'html',
    data: formData //追加。フォームの値を送る。
  })
    .done(function () {
      //通信成功で実行される処理
      console.log('通信成功');

      // 変数let itemsに親要素tableからtdタグの要素を抽出
      // let items = $("table").find("td");
      // let items = table.filter(td);
      let items = table.filter(function (value) {
        // tdを抽出
        return value === td;
      })

      // 現在表示されている検索結果反映前のテーブルlet formDataを上記で抽出した新しいテーブルlet itemsに差し替え
      $("formData").replaceWith("items");


    })
    .fail(function () {
      //通信が失敗した時に実行される処理
      console.log('通信が失敗');
    })
    .always(function () {
      //通信の成功と失敗に関わらず実行される処理
      console.log('通信が完了');
    });
});



// 削除処理の非同期処理化
// 削除処理についても非同期にて行われるよう改修する
// 削除を行なった商品については、画面更新せずに一覧から非表示となること

$("#delete-btn").click(function () {
  $.ajax({
    type: "GET",
    url: "/products",
    dataType: 'html',
  })
    .done(function (json) {
      //通信成功で実行される処理
      console.log('通信成功');

      $('product').hide('slow');
      
    })
    .fail(function () {
      //通信が失敗した時に実行される処理
      console.log('通信が失敗');
    })
    .always(function () {
      //通信の成功と失敗に関わらず実行される処理
      console.log('通信が完了');
    });
});



