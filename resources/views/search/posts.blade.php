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
    <h1>投稿検索</h1>
    <div class='searchform'>
        <form action="{{ route('search_before')}}" method="post">
        @CSRF
        @method('GET')
        ユーザーid：
        <input type="text" name="userid" placeholder="id" value="{{ $errors->any() ? old('userid'): $datas["userid"]}}"/>
        <br>
        大学：
        <select name="univid">
                <option value="">未設定</option>
                @foreach($universities as $university)
                <option value="{{ $university->id }}" {{($datas["univid"] == $university->id||old('univid') == $university->id) ? 'selected' : '' }}>{{ $university->name }}</option>
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
                    <option value="{{ $genre->id }}"{{( $datas["genreid"] == $genre->id ||old('genreid') == $genre->id) ? 'selected' : '' }} >{{ $genre->name }}</option>
                @endforeach
            </select>
            
            カテゴリ：<select name="categoryid">
                <option value="">（カテゴリ未選択）</option>
                @foreach($genres as $genre)
                <optgroup label="{{$genre->name}}:{{$genre->description}}">
                    @foreach($categories as $category)
                        @continue($genre->id != $category->genre_id)
                        <option value="{{ $category->id }}" {{($datas["categoryid"] == $category->id||old('categoryid') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                @endforeach
            </select>
            <br>
            開催期間：
            <fieldset>
                <input name="eventb" type="checkbox" id="eventb" value="on" {{( $datas["eventb"] == 'on'||old('eventb') == 'on')? 'checked' : '' }}>
                <label for="eventb">期間前</label>
                <input name="eventd" type="checkbox" id="eventd" value="on" {{( $datas["eventd"] == 'on'||old('eventd') == 'on')? 'checked' : '' }}>
                <label for="eventd">開催中</label>
                <input name="eventa" type="checkbox" id="eventa" value="on" {{( $datas["eventa"] == 'on'||old('eventa') == 'on')? 'checked' : '' }}>
                <label for="eventa">期間後</label>
                <input name="eventn" type="checkbox" id="eventn" value="on" {{( $datas["eventn"] == 'on'||old('eventn') == 'on')? 'checked' : '' }}>
                <label for="eventn">期間未設定</label>
            </fieldset>
            フリーワード：
            <input type="text" name="keyword" placeholder="タイトル" value="{{ $errors->any() ? old('keword'): $datas["keyword"]}}"/>
            <br>
            <button type="submit">検索</button>
            <br>
            <p>検索機能についての注意：
            ユーザーidは対象となるユーザーの個人ページに記載されています。
            ジャンルとカテゴリは同時に指定できますが、カテゴリが所属しているジャンルと異なるジャンルを選択すると検索がうまくいかない場合があります。
            開催期間にチェックを入れない場合は未設定も含めたすべての期間について検索を行います。
            フリーワード検索は現在一つのキーワードのみの対応です。</p>
    </div>
    <div class='posts'>
        @foreach ($posts as $post)
            <div style="padding: 10px; margin-bottom: 10px; border: 1px solid;">
                <div class='post'>
                <h1 class='title'>{{$post->title}}</h1>
                <h2 class='user'>投稿ユーザー：<a href="/useradditional/id/{{ $post->user->id}}">{{ $post->user->name }}</a></h2>
                <h2 class='university'>大学：<a href="{{route('postcomment_index', ['universityid' => $post->university->id])}}">{{$post->university->name}}</a></h2>
                <h2 class='genrecategory'>ジャンル、カテゴリ：<a href="{{route('postcomment_index', ['genreid' => $post->genre->id ])}}">{{ $post->genre->name}}</a>
                <a href="{{route('postcomment_index', ['genreid' => $post->genre->id])}}">{{ $post->category->name }}</a></h2>
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
            {{ $posts->appends(request()->except(['_token','_method']))->onEachSide(5)->links() }}
            <!--class="paginationについてCSSでいじる必要あり-->
        </div>
</body>
</x-app-layout>
</html>
