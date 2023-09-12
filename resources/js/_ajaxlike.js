$(function () {
    let help = $('.help-toggle'); //help-toggleのついたiタグを取得し代入。
    let helpPostId; //変数を宣言
    help.on('click', function () { //onはイベントハンドラー
    
      let $this = $(this); //this=イベントの発火した要素＝iタグを代入
      helpPostId = $this.data('post-id'); //iタグに仕込んだdata-post-idの値を取得
      //ajax処理スタート
      $.ajax({
        headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
        url: '/post/help/add', //通信先アドレスで、このURLをあとでルートで設定します
        method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
        data: { //サーバーに送信するデータ
          'post_id': helpPostId //いいねされた投稿のidを送る
        },
      })
      //通信成功した時の処理
      .done(function (data) {
        console.log('success');
        $this.toggleClass('helped'); //helpedクラスのON/OFF切り替え。
        $this.next('.help-counter').html(data.post_helps_count);
      })
      //通信失敗した時の処理
      .fail(function () {
        console.log('fail'); 
      });
    });
});