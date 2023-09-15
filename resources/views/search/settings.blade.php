<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-app-layout>
<head>
    <meta charset="utf-8">
    <title>大学攻略ガイド</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/input.css')  }}" />
</head>

<body>
    <h1>投稿検索</h1>
    <div class='searchform'>
        <form action="/search/setting/add" method="post">
        @CSRF
        @method('GET')
        ユーザーid：
        <input type="text" name="userid" placeholder="id" value="{{ $errors->any() ? old('userid'): '' }}"/>
        <br>
        大学：
        <select name="univid">
                <option value="">未設定</option>
                @foreach($universities as $university)
                <option value="{{ $university->id }}" {{old('univid') == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
                @endforeach
        </select>
            @if($errors->has('univid'))
            <div class="validerror">
            @foreach($errors->get('univid') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif
            
            ジャンル：<select name="genreid">
                <option value="">（ジャンル未選択）</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}"{{old('genreid') == $genre->id ? 'selected' : '' }} >{{ $genre->name }}</option>
                @endforeach
            </select>
            
            カテゴリ：<select name="categoryid">
                <option value="">（カテゴリ未選択）</option>
                @foreach($genres as $genre)
                <optgroup label="{{$genre->name}}:{{$genre->description}}">
                    @foreach($categories as $category)
                        @continue($genre->id != $category->genre_id)
                        <option value="{{ $category->id }}" {{old('categoryid') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                @endforeach
            </select>
            <br>
            開催期間：
            <fieldset>
                <input name="eventb" type="checkbox" id="eventb" value="on" {{old('eventb') == 'on'? 'checked' : '' }}>
                <label for="eventb">期間前</label>
                <input name="eventd" type="checkbox" id="eventd" value="on" {{old('eventd') == 'on'? 'checked' : '' }}>
                <label for="eventd">開催中</label>
                <input name="eventa" type="checkbox" id="eventa" value="on" {{old('eventa') == 'on'? 'checked' : '' }}>
                <label for="eventa">期間後</label>
                <input name="eventn" type="checkbox" id="eventn" value="on" {{old('eventn') == 'on'? 'checked' : '' }}>
                <label for="eventn">期間未設定</label>
            </fieldset>
            フリーワード：
            <input type="text" name="keyword" placeholder="キーワード" value="{{ $errors->any() ? old('keword'):'' }}"/>
            @if($errors->has('keyword'))
            <div class="validerror">
            @foreach($errors->get('keyword') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif
            <br>
            <button type="submit">追加</button>
    </div>
    <div class='posts'>
        @foreach ($settings as $setting)
            <div style="padding: 10px; margin-bottom: 10px; border: 1px solid;">
                <div class='setting'>
                    @if($setting->user_id)<p>ユーザー：{{$setting->user->name}}さん（id：{{$setting->user_id}}）</p>@endif
                    @if($setting->university_id)<p>大学：{{$setting->university->name}}さん</p>@endif
                    @if($setting->genre_id)<p>ジャンル：{{$setting->genre->name}}</p>@endif
                    @if($setting->category_id)<p>カテゴリ：{{$setting->category->name}}</p>@endif
                    @unless(empty($setting->eventn)&&empty($setting->eventb)&&empty($setting->eventd)&&empty($setting->eventa))<p>期間：{{$setting->eventb == "on"? '期間前　': ''}}{{$setting->eventd == "on"? '期間中　': ''}}{{$setting->eventa == "on"? '期間後　': ''}}{{$setting->eventn == "on"? '期間未設定': ''}}</p>@endunless
                    @if($setting->keyword)<p>キーワード：{{$setting->keyword}}</p>@endif
                    <a href="{{ route('search_before',['userid' => $setting->user_id,'univid' => $setting->university_id, 'genreid' => $setting->genre_id, 'categoryid' => $setting->category_id,'keyword' => $setting->keyword,'eventb' => $setting->eventb,'eventd' => $setting->eventd,'eventa' => $setting->eventa,'eventn' => $setting->eventn])}}">
                    この条件で検索</a>
                    
                    <a href="/search/settings/{{$setting->id}}/delete">この設定を削除する</a>
                </div>
            </div>
        @endforeach
        <div>
            {{ $settings->appends(request()->except(['_token','_method']))->onEachSide(5)->links() }}
            <!--class="paginationについてCSSでいじる必要あり-->
        </div>
</body>
</x-app-layout>
</html>
