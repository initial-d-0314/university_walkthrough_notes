<!DOCTYPE html>
<x-app-layout>
<div class="p-8">
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
    </div>
    </div>
    </div>
    <div class="max-w-7xl mx-auto py-4">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
    @php
        $ref = request()->server->get('HTTP_REFERER');
        $hos = request()->server->get('HTTP_HOST');
    @endphp
    {{--リファラ値があり、かつ外部サイトでなければaタグで戻るリンクを表示、ただしリダイレクトで飛んでくることも考える必要がある--}}
    @if(!empty($ref) && (strpos($ref,$hos) !== false && $ref != $hos)) 
    <a class="underline" href={{$ref}}>前のページに戻る</a>
    @endif
    <a class="underline" href="{{route('postcomment_index')}}">投稿一覧へ戻る</a>
    <a class="underline" href="{{route('search_index')}}">検索ページへ戻る</a>
    </div>
    </div>
    </div>
    {{--コメント投稿欄--}}
    <div class="max-w-7xl mx-auto py-4">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <form action="{{route('postcomment_commentstore')}}" method="POST">
            @csrf
            <input type="hidden" name="comment[post_id]" value="{{$post->id}}">
            <div>
            <h2 class='text-base'>タイトル</h2>
            <input type="text" class="border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="comment[title]" placeholder="タイトル" value="{{old('comment.title')}}" /><br>
            </div>
            @if($errors->has('comment.title'))
            <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
                @foreach($errors->get('comment.title') as $message)
                <li>{{$message}}</li>
                @endforeach
            </div>
            @endif
            <div>
            <h2 class='text-base'>コメント</h2>
            <textarea id="comment" name="comment[body]" placeholder="コメントを入力してください" class="border border-gray-300 rounded-lg bg-gray-50 sm:text-md" value="{{old('comment.body')}}"></textarea>
            </div>
            @if($errors->has('comment.body'))
            <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
                @foreach($errors->get('comment.body') as $message)
                <li>{{$message}}</li>
                @endforeach
            </div>
            @endif
            <div>
            <input class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md text-white hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out" type="submit" value="投稿" />
            </div>
        </form>
        </div>
    </div>
    {{--コメント一覧--}}
    @foreach($post->postcomments as $comment)
    <div class="max-w-7xl mx-auto py-4">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h2 class='text-xl'>{{$comment->title}}</h1>
        <h3 class='text-base'>投稿ユーザー：<a href="{{route('useradditional_index_other', ['user' => $comment->user->id])}}">{{ $comment->user->name }}</a></h2>
        <p class='text-sm'>{{$comment->body}}</p>
        @if($comment->user_id==auth()->id())
        <div class='text-sm'>[<a class="underline" href="{{route('postcomment_commentedit',['post'=> $post->id, 'postcomment'=> $comment->id])}}">編集</a>]</div>
        @endif
    </div>
    </div>
    </div>
    @endforeach
    <div class="max-w-7xl mx-auto py-4">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        @if(!empty($ref) && (strpos($ref,$hos) !== false && $ref != $hos)) 
        <a class="underline" href={{$ref}}>前のぺージに戻る</a>
        @endif
        <a class="underline" href="{{route('postcomment_index')}}">投稿一覧へ戻る</a>
        <a class="underline" href="{{route('search_index')}}">検索ページへ戻る</a>
    </div>
    </div>
    </div>
</div>
</x-app-layout>