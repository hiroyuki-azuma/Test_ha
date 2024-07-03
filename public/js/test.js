$(document).ready(function () {
  // CSRFトークンを全てのAjaxリクエストに含める
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
    }
  });

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

      // 検索結果を反映後に削除イベントを再バインド
      bindDeleteEvent();
    })
    .fail(function () {
      console.log('通信失敗');
    })
    .always(function () {
      console.log('通信完了');
    });
  });

  // 削除処理の非同期化関数
  function bindDeleteEvent() {
    $('#targetTable').off('click', '.btn-danger').on('click', '.btn-danger', function(event) {
      event.preventDefault(); // デフォルトのリンクの動作を防止

      var deleteConfirm = confirm('削除してよろしいでしょうか？');
      if (deleteConfirm == true) {
        var clickEle = $(this);
        // 削除ボタンにユーザーIDをカスタムデータとして埋め込んでいます。
        var productID = clickEle.attr('product-id');

        // productIDがundefinedの場合、処理を中断する
        if (productID === undefined) {
          alert('プロダクトIDが見つかりません。');
          return;
        }

        $.ajax({
          url: '/product/' + productID,
          type: 'POST',
          data: {
            '_method': 'DELETE',
            '_token': $('meta[name="token"]').attr('content') // CSRFトークンを追加
          }
        })
        .done(function() {
          // 通信が成功した場合、クリックした要素の親要素の <tr> を削除
          clickEle.parents('tr').remove();
        })
        .fail(function() {
          alert('エラー');
        });
      }
    });
  }

  // 初回読み込み時に削除イベントをバインド
  bindDeleteEvent();
});
