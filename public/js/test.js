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






// 削除ボタンがクリックされた時の処理
$(document).ready(function () {
  $('.delete-btn').click(function (e) {
    e.preventDefault();
    var productId = $(this).data('product-id');
    if (confirm("削除しますか？")) {
      $.ajax({
        type: 'POST',
        url: "{{ route('product.destroy', ':id') }}".replace(':id', productId),
        data: {
          '_token': '{{ csrf_token() }}',
          '_method': 'DELETE'
        },
        success: function (data) {
          // 成功時の処理（該当行をテーブルから削除するなど）
          $('#row_' + productId).remove();
          // 成功メッセージを表示する場合はここに追加
          alert(data.message);
        },
        error: function (data) {
          // エラー時の処理
          alert('削除に失敗しました。');
        }
      });
    }
  });
});

















