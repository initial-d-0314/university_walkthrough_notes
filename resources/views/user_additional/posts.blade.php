<!DOCTYPE html>
<x-app-layout>
<div class="p-8">
    <div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
    <h1 class="text-3xl">{{$user->id == \Auth::user()->id ? "自分" : $user->name}}の投稿一覧</h1>
    <div class="flex justify-start items-center gap-4">
    @if($user->image_url)
    <div>
        <img class="h-24 object-contain" src="{{ $user->image_url }}" alt="画像が読み込めません。"/>
    </div>
    @endif
    <div>
        <div>ユーザーid：{{$user->id}}</div>
        <div>所属大学：{{$user->university_id ?$user->university->name : "（未登録）"}}</div>
        <div>区分：{{$user->grade ? : "（未登録）"}}</div>
        <div>分野：{{$user->section ? : "（未登録）"}}</div>
        <div>自己紹介：{{$user->introduction ? : "（未登録）"}}</div>
    </div>
    </div>
    @if($user->id == \Auth::user()->id)<p>[<a class="underline" href="{{route('useradditional_edit')}}">編集</a>]</p>@endif
    <p>[<a class="underline" href="{{route('search_index', ['userid' => $user->id])}}">このユーザーの投稿を検索する</a>]</p>
@if($user->id == \Auth::user()->id)
    <p>[<a class="underline" href="{{route('useradditional_favorite')}}">自分のお気に入り一覧</a>]</p>
@else
    <p>[<a class="underline" href="{{route('useradditional_favorite_other',['user' => $user->id])}}">このユーザーのお気に入り一覧</a>]</p>
@endif
</div>
</div>
</div>
@foreach ($posts as $post)
    <div class="max-w-7xl mx-auto py-4">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h1 class='text-2xl'>{{$post->title}}</h1>
        <h2 class='text-base'>投稿ユーザー：<a class="underline" href="{{route('useradditional_index_other', ['user' => $post->user_id])}}">{{ $post->user->name }}</a></h2>
        <h2 class='text-base'>
        大学：<a class="underline" href="{{route('search_index', ['universityid' => $post->university->id])}}">{{$post->university->name}}</a>
        ジャンル、カテゴリ：<a class="underline" href="{{route('search_index', ['genreid' => $post->genre->id ])}}">{{ $post->genre->name}}</a> <a class="underline" href="{{route('search_index', ['genreid' => $post->genre->id])}}">{{ $post->category->name }}</a>
        </h2>
        @if($post->use_time == "use")
        <h2 class='text-base'>開始時刻：{{ $post->start_time }} 終了時刻：{{ $post->end_time }}</h2>
        @endif
        <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
        <p class="text-1xl">{{ $post->body }}</p>
        @if($post->image_url)
        <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
        <img class="h-20 object-contain object-center" src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
        @endif
        <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
        <h3 class="text-sm">投稿時刻：{{ $post->created_at }} 編集時刻：{{ $post->updated_at }} </h3>
        @auth
        <div class="">
        @if (!$post->isHelpedBy(Auth::user()))
        <div class="bg-gray-200 inline-flex items-center rounded-md border border-gray-300 px-2 py-2 shadow-sm">
            <i class="help-toggle" data-post-id="{{ $post->id }}">たすかった：</i>
            <i class="help-counter">{{$post->helps_count}}</i>
        </div>
        @else
        <div class="bg-gray-200 inline-flex items-center rounded-md border border-gray-300 px-2 py-2 shadow-sm">
            <i class="help-toggle helped" data-post-id="{{ $post->id }}">たすかった：</i>
            <i class="help-counter">{{$post->helps_count}}</i>
        </div>
        @endif
        @if (!$post->isFavoritedBy(Auth::user()))
        <div class="bg-gray-200 inline-flex items-center rounded-md border border-gray-300 px-2 py-2 shadow-sm">
            <i class="favorite-toggle" data-post-id="{{ $post->id }}">お気に入り登録</i>
        </div>
        @else
        <div class="bg-gray-200 inline-flex items-center rounded-md border border-gray-300 px-2 py-2 shadow-sm">
            <i class="favorite-toggle favorited" data-post-id="{{ $post->id }}">お気に入り解除</i>
        </div>
        @endif
        </div>
        @endauth
        <div class="flex justify-start items-center gap-4">
        <div><a class="underline" href="{{route('postcomment_show', ['post' => $post->id])}}">コメント、投稿詳細</a></div>
        @if($post->user_id==auth()->id())
        <div>[<a class="underline" href="{{route('postcomment_edit', ['post' => $post->id])}}">編集</a>]</div>
        @endif
        </div>
    </div>
    </div>
    </div>
@endforeach
<div class="max-w-7xl mx-auto py-6">
<div class="bg-white shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900">
        {{ $posts->onEachSide(5)->links() }}
</div>
</div>
</div>
</x-app-layout>