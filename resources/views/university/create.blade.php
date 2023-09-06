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
        <form action="/university" method="post">
            @csrf
            <h1>大学情報追加</h1>
            <hr>
            <h2>大学名</h2>
            <p>必須です。大学のキャンパス名まで含んだ名称です。略称ではなく正式名称で登録をお願いします。</p>
            <input type="text" name="university[name]" placeholder="大学名" value="{{ old('university.name') }}" /><br>
            {{-- エラーがある場合リストで全部見せる --}}
            @if ($errors->has('university.name'))
            <div class="validerror">
                @foreach ($errors->get('university.name') as $message)
                    <li>{{ $message }}</li>
                @endforeach</div>
            @endif

            <h2>分類</h2>
            <p>大学の分類です。（例：理系、文系、スポーツ専門）</p>
            <input type="text" name="university[section]" placeholder="分類" value="{{ old('university.section') }}" /><br>
            {{-- エラーがある場合リストで全部見せる --}}
            @if ($errors->has('university.section'))
            <div class="validerror">
                @foreach ($errors->get('university.section') as $message)
                    <li>{{ $message }}</li>
                @endforeach</div>
            @endif

            <h2>住所</h2>
            <p>大学の住所です。（例：東京都世田谷区宇奈根1-1-1）</p>
            <input type="text" name="university[address]" placeholder="大学名"
                value="{{ old('university.address') }}" /><br>
            {{-- エラーがある場合リストで全部見せる --}}
            @if ($errors->has('university.address'))
            <div class="validerror">
                @foreach ($errors->get('university.address') as $message)
                    <li>{{ $message }}</li>
                @endforeach</div>
            @endif
            <h2>URL</h2>
            <p>大学の公式サイトのURLです。</p>
            <input type="text" name="university[url]" placeholder="公式サイトのURL"value="{{ old('university.url') }}" /><br>
            {{-- エラーがある場合リストで全部見せる --}}
            @if ($errors->has('university.url'))
            <div class="validerror">
                @foreach ($errors->get('university.url') as $message)
                    <li>{{ $message }}</li>
                @endforeach</div>
            @endif
            <h2>最寄り駅</h2>
            <p>大学の最寄り駅です。一つでお願いします。（例：東急田園都市線・大井町線「二子玉川」駅）</p>
            <input type="text" name="university[nearest_station]" placeholder="大学名"
                value="{{ old('university.nearest_station') }}" /><br>
            {{-- エラーがある場合リストで全部見せる --}}
            @if ($errors->has('university.nearest_station'))
            <div class="validerror">
                @foreach ($errors->get('university.nearest_station') as $message)
                    <li>{{ $message }}</li>
                @endforeach</div>
            @endif
            <input type="submit" value="大学データ追加" />
        </form>
        <div class="footer">
            <a href="/university">追加せず戻る</a>
        </div>
    </body>
</html>
</x-app-layout>