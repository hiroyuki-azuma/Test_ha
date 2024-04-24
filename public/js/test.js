console.log('Hello World');


// 検索ボタンをクリックしたら発火させる
$('#form-btn').on("click",function(){
    $.ajax({
  type:"get",       
  url: '/products', //web.phpのURLと同じ形にする
  dataType:"json"
})
// 通信が成功した時
.done(function(products, companies) {
    console.log(products,companies);
});
});


/*
$('#delete-btn').on("click",function(){
    $.ajax({
  type:"get",       
  url: '/products', //web.phpのURLと同じ形にする
  dataType:"json"
})
// 通信が成功した時
.done(function(json) {
    console.log(json);
});
});
*/