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
        <h1>新規投稿追加</h1>
        <form action="/post" method="post" enctype="multipart/form-data">
        @csrf
            <h2>タイトル</h2>
            <p>必須です。投稿のタイトルです。</p>
            <input type="text" name="post[title]" placeholder="タイトル" value="{{old('post.title')}}" /><br>
            <!--エラーがある場合リストで全部見せる-->
            @if($errors->has('post.title'))
            <div class="validerror">
            @foreach($errors->get('post.title') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif

            <h2>本文</h2>
            <p>必須です。投稿の本文です。</p>
            <textarea name="post[body]" placeholder="投稿内容を書いてね">{{old('post.body')}}</textarea><br>
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
{{--カテゴリのidとジャンルの所属しているカテゴリのidで判定を行う、カテゴリの編集は考えていないのでこの書き方で--}}
            <select name="post[category_id]">
                <option value="">（ジャンルを選んでください）</option>
                @foreach($genres as $genre)
                <optgroup label="{{$genre->name}}:{{$genre->description}}">
                    @foreach($categories as $category)
@continue($genre->id != $category->genre_id)
                    <option value="{{ $category->id }}" {{old('post.category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
            <p>この一覧は大学一覧ページと同じ順番で並んでいます。</p>{{--ユーザーの所属する大学idを初期値に、oldがある場合はoldを優先する--}}
            <select name="post[university_id]">
            @if(empty(old('post.university_id')))
                @foreach($universities as $university)
                <option value="{{ $university->id }}" {{($univ == $university->id)? 'selected' : '' }}>{{ $university->name }}</option>
                @endforeach
            @else
                @foreach($universities as $university)
                <option value="{{ $university->id }}" {{(old('post.university_id') == $university->id)? 'selected' : '' }}>{{ $university->name }}</option>
                @endforeach
            @endif
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
            <p>正確な値がわからない場合には適当な値でも構いません。また、半永久的に続く場合はできれば使用せず、本文に記載をお願いします。</p>
            <input type="checkbox" name="post[use_time]" id="use_time"value="use" {{($errors->any() && old('post.use_time') == "use") ? 'checked' : '' }}/>
            <label for="use_time">時刻を設定する</label>
            <p>開始日時</p>
            <input type="date" name="post[stdate]" value="{{old('post.stdate')}}" />
            <input type="time" name="post[sttime]" value="{{old('post.sttime')}}"><br>
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
            @if($errors->has('start_time'))
            <div class="validerror">
            @foreach($errors->get('start_time') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif

            <p>終了日時</p>
            <input type="date" name="post[endate]" value="{{old('post.endate')}}" />
            <input type="time" name="post[entime]" value="{{old('post.entime')}}"><br>
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
            @if($errors->has('end_time'))
            <div class="validerror">
            @foreach($errors->get('end_time') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif

            <h2>画像</h2>
            <div class="image">
            <p>画像を追加できます。</p>
            <input type="file" name="image">
            </div>

            <input type="submit" value="投稿する" />
        </form>
        <div class="footer">
            <a href="/dashboard">投稿せずトップページに戻る</a>
        </div>
    </body>
</html>
</x-app-layout>