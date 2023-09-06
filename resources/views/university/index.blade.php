<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-app-layout>
    <head>
        <meta charset="utf-8">
        <meta name=”viewport” content=”width=device-width,initial-scale=1″>
        <title>大学攻略ガイド</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/index.css')  }}" />
    </head>
    <body>
      <h1>大学一覧</h1>
      <a href="/university/create">新規大学情報追加はこちら</a>
<table border="1" style="border-collapse: collapse">
  <thead>
    <tr>
    <th>大学名</th>
    <th>大学公式サイト</th>
    <th>最寄り駅</th>
    <th>情報編集</th>
    </tr>
  </thead>
  <tbody>
    @foreach($universities as $university)
    <tr>
      <td><a href="{{route('search_index', ['univid' => $university->id])}}">{{$university->name}}</a></td>
      <td>@if($university->url)
      <a href="{{$university->url}}">公式サイト（外部）</a>
      @else
      （未登録）
      @endif</td>
      <td>{{$university->nearest_station ?: "（未登録）"}}</td>
      <td><a href="/university/{{$university->id}}/edit">編集</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>
</x-app-layout>
