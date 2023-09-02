<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>大学攻略ガイド</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<body>
    <div class='posts'>
        <div style="padding: 10px; margin-bottom: 10px; border: 1px solid;">
            <div class='post'>
                <h1 class='title'>{{$post->title}}</h1>
                <h2 class='user'>投稿ユーザー{{ $post->user->name }}</h2>
                <h2 class='university'>大学：{{$post->university->name}}</h2>
                <h2 class='genrecategory'>ジャンル、カテゴリ：{{ $post->genre->name}} {{ $post->category->name }}</h2>
                @if($post->use_time)
                <h3 class='time'>
                    開始時刻：{{ $post->start_time }}
                    終了時刻：{{ $post->end_time }}
                </h3>
                @endif
                <hr />
                <p class='body'>{{$post->body}}</p>
                {{-- 画像機能は後で対応する--}}
                <hr />
                <h3 class='category'>
                    投稿時刻：{{ $post->created_at }}
                    編集時刻：{{ $post->updated_at }}
                </h3>
            </div>
        </div>

        <div style="padding: 10px; margin-bottom: 10px; border: 1px solid;">
            <div class="input_comment">
                <form action="/post/comment/{{$post->id}}/{{$comment->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="comment[user_id]" value="{{Auth::id()}}">
                    <input type="hidden" name="comment[post_id]" value="{{$post->id}}">
                    <h2>タイトル</h2>
                    {{--エラーがある場合初期値を差し替える--}}
                @if($errors->any())
                <input type="text" name="comment[title]" placeholder="タイトル" value="{{old('comment.title')}}"/>
                @else
                <input type="text" name="comment[title]" placeholder="タイトル" value="{{$comment->title}}"/>
                @endif<br>
                    @if($errors->has('comment.title'))
                    <div class="validerror">
                        @foreach($errors->get('comment.title') as $message)
                        <li>{{$message}}</li>
                        @endforeach
                    </div>
                    @endif

                    <h2>コメント</h2>
                    <textarea id="comment" name="comment[body]" placeholder="コメントを入力してください">{{ $errors->any() ? old('comment.body'): $comment->body}}</textarea>
                    @if($errors->has('comment.body'))
                    <div class="validerror">
                        @foreach($errors->get('comment.body') as $message)
                        <li>{{$message}}</li>
                        @endforeach
                    </div>
                    @endif
                    <input type="submit" value="投稿" />
                </form>
                <hr>
                <form action="/post/comment/{{$post->id}}/{{$comment->id}}/delete" method="POST">
                    <div>
    <input type="checkbox" id="del" name="comment[deletecheck]"/>
    @csrf
    @method('PUT')
    <label for="del">この投稿を削除する</label>
                    </div>
                    <input type="submit" value="削除" />
                </form>
            </div>
            <hr>
            <a href="/post/{{$post->id}}">編集せず戻る</a>

        </div>
</body>

</html>