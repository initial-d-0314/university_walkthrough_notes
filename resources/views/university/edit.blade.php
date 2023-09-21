<!DOCTYPE html>
<x-app-layout>
    <body>
    <div class="h-full w-full" style="background-image: url('/image/p0307_m.png'); background-repeat:no-repeat; background-size:cover">
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
        <form action="{{ route('university_update',['university' => $university->id])}}" method="post">
            @csrf
            @method('PUT')
            <h1>大学情報追加</h1>
            <hr>
            <h2>大学名</h2>
            <p>必須です。大学のキャンパス名まで含んだ名称です。略称ではなく正式名称で登録をお願いします。</p>
            <input type="text" name="university[name]" value="{{ $errors->any() ? old('university.name'): $university->name}}"/>
            <br>
            @if($errors->has('university.name'))
            <div class="validerror">
                @foreach($errors->get('university.name') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif

            <h2>分類</h2>
            <p>大学の分類です。（例：理系、文系、スポーツ専門）</p>
            <input type="text" name="university[section]" value="{{ $errors->any() ? old('university.section'): $university->section}}"/>
            @if($errors->has('university.section'))
            <div class="validerror">
                @foreach($errors->get('university.section') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif

            <h2>住所</h2>
            <p>大学の住所です。（例：東京都世田谷区宇奈根1-1-1）</p>
            <input type="text" name="university[address]" value="{{ $errors->any() ? old('university.address'): $university->address}}"/>
            @if($errors->has('university.address'))
            <div class="validerror">
                @foreach($errors->get('university.address') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif

            <h2>URL</h2>
            <p>大学の公式サイトのURLです。</p>
            <input type="text" name="university[url]" value="{{ $errors->any() ? old('university.url'): $university->url}}{{old('university.url')}}"/>
            <br>
            @if($errors->has('university.url'))
            <div class="validerror">
                @foreach($errors->get('university.url') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif

            <h2>最寄り駅</h2>
            <p>大学の最寄り駅です。一つでお願いします。（例：東急田園都市線・大井町線「二子玉川」駅）</p>
            <input type="text" name="university[nearest_station]" value="{{ $errors->any() ? old('university.nearest_station'): $university->nearest_station}}"/>
            <br>
            @if($errors->has('university.nearest_station'))
            <div class="validerror">
                @foreach($errors->get('university.nearest_station') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif
        <div class="">
            <input type="submit" value="大学データ変更"/>
            <a class="ml-4" href="{{ route('university_index') }}">変更せず戻る</a>
        </div>
        </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</x-app-layout>