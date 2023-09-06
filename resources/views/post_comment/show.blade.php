<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-app-layout>
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
                <h2 class='user'>投稿ユーザー：<a href="users/{{ $post->user->id}}">{{ $post->user->name }}</a></h2>
                <h2 class='university'>大学：<a href="{{route('search_index', ['univid' => $post->university->id])}}">{{$post->university->name}}</a></h2>
                <h2 class='genrecategory'>ジャンル、カテゴリ：<a href="{{route('search_index', ['genreid' => $post->genre->id ])}}">{{ $post->genre->name}}</a>
                <a href="{{route('search_index', ['genreid' => $post->genre->id])}}">{{ $post->category->name }}</a></h2>
                @if($post->use_time == "use")
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
                @auth
                <!-- 助かった機能は後で対応する-->
                <!-- お気に入り機能は後で対応する-->
                @endauth
                @if($post->user_id==auth()->id())
                        <h3 class="edit">[<a href="/post/{{ $post->id }}/edit">編集</a>]</h3>
                @endif
            </div>
        </div>
        <!--検索から来てるのかホーム画面から来てるのか判別できないので、戻るボタンで戻らせることとする　許してくれ-->
        {{--コメント投稿欄--}}

        <div style="padding: 10px; margin-bottom: 10px; border: 1px solid;">
            <div class="input_comment">
                <form action="/post/comment" method="POST">
                    @csrf
                    <input type="hidden" name="comment[post_id]" value="{{$post->id}}">
                    <h2>タイトル</h2>
                    <input type="text" name="comment[title]" placeholder="タイトル" value="{{old('comment.title')}}" /><br>
                    @if($errors->has('comment.title'))
                    <div class="validerror">
                        @foreach($errors->get('comment.title') as $message)
                        <li>{{$message}}</li>
                        @endforeach
                    </div>
                    @endif

                    <h2>コメント</h2>
                    <textarea id="comment" name="comment[body]" placeholder="コメントを入力してください"value="{{old('comment.body')}}"></textarea>
                    @if($errors->has('comment.body'))
                    <div class="validerror">
                        @foreach($errors->get('comment.body') as $message)
                        <li>{{$message}}</li>
                        @endforeach
                    </div>
                    @endif
                    <input type="submit" value="投稿" />
                </form>
            </div>

        </div>
        {{--コメント一覧--}}
        
        <div class="comments">
            @foreach($post->postcomments as $comment)
            <div style='border:solid 1px; margin-bottom: 10px;'>
                <h2 class='commenttitle'>{{$comment->title}}</h1>
                <h3 class='commentuser'>投稿ユーザー：<a href="users/{{ $post->user->id}}">{{ $comment->user->name }}</a></h2>
                {{--{{route('index_user',['user'=>$comment->user_id])}}"とかにいずれ差し替える--}}
                <p>{{$comment->body}}</p>
                @if($comment->user_id==auth()->id())
                <h4 class="edit">[<a href="/post/comment/{{$post->id}}/{{ $comment->id }}/edit">編集</a>]</h3>
                @endif
            </div>
            @endforeach
        </div>

</body>
</x-app-layout>
</html>