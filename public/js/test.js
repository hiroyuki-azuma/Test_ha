$(document).ready(function () {

  // 検索機能の非同期化
  $("#form-btn").click(function (event) {
    event.preventDefault(); // デフォルトのフォーム送信を防止

    let formData = $('#search').serialize(); // フォームの入力値をシリアライズ

    $.ajax({
      type: "GET",
      url: "/products",
      dataType: 'html',
      data: formData, // フォームデータを送信
    })
      .done(function (response) {
        console.log('通信成功');
        $("#targetTable").html(response); // 新しいテーブルのHTMLを反映

        $('#headpart').hide(); // headpartを非表示にする
      })
      .fail(function () {
        console.log('通信失敗');
      })
      .always(function () {
        console.log('通信完了');
      });
  });


  // 削除処理の非同期化
  $(document).on('click', '.btn-danger', function (event) {
    event.preventDefault();
    console.log('削除ボタンは発火しています');


    let deleteUrl = $(this).attr('href');
    console.log('Delete URL:', deleteUrl); // デバッグのために削除URLをログに出力

    $.ajax({
      type: "DELETE",
      url: deleteUrl,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })

      .done(function (response) {
        console.log('削除成功');
        // 削除した商品のIDに基づいて該当行をテーブルから削除する
        $('#product-' + response.id).remove();
      })
      .fail(function (xhr, status, error) {
        console.log('削除失敗');
        console.log(xhr.responseText); // エラーレスポンスをログに出力
      });
  });




});
