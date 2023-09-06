<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-app-layout>
    <head>
        <meta charset="utf-8">
        <meta name=”viewport” content=”width=device-width,initial-scale=1″>
        <title>大学攻略ガイド</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/input.css')  }}" />
    </head>

    <body>
    @unless($post->user->id == Auth::id())
    この投稿の投稿者ではないので編集できません。
    @else
        <h1>投稿編集</h1>
        <form action="/post/{{$post->id}}" method="post">
            @CSRF
            @method('PUT')
            <h2>タイトル</h2>
            <p>必須です。投稿のタイトルです。</p>
            {{--エラーがある場合初期値を差し替える--}}
            @if($errors->any())
                <input type="text" name="post[title]" placeholder="タイトル" value="{{old('post.title')}}"/>
            @else
                <input type="text" name="post[title]" placeholder="タイトル" value="{{$post->title}}"/>
            @endif<br>
            <!--エラーがある場合リストで全部見せる-->
            @if($errors->has('post.title'))
            <div class="validerror">
            @foreach($errors->get('post.title') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif

            <h2>本文</h2>
            <p>必須です。投稿の本文です。</p>
            {{--エラーがある場合初期値を差し替える--}}
            <textarea name="post[body]" placeholder="投稿内容を書いてね">{{ $errors->any() ? old('post.body'): $post->body}}</textarea><br>
            <!--エラーがある場合リストで全部見せる-->
            @if($errors->has('post.body'))
            <div class="validerror">
            @foreach($errors->get('post.body') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif

            <h2>ジャンル・カテゴリ選択</h2>
            <p>必須です。投稿がどのジャンル、カテゴリに含まれているのかについてです。</p>
            <p>この一覧はジャンル・カテゴリ一覧ページと同じ順番で並んでいます。</p>
            <select name="post[category_id]">
                @foreach($genres as $genre)
                <optgroup label="{{$genre->name}}:{{$genre->description}}">
                    @foreach($categories as $category)
                    {{--カテゴリのidとジャンルの所属しているカテゴリのidで判定を行う--}}
                    {{--ジャンルを一つづつ参照する方が安全性高い気がするけれど、カテゴリの編集は考えていないのでこの書き方で--}}
                    @continue($genre->id != $category->genre_id)
                    @if($post->category->id == $category->id ||  old('post.category_id') == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                    @endforeach
                    @endforeach
            </select>
            @if($errors->has('post.category_id'))
            <div class="validerror">
            @foreach($errors->get('post.category_id') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif
            

            <h2>大学選択</h2>
            <p>必須です。投稿がどの大学に関連しているかについてです。</p>
            <p>この一覧は大学一覧ページと同じ順番で並んでいます。</p>
            <select name="post[university_id]">
                @foreach($universities as $university)
                @if($post->university->id == $university->id ||  old('post.university_id') == $university->id)
                <option value="{{ $university->id }}" selected>{{ $university->name }}</option>
                @else
                <option value="{{ $university->id }}">{{ $university->name }}</option>
                @endif
                @endforeach
            </select>
            </select>
            @if($errors->has('post.university_id'))
            <div class="validerror">
            @foreach($errors->get('post.university_id') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif


            <h1>オプション</h1>

            <h2>開始時刻、終了時刻</h2>
            <p>イベントやキャンペーンの日時を記載できます。使用する場合は開始時刻と終了時刻の両方の入力が必要です。</p>
            <p>正確な値がわからない場合には適当な値でも構いません。</p>
            @if($post->use_time)
            <input type="checkbox" name="post[use_time]" value="use" checked/>
            @elseif($errors->any() && old('post.use_time'))
            <input type="checkbox" name="post[use_time]" value="use" checked/>
            @else
            <input type="checkbox" name="post[use_time]" value="use"/>
            @endif


            <p>開始日時</p>
            {{--エラーがある場合初期値を差し替える--}}
            @if($errors->any())
            <input type="date" name="post[stdate]" value="{{old('post.stdate')}}" />
            <input type="time" name="post[sttime]" value="{{old('post.sttime')}}"><br>
            @else
            <input type="date" name="post[stdate]" value="{{$post->stdate}}" />
            <input type="time" name="post[sttime]" value="{{substr($post->sttime, 0,-3)}}"><br>
            @endif<br>
            @if($errors->has('post.stdate'))
            <div class="validerror">
            @foreach($errors->get('post.stdate') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif
            @if($errors->has('post.sttime'))
            <div class="validerror">
            @foreach($errors->get('post.sttime') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif


            <p>終了日時</p>
            @if($errors->any())
            <input type="date" name="post[endate]" value="{{old('post.endate')}}" />
            <input type="time" name="post[entime]" value="{{old('post.entime')}}"><br>
            @else
            <input type="date" name="post[endate]" value="{{$post->endate}}" />
            <input type="time" name="post[entime]" value="{{substr($post->entime, 0,-3)}}"><br>
            @endif<br>
            @if($errors->has('post.endate'))
            <div class="validerror">
            @foreach($errors->get('post.endate') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif
            @if($errors->has('post.entime'))
            <div class="validerror">
            @foreach($errors->get('post.entime') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif


            <h2>画像（どうしよう）</h2>

            <input type="submit" value="編集する" />
        </form>
        <div class="footer">
            <a href="/">投稿せずトップページに戻る</a>
        </div>
    @endunless
    </body>

</html>
</x-app-layout>