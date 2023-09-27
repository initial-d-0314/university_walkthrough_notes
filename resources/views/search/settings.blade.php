<!DOCTYPE html>
<x-app-layout>
<div class="h-screen w-full" style="background-image: url('/image/p0307_m.png'); background-repeat:no-repeat; background-size:cover">
<div class="max-w-7xl mx-auto py-6">
<div class="bg-white shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900">
    <h1 class="text-3xl">投稿検索</h1>
    <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
    <form action="{{route('setting_save')}}" method="post">
    @CSRF
    @method('GET')
    <div class="my-2">
    ユーザーid：<input type="text" class= "text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="userid" placeholder="id" value="{{ $errors->any() ? old('userid'): '' }}"/>
    </div>
    <div class="my-2">
    大学：<select class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="univid">
            <option value="">未設定</option>
            @foreach($universities as $university)
            <option value="{{ $university->id }}" {{old('univid') == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
            @endforeach
    </select>
    </div>
    <div class="my-2">   
    ジャンル：<select class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="genreid">
        <option value="">（ジャンル未選択）</option>
        @foreach($genres as $genre)
            <option value="{{ $genre->id }}"{{old('genreid') == $genre->id ? 'selected' : '' }} >{{ $genre->name }}</option>
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
                <option value="{{ $category->id }}" {{old('categoryid') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        @endforeach
    </select>
    </div>
    <div class="flex my-2">
    開催期間：
    <fieldset>
    <div class="flex">
    <div class="flex items-center mr-4">
        <input name="eventb" type="checkbox" id="eventb" value="on" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" {{old('eventb') == 'on'? 'checked' : '' }}>
        <label for="eventb" class="ml-2">期間前</label>
    </div>
    <div class="flex items-center mr-4">
        <input name="eventd" type="checkbox" id="eventd" value="on" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" {{old('eventd') == 'on'? 'checked' : '' }}>
        <label for="eventd" class="ml-2">開催中</label>
    </div>
    <div class="flex items-center mr-4">
        <input name="eventa" type="checkbox" id="eventa" value="on" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" {{old('eventa') == 'on'? 'checked' : '' }}>
        <label for="eventa" class="ml-2">期間後</label>
    </div>
    <div class="flex items-center mr-4">
        <input name="eventn" type="checkbox" id="eventn" value="on" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" {{old('eventn') == 'on'? 'checked' : '' }}>
        <label for="eventn" class="ml-2">期間未設定</label>
    </div>
    </fieldset>
    </div>

    <div class="my-2">
    フリーワード：<input type="text" class= "text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="keyword" placeholder="キーワード" value="{{ $errors->any() ? old('keword'):'' }}"/>
    </div>
    @if($errors->first())
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif
    <button class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md  text-white tracking-widest hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out" type="submit">追加</button>
</div>
</div>
</div>
    @foreach ($settings as $setting)
    <div class="max-w-7xl mx-auto py-4">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-4 text-gray-900">
        <ul class="max-w-md space-y-1 list-disc list-inside">
            @if($setting->user_id)<li>ユーザー：{{$setting->user->name}}さん（id：{{$setting->user_id}}）</li>@endif
            @if($setting->university_id)<li>大学：{{$setting->university->name}}</li>@endif
            @if($setting->genre_id)<li>ジャンル：{{$setting->genre->name}}</li>@endif
            @if($setting->category_id)<li>カテゴリ：{{$setting->category->name}}</li>@endif
            @unless(empty($setting->eventn)&&empty($setting->eventb)&&empty($setting->eventd)&&empty($setting->eventa))<li>期間：{{$setting->eventb == "on"? '期間前　': ''}}{{$setting->eventd == "on"? '期間中　': ''}}{{$setting->eventa == "on"? '期間後　': ''}}{{$setting->eventn == "on"? '期間未設定': ''}}</li>@endunless
            @if($setting->keyword)<li>キーワード：{{$setting->keyword}}</li>@endif
            <a class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md text-white hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out" href="{{route('search_before',['userid' => $setting->user_id,'univid' => $setting->university_id, 'genreid' => $setting->genre_id, 'categoryid' => $setting->category_id,'keyword' => $setting->keyword,'eventb' => $setting->eventb,'eventd' => $setting->eventd,'eventa' => $setting->eventa,'eventn' => $setting->eventn])}}">この条件で検索</a>
            <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out" href="{{route('setting_delete', ['serachsetting' => $setting->id])}}">この設定を削除する</a>
        </ui>
    </div>
    </div>
    </div>
    @endforeach
<div class="max-w-7xl mx-auto py-6">
<div class="bg-white shadow-sm sm:rounded-lg">
<div class="p-4 text-gray-900">
        {{ $settings->onEachSide(5)->links() }}
</div>
</div>
</div>
</div>
</x-app-layout>