$(function () {
    let help = $('.help-toggle'); //help-toggleのついたiタグを取得し代入。
    let helpPostId; //変数を宣言
    let favorite = $('.favorite-toggle'); //help-toggleのついたiタグを取得し代入。
    let favoritePostId; //変数を宣言
    let thisText;
    
    help.on('click', function () { //onはイベントハンドラー
      let $this = $(this); //this=イベントの発火した要素＝iタグを代入
      thisText = $this.text();
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
        //テキストの書き換え。
        if (thisText == "たすかった"){
          $this.text('たすかった済');
        }else{
          $this.text('たすかった');
        }
        
        $this.next('.help-counter').html(data.post_helps_count);
      })
      //通信失敗した時の処理
      .fail(function () {
        console.log('fail'); 
      });
    });
      
      favorite.on('click', function () { //onはイベントハンドラー
      let $this = $(this); //this=イベントの発火した要素＝iタグを代入
      thisText = $this.text();
      favoritePostId = $this.data('post-id'); //iタグに仕込んだdata-post-idの値を取得
      //ajax処理スタート
      $.ajax({
        headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
        url: '/post/favorite/add', //通信先アドレスで、このURLをあとでルートで設定します
        method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
        data: { //サーバーに送信するデータ
          'post_id': favoritePostId //いいねされた投稿のidを送る
        },
      })
      //通信成功した時の処理
      .done(function (data) {
        console.log('success');
        //テキストの書き換え。
        if (thisText == "お気に入り登録"){
          $this.text('お気に入り解除');
        }else{
          $this.text('お気に入り登録');
        }
      })
      //通信失敗した時の処理
      .fail(function () {
        console.log('fail'); 
      });
    });
});