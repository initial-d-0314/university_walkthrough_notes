<!DOCTYPE html>
<x-app-layout>
    <div class="p-8">F
    <div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h1 class="text-3xl">カテゴリ情報変更</h1>
        <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
        <form action="{{ route('genrecategory_update', ['category' => $category->id]) }}" method="post">
            @csrf
            @method('PUT')
            <h2 class="text-xl">所属ジャンル</h2>
            <p>必須です。カテゴリがどのジャンルに属しているかについてです。</p>
            <select class="border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="category[genre_id]">
                <option value="">（ジャンルを選択してください）</option>
                @foreach($genres as $genre)
                <option value="{{ $genre->id }}" {{(old('genreid') == $genre->id || $category->genre_id == $genre->id) ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
            @if($errors->has('category.genre_id'))
            <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
                @foreach($errors->get('category.genre_id') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif

            <h2 class="text-xl">カテゴリ名</h2>
            <p>必須です。カテゴリの名前です。（例：雨宿り）</p>
            <input type="text" class="border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="category[name]" placeholder="カテゴリ名" value="{{ $errors->any() ? old('category.name'):$category->name}}"/>
            <br>
            @if($errors->has('category.name'))
            <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
                @foreach($errors->get('category.name') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif

            <h2 class="text-xl">説明文</h2>
            <p>必須です。カテゴリについての説明文です。なるべく短くしてもらうと助かります。</p>
                <input type="text" class="border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="category[description]" placeholder="説明文" value="{{ $errors->any() ? old('category.description'):$category->description}}"/>
            <br>
            @if($errors->has('category.description'))
            <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
                @foreach($errors->get('category.description') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif
        <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
        <div>
        <input type="submit" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md  text-xs text-white hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out" value="ジャンル情報変更"/>
        <a class="bg-gray-200 inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-gray-700 shadow-sm transition ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25" href="{{route('genrecategory_index')}}">変更せず戻る</a>
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>