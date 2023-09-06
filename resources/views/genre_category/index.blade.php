<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-app-layout>
  <head>
    <meta charset="utf-8">
    <meta name=”viewport” content=”width=device-width,initial-scale=1″>
    <title>大学攻略ガイド</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  </head>
  <h1>ジャンル・カテゴリー一覧</h1>
  <a href="/category/create">新規カテゴリ情報追加はこちら</a>
  @foreach($genres as $genre)
  <hr>
  <h2><a href="{{route('search_index', ['genreid' => $genre->id])}}">{{$genre->name}}</a></h2>
  <p>{{$genre->description}}</p>
  <table border="1">
    <thead>
      <tr>
        <td>カテゴリ名</td>
        <td>説明</td>
        <td>編集</td>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
      @continue($category->genre->id != $genre->id)
      <tr>
        <td><a href="{{route('search_index', ['categoryid' => $category->id])}}">{{$category->name}}</a></td>
        <td>{{$category->description ?: "（未登録）"}}</td>
        <td><a href="/category/{{$category->id}}/edit">編集</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endforeach
  </body>
</x-app-layout>
</html>