<!DOCTYPE html>
<x-app-layout>
<div class="p-8">
<div class="max-w-7xl mx-auto py-6">
<div class="bg-white shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900">
    <form action="{{ route('university_update',['university' => $university->id])}}" method="post">
        @csrf
        @method('PUT')
        <h1 class="text-3xl">大学情報変更</h1>
        <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
        <h2 class="text-xl">大学名</h2>
        <p>必須です。大学のキャンパス名まで含んだ名称です。略称ではなく正式名称で登録をお願いします。</p>
        <input type="text" class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="university[name]" value="{{ $errors->any() ? old('university.name'): $university->name}}"/>
        <br>
        @if($errors->has('university.name'))
        <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
            @foreach($errors->get('university.name') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
        @endif

        <h2 class="text-xl">分類</h2>
        <p>大学の分類です。（例：理系、文系、スポーツ専門）</p>
        <input type="text" class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="university[section]" value="{{ $errors->any() ? old('university.section'): $university->section}}"/>
        @if($errors->has('university.section'))
        <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
            @foreach($errors->get('university.section') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
        @endif

        <h2 class="text-xl">住所</h2>
        <p>大学の住所です。（例：東京都世田谷区宇奈根1-1-1）</p>
        <input type="text" class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="university[address]" value="{{ $errors->any() ? old('university.address'): $university->address}}"/>
        @if($errors->has('university.address'))
        <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
            @foreach($errors->get('university.address') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
        @endif

        <h2 class="text-xl">URL</h2>
        <p>大学の公式サイトのURLです。</p>
        <input type="text" class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="university[url]" value="{{ $errors->any() ? old('university.url'): $university->url}}{{old('university.url')}}"/>
        <br>
        @if($errors->has('university.url'))
        <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
            @foreach($errors->get('university.url') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
        @endif

        <h2 class="text-xl">最寄り駅</h2>
        <p>大学の最寄り駅です。一つでお願いします。（例：東急田園都市線・大井町線「二子玉川」駅）</p>
        <input type="text" class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="university[nearest_station]" value="{{ $errors->any() ? old('university.nearest_station'): $university->nearest_station}}"/>
        @if($errors->has('university.nearest_station'))
        <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
            @foreach($errors->get('university.nearest_station') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
        @endif
    <div class="">
        <input type="submit" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md text-white hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out" value="大学データ変更"/>
        <a class="bg-gray-200 inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-gray-700 shadow-sm transition ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25" href="{{ route('university_index') }}">変更せず戻る</a>
    </div>
    </form>
</div>
</div>
</div>
</div>
</x-app-layout>