<!DOCTYPE html>
<x-app-layout>
    <div class="h-full w-full" style="background-image: url('/image/p0307_m.png'); background-repeat:no-repeat; background-size:cover">
    <div class="py-12">
    <div class="max-w-7xl mx-auto">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
  <h1>ジャンル・カテゴリー一覧</h1>
  <a class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md  text-xs text-white hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out"href="/category/create">新規カテゴリ情報追加はこちら</a>
  @foreach($genres as $genre)
  <hr>
  <div>
  <a class="underline"href="{{route('search_index', ['genreid' => $genre->id])}}">{{$genre->name}}</a>：{{$genre->description}}
  </div>
  <table class="min-w-full border border-black text-center">
    <thead>
      <tr>
        <td class="px-4">カテゴリ名</td>
        <td class="px-4">説明</td>
        <td class="px-4">情報編集</td>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)@continue($category->genre->id != $genre->id)
      <tr class="border border-black">
        <td class="px-4 py-2"><a class="underline" href="{{route('search_index', ['categoryid' => $category->id])}}">{{$category->name}}</a></td>
        <td class="px-4 py-2">{{$category->description ?: "（未登録）"}}</td>
        <td class="px-4 py-2"><a class="underline" href="{{ route('genrecategory_edit', ['category' => $category->id]) }}">編集</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endforeach
    </div>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>