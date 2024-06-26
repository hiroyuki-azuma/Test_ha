console.log('Hello World');


// 検索機能の非同期処理化
$(document).ready(function () {
  // 検索ボタンクリック時の処理
  $("#form-btn").click(function (event) {
    event.preventDefault(); // フォームのデフォルトの送信動作を防ぐ

    let formData = $('#search').serialize(); // フォームの入力値を取得する

    $.ajax({
      type: "GET",
      url: "/products",
      dataType: 'html',
      data: formData, // フォームのデータを送信する
    })
      .done(function (response) {
        // 通信成功時の処理
        console.log('通信成功');
        // 新しいテーブルのHTMLを反映する（具体的なコードは記載されていないため、適宜実装する）
        $("#targetTable").html(response);

        // headpartの複製を防止
        $('#headpart').hide();

      })
      .fail(function () {
        // 通信失敗時の処理
        console.log('通信失敗');
      })
      .always(function () {
        // 通信完了時の処理
        console.log('通信完了');
      });
  });
});






// 削除処理の非同期処理化
$(document).ready(function () {

  // 削除ボタンがクリックされたときの処理
  $('body').on('click', '.delete-btn', function (event) {
    event.preventDefault(); // デフォルトのイベントをキャンセルする
    // console.log('削除テスト');


    let deleteUrl = $(this).attr('href'); // 削除リンクのURLを取得

    $.ajax({
      type: "DELETE",
      url: deleteUrl, // 削除リンクのURLにDELETEリクエストを送信
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRFトークンを含める
      }
    })
      .done(function () {
        // 成功時の処理
        console.log('削除成功');

      })
      .fail(function () {
        // 失敗時の処理
        console.log('削除失敗');

      });
  });

});
