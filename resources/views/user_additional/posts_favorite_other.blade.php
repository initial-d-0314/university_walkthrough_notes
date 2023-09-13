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
    <h1>{{$user->name}}のお気に入り一覧</h1>
    <div class='posts'>
        @foreach ($posts as $post)
            <div style="padding: 10px; margin-bottom: 10px; border: 1px solid;">
                <div class='post'>
                <h1 class='title'>{{$post->title}}</h1>
                <h2 class='user'>投稿ユーザー：{{ $post->user->name }}</a></h2>
                <h2 class='university'>大学：<a href="{{route('search_index', ['universityid' => $post->university->id])}}">{{$post->university->name}}</a></h2>
                <h2 class='genrecategory'>ジャンル、カテゴリ：<a href="{{route('search_index', ['genreid' => $post->genre->id ])}}">{{ $post->genre->name}}</a>
                <a href="{{route('search_index', ['genreid' => $post->genre->id])}}">{{ $post->category->name }}</a></h2>
                @if($post->use_time == "use")
                <h3 class='time'>
                    開始時刻：{{ $post->start_time }}
                    終了時刻：{{ $post->end_time }}
                </h3>
                @endif
                        <hr>
                        <p class='body'>{{ $post->body }}</p>
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
                        <h3 class='post-info'><a href="post/{{ $post->id }}">コメント、投稿詳細</a></h3>
                        @if($post->user_id==auth()->id())
                        <h3 class="edit">[<a href="/post/{{ $post->id }}/edit">編集</a>]</h3>
                        @endif
                </div>
            </div>
        @endforeach
        @php
            $ref = request()->server->get('HTTP_REFERER');
            $hos = request()->server->get('HTTP_HOST');
        @endphp
        {{--リファラ値があり、かつ外部サイトでなければaタグで戻るリンクを表示--}}
        @if(!empty($ref) && (strpos($ref,$hos) !== false)) 
        <a href={{$ref}}>戻る</a>
        @endif
        <div>
            {{ $posts->onEachSide(5)->links() }}
            <!--class="paginationについてCSSでいじる必要あり-->
        </div>
</body>
</x-app-layout>
</html>
