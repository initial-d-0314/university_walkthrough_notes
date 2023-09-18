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
    <h1>カテゴリ情報変更</h1>
		<hr>
        <form action="/category/{{$category->id}}" method="post">
            @csrf
            @method('PUT')
            <h2>所属ジャンル</h2>
            <p>必須です。カテゴリがどのジャンルに属しているかについてです。</p>
            <select name="category[genre_id]">
                <option value="">（ジャンルを選択してください）</option>
                @foreach($genres as $genre)
                <option value="{{ $genre->id }}" {{(old('genreid') == $genre->id || $category->genre_id == $genre->id) ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
            @if($errors->has('category.genre_id'))
            <div class="validerror">
                @foreach($errors->get('category.genre_id') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif

            <h2>カテゴリ名</h2>
            <p>必須です。カテゴリの名前です。（例：雨宿り）</p>
            <input type="text" name="category[name]" placeholder="カテゴリ名" value="{{ $errors->any() ? old('category.name'):$category->name}}"/>
            <br>
            @if($errors->has('category.name'))
            <div class="validerror">
                @foreach($errors->get('category.name') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif

            <h2>説明文</h2>
            <p>必須です。カテゴリについての説明文です。なるべく短くしてもらうと助かります。</p>
                <input type="text" name="category[description]" placeholder="説明文" value="{{ $errors->any() ? old('category.description'):$category->description}}"/>
            <br>
            @if($errors->has('category.description'))
            <div class="validerror">
                @foreach($errors->get('category.description') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif
            
        <input type="submit" value="ジャンル情報変更"/>
        </form>
        <div class="footer">
            <a href="/category">変更せず戻る</a>
        </div>
    </body>
</html>
</x-app-layout>