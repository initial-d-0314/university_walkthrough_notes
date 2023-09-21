<!DOCTYPE html>
<x-app-layout>
<body>
    <h1>投稿一覧</h1>
    <p>ジャンル、カテゴリ、大学は検索画面へのリンクになっています</p>
    <p><a href ={{route('postcomment_create')}}>新規投稿作成</a></p>
    <div class='posts'>
        @foreach ($posts as $post)
            <div style="padding: 10px; margin-bottom: 10px; border: 1px solid;">
                <div class='post'>
                <h1 class='title'>{{$post->title}}</h1>
                <h2 class='user'>投稿ユーザー：<a href="{{route('useradditional_index_other', ['user' => $post->user->id])}}">{{ $post->user->name }}</a></h2>
                <h2 class='university'>大学：<a href="{{route('search_index', ['univid' => $post->university->id])}}">{{$post->university->name}}</a></h2>
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
                        <h3 class='post-info'><a href="{{route('postcomment_show', ['post' => $post->id])}}">コメント、投稿詳細</a></h3>
                        @if($post->user_id==auth()->id())
                        <h3 class="edit">[<a href="{{route('postcomment_edit', ['post' => $post->id])}}">編集</a>]</h3>
                        @endif

                </div>
            </div>
        @endforeach
        <div>
            {{ $posts->onEachSide(5)->links() }}
        </div>
</body>
</x-app-layout>