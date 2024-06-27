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
  // Ensure event binding after document is ready
  $(document).on('click', '.btn-danger', function (event) {
      event.preventDefault();

      let deleteUrl = $(this).attr('href');
      console.log('Delete URL:', deleteUrl); // Log the delete URL for debugging

      $.ajax({
          type: "DELETE",
          url: deleteUrl,
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      })
      .done(function (response) {
          console.log('削除成功');
          location.reload(); // Reload the page on successful deletion
      })
      .fail(function (xhr, status, error) {
          console.log('削除失敗');
          console.log(xhr.responseText); // Log detailed error response
      });
  });
});




