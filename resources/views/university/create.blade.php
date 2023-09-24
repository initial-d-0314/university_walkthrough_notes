<!DOCTYPE html>
<x-app-layout>
    <div class="h-full w-full" style="background-image: url('/image/p0307_m.png'); background-repeat:no-repeat; background-size:cover">
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
        <form action="{{route('university_store')}}" method="post">
            @csrf
            <h1>大学情報追加</h1>
            <hr>
            <h2 class="text-xl">大学名</h2>
            <p>必須です。大学のキャンパス名まで含んだ名称です。略称ではなく正式名称で登録をお願いします。</p>
            <input type="text" name="university[name]" placeholder="大学名" value="{{ old('university.name') }}" /><br>
            @if ($errors->has('university.name'))
            <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
                @foreach ($errors->get('university.name') as $message)
                <li>{{ $message }}</li>
                @endforeach</div>
            @endif

            <h2 class="text-xl">分類</h2>
            <p>大学の分類です。（例：理系、文系、スポーツ専門）</p>
            <input type="text" name="university[section]" placeholder="分類" value="{{ old('university.section') }}" /><br>
            @if ($errors->has('university.section'))
            <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
                @foreach ($errors->get('university.section') as $message)
                <li>{{ $message }}</li>
                @endforeach</div>
            @endif

            <h2 class="text-xl">住所</h2>
            <p>大学の住所です。（例：東京都世田谷区宇奈根1-1-1）</p>
            <input type="text" name="university[address]" placeholder="大学名"value="{{ old('university.address') }}" /><br>
            @if ($errors->has('university.address'))
            <div class="validerror">
                @foreach ($errors->get('university.address') as $message)
                <li>{{ $message }}</li>
                @endforeach</div>
            @endif
            <h2 class="text-xl">URL</h2>
            <p>大学の公式サイトのURLです。</p>
            <input type="text" name="university[url]" placeholder="公式サイトのURL"value="{{ old('university.url') }}" /><br>
            @if ($errors->has('university.url'))
            <div class="validerror">
                @foreach ($errors->get('university.url') as $message)
                <li>{{ $message }}</li>
                @endforeach</div>
            @endif
            <h2 class="text-xl">最寄り駅</h2>
            <p>大学の最寄り駅です。一つでお願いします。（例：東急田園都市線・大井町線「二子玉川」駅）</p>
            <input type="text" name="university[nearest_station]" placeholder="大学名" value="{{ old('university.nearest_station') }}" /><br>
            @if ($errors->has('university.nearest_station'))
            <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
                @foreach ($errors->get('university.nearest_station') as $message)
                <li>{{ $message }}</li>
                @endforeach</div>
            @endif
            <div class="">
            <input type="submit" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md  text-xs text-white tracking-widest hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out" value="大学データ変更"/>
            <a class="bg-gray-200 inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-xs  text-gray-700 shadow-sm transition ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25" href="{{ route('university_index') }}">変更せず戻る</a>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>
</x-app-layout>