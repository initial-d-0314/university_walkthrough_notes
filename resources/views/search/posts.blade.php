<!DOCTYPE html>
<x-app-layout>
<div class="h-screen w-full" style="background-image: url('/image/p0307_m.png'); background-repeat:no-repeat; background-size:cover">
<div class="max-w-7xl mx-auto py-6">
<div class="bg-white shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900">
<h1 class="text-3xl">投稿検索</h1>
<hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
    <form action="{{ route('search_before')}}" method="post">
    @CSRF
    @method('GET')
    <div class="my-2">
    ユーザーid：<input type="text" class= "text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="userid" placeholder="id" value="{{ $errors->any() ? old('userid'): $datas["userid"]}}"/>
    </div>
    <div class="my-2">
    大学：<select class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="univid">
            <option value="">未設定</option>
            @foreach($universities as $university)
            <option value="{{ $university->id }}" {{($datas["univid"] == $university->id||old('univid') == $university->id) ? 'selected' : '' }}>{{ $university->name }}</option>
            @endforeach
    </select>
    </div>
    <div class="my-2">
    ジャンル：<select class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="genreid">
        <option value="">（ジャンル未選択）</option>
        @foreach($genres as $genre)
        <option value="{{ $genre->id }}"{{( $datas["genreid"] == $genre->id ||old('genreid') == $genre->id) ? 'selected' : '' }} >{{ $genre->name }}</option>
        @endforeach
    </select>
    </div>
    <div class="my-2">
    カテゴリ：<select class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="categoryid">
        <option value="">（カテゴリ未選択）</option>
        @foreach($genres as $genre)
        <optgroup label="{{$genre->name}}:{{$genre->description}}">
            @foreach($categories as $category)
@continue($genre->id != $category->genre_id)
                <option value="{{ $category->id }}" {{($datas["categoryid"] == $category->id||old('categoryid') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        @endforeach
    </select>
    </div>
    
    <div class="flex my-2">
    開催期間：
    <fieldset>
    <div class="flex">
    <div class="flex items-center mr-4">
        <input name="eventb" type="checkbox" id="eventb" value="on" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" {{( $datas["eventb"] == 'on'||old('eventb') == 'on')? 'checked' : '' }}>
        <label for="eventb" class="ml-2">期間前</label>
    </div>
    <div class="flex items-center mr-4">
        <input name="eventd" type="checkbox" id="eventd" value="on" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" {{( $datas["eventd"] == 'on'||old('eventd') == 'on')? 'checked' : '' }}>
        <label for="eventd" class="ml-2">開催中</label>
    </div>
    <div class="flex items-center mr-4">
        <input name="eventa" type="checkbox" id="eventa" value="on" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" {{( $datas["eventa"] == 'on'||old('eventa') == 'on')? 'checked' : '' }}>
        <label for="eventa" class="ml-2">期間後</label>
    </div>
    <div class="flex items-center mr-4">
        <input name="eventn" type="checkbox" id="eventn" value="on" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" {{( $datas["eventn"] == 'on'||old('eventn') == 'on')? 'checked' : '' }}>
        <label for="eventn" class="ml-2">期間未設定</label>
    </div>
    </fieldset>
    </div>
    <div>
    フリーワード：<input type="text" class= "text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="keyword" placeholder="キーワード" value="{{ $errors->any() ? old('keword'): $datas["keyword"]}}"/>
    </div>
    @if($errors->first())
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif
    <div class="flex justify-first">
        <div class="flex items-center mr-4">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md text-white hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out">検索</button>
        </div>
        <div class="flex items-center mr-4">
        <button type="submit" class="bg-gray-200 inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-gray-700 shadow-sm transition ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25" formaction="{{route('setting_save')}}">この設定を保存</button>
        </div>
        <div class="flex items-center mr-4">
        [<a class="underline" href="{{route('setting_index')}}">保存した検索設定一覧</a>]
        </div>
    </div>
    <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
    <div class="text-sm">
    検索機能についての注意：
    <ul class="space-y-1 list-disc list-inside">
    <li>ユーザーidは対象となるユーザーの個人ページに記載されています。</li>
    <li>カテゴリの所属ジャンルと異なるジャンルを同時に選択すると、検索がうまくいかない可能性があります。</li>
    <li>開催期間にチェックを入れない場合は、未設定も含めたすべての期間について検索を行います。</li>
    <li>フリーワード検索、およびユーザーidは一つのみの対応です。</li>
    </ui>
    </div>
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