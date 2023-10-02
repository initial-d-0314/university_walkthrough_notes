<!DOCTYPE html>
<x-app-layout>
<div class="p-8">
<div class="max-w-7xl mx-auto py-4">
<div class="bg-white shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900">
    <h1 class='text-2xl'>{{$post->title}}</h1>
    <h2 class='text-base'>投稿ユーザー：{{ $post->user->name }}</h2>
    <h2 class='text-base'>
    大学：{{$post->university->name}}
    ジャンル、カテゴリ：{{ $post->genre->name}}{{ $post->category->name }}
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
    <form action="{{route('postcomment_commentupdate',['post'=> $post->id, 'postcomment'=> $comment->id])}}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="comment[user_id]" value="{{Auth::id()}}">
        <input type="hidden" name="comment[post_id]" value="{{$post->id}}">
        <div>
        <h2 class='text-xl'>タイトル</h2>
        <input type="text" class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="comment[title]" placeholder="タイトル" value="{{ $errors->any() ? old('comment.title'): $comment->title}}"/>
        </div>
        @if($errors->has('comment.title'))
        <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
            @foreach($errors->get('comment.title') as $message)
            <li>{{$message}}</li>
            @endforeach
        </div>
        @endif
        <div>
        <h2 class='text-xl'>コメント</h2>
        <textarea id="comment" name="comment[body]" placeholder="コメントを入力してください">{{ $errors->any() ? old('comment.body'): $comment->body}}</textarea>
        </div>
        @if($errors->has('comment.body'))
        <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
            @foreach($errors->get('comment.body') as $message)
            <li>{{$message}}</li>
            @endforeach
        </div>
        @endif
        
        <div>
        <input class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md text-white hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out" type="submit" value="編集確定" />
        <a class="bg-gray-200 inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-gray-700 shadow-sm transition ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25" href="{{route('postcomment_show', ['post' => $post->id])}}">編集せず戻る</a>
        </div>
    </form>
    <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
    <h1 class='text-2xl'>コメント削除</h1>
    <form action="{{route('postcomment_commentdelete',['post'=> $post->id, 'postcomment'=> $comment->id])}}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <input type="checkbox" id="del" value = 'on' name="comment[deletecheck]"/>
        <label for="del">このコメントを削除する</label>
        </div>
        <div>
        <input class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out" type="submit" value="削除" />
        </div>
    </form>
    </div>
    </div>
    </div>
</div>
</x-app-layout>