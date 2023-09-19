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
                <h2 class='user'>投稿ユーザー：<a href="/useradditional/{{ $post->user->id}}">{{ $post->user->name }}</a></h2>
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
                @if($post->image_url)
                        <div class="image">
                            <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
                        </div>
                        @endif
                <hr />
                <h3 class='category'>
                    投稿時刻：{{ $post->created_at }}
                    編集時刻：{{ $post->updated_at }}
                </h3>
                @auth
                @if (!$post->isHelpedBy(Auth::user()))
                    <span class="helps">
                        <i class="help-toggle" data-post-id="{{ $post->id }}">たすかった</i>
                    <span class="help-counter">{{$post->helps_count}}</span>
                    </span><!-- /.likes -->
                @else
                    <span class="helps">
                        <i class="help-toggle helped" data-post-id="{{ $post->id }}">たすかった</i>
                    <span class="help-counter">{{$post->helps_count}}</span>
                    </span><!-- /.likes -->
                @endif
                @if (!$post->isFavoritedBy(Auth::user()))
                    <span class="favorites">
                        <i class="favorite-toggle" data-post-id="{{ $post->id }}">お気に入り登録</i>
                    </span>
                @else
                    <span class="favorites">
                        <i class="favorite-toggle favorited" data-post-id="{{ $post->id }}">お気に入り解除</i>
                    </span>
                @endif
                @endauth
                @if($post->user_id==auth()->id())
                        <h3 class="edit">[<a href="/post/{{ $post->id }}/edit">編集</a>]</h3>
                @endif
            </div>
        </div>
        @php
            $ref = request()->server->get('HTTP_REFERER');
            $hos = request()->server->get('HTTP_HOST');
        @endphp
        {{--リファラ値があり、かつ外部サイトでなければaタグで戻るリンクを表示、ただしリダイレクトで飛んでくることも考える必要がある--}}
        @if(!empty($ref) && (strpos($ref,$hos) !== false)) 
        <a href={{$ref}}>前のページに戻る</a>
        @endif
        <a href="/post">投稿一覧へ戻る</a>
        <a href="/search">検索ページへ戻る</a>
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
                <h3 class='commentuser'>投稿ユーザー：<a href="/useradditional/{{ $post->user->id}}">{{ $comment->user->name }}</a></h2>
                <p>{{$comment->body}}</p>
                @if($comment->user_id==auth()->id())
                <h4 class="edit">[<a href="/post/comment/{{$post->id}}/{{ $comment->id }}/edit">編集</a>]</h3>
                @endif
            </div>
            @endforeach
        </div>
        @if(!empty($ref) && (strpos($ref,$hos) !== false)) 
        <a href={{$ref}}>前のぺージに戻る</a>
        @endif
        <a href="/post">投稿一覧へ戻る</a>
        <a href="/search">検索ページへ戻る</a>
</body>
</x-app-layout>
</html>