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
    <h1>自分の投稿一覧</h1>
    <div>
        <!--画像予定地-->
        
        <p>所属大学：{{$user->university_id ?$user->university->name : "（未登録）"}}</p>
        <p>区分：{{$user->grade ? : "（未登録）"}}</p>
        <p>分野：{{$user->section ? : "（未登録）"}}</p>
        <p>自己紹介：{{$user->introduction ? : "（未登録）"}}</p>
        <p>[<a href="/useradditional/edit">編集</a>]</p>
        <p>[<a href="/useradditional/edit">お気に入り一覧(まだ)</a>]</p>
    </div>
    <div class='posts'>
        @foreach ($posts as $post)
            <div style="padding: 10px; margin-bottom: 10px; border: 1px solid;">
                <div class='post'>
                <h1 class='title'>{{$post->title}}</h1>
                <h2 class='user'>投稿ユーザー：<a href="users/{{ $post->user->id}}">{{ $post->user->name }}</a></h2>
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
                        {{-- 画像機能は後で対応する --}}
                        <hr />
                        <h3 class='category'>
                            投稿時刻：{{ $post->created_at }}
                            編集時刻：{{ $post->updated_at }}
                        </h3>
                        @auth
                            <!-- 助かった機能は後で対応する-->
                            <!-- お気に入り機能は後で対応する-->
                        @endauth
                        <h3 class='post-info'><a href="post/{{ $post->id }}">コメント、投稿詳細</a></h3>
                        @if($post->user_id==auth()->id())
                        <h3 class="edit">[<a href="/post/{{ $post->id }}/edit">編集</a>]</h3>
                        @endif

                </div>
            </div>
        @endforeach
        <div>
            {{ $posts->onEachSide(5)->links() }}
            <!--class="paginationについてCSSでいじる必要あり-->
        </div>
</body>
</x-app-layout>
</html>
