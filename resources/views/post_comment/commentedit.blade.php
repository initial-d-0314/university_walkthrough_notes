<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-app-layout>
<body>
    <div class='posts'>
        <div style="padding: 10px; margin-bottom: 10px; border: 1px solid;">
            <div class='post'>
                <h1 class='title'>{{$post->title}}</h1>
                <h2 class='user'>投稿ユーザー：{{ $post->user->name }}</h2>
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
            </div>
        </div>
        @unless($comment->user->id == Auth::id())
        このコメントの投稿者ではないので編集できません。
        @else
        <div style="padding: 10px; margin-bottom: 10px; border: 1px solid;">
            <div class="input_comment">
                <form action="{{route('postcomment_commentupdate',['post'=> $post->id, 'postcomment'=> $comment->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="comment[user_id]" value="{{Auth::id()}}">
                    <input type="hidden" name="comment[post_id]" value="{{$post->id}}">
                    <h2>タイトル</h2>
                    <input type="text" name="comment[title]" placeholder="タイトル" value="{{ $errors->any() ? old('comment.title'): $comment->title}}"/>
                    <br>
                    @if($errors->has('comment.title'))
                    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
                        @foreach($errors->get('comment.title') as $message)
                        <li>{{$message}}</li>
                        @endforeach
                    </div>
                    @endif
                    <h2>コメント</h2>
                    <textarea id="comment" name="comment[body]" placeholder="コメントを入力してください">{{ $errors->any() ? old('comment.body'): $comment->body}}</textarea>
                    @if($errors->has('comment.body'))
                    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
                        @foreach($errors->get('comment.body') as $message)
                        <li>{{$message}}</li>
                        @endforeach
                    </div>
                    @endif
                    <input type="submit" value="投稿" />
                </form>
                <hr>
                <div>
                <form action="{{route('postcomment_commentdelete',['post'=> $post->id, 'postcomment'=> $comment->id])}}" method="POST">
                @csrf
                @method('PUT')
                <input type="checkbox" id="del" value = 'on' name="comment[deletecheck]"/>
                    <label for="del">このコメントを削除する</label>
                    <input type="submit" value="削除" />
                </form>
                </div>
            </div>
            <hr>
            @endunless
            <a href="{{route('postcomment_show', ['post' => $post->id])}}">編集せず戻る</a>
        </div>
</body>
</x-app-layout>
</html>