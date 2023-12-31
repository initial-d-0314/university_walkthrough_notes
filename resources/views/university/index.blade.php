<!DOCTYPE html>
<x-app-layout>
    <div class="p-8">
    <div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h1 class="text-3xl">大学一覧</h1>
        <a class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md text-white tracking-widest hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out" href="/university/create">新規大学情報追加</a>
        <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
        <table class="min-w-full border border-black text-center">
    <thead>
        <tr>
        <th class="px-4">大学名</th>
        <th class="px-4">大学公式サイト</th>
        <th class="px-4">最寄り駅</th>
        <th class="px-4">情報編集</th>
        </tr>
    </thead>
    <tbody>
    @foreach($universities as $university)
    <tr class="border border-black">
        <td class="px-4 py-2"><a class="underline" href="{{route('search_index', ['univid' => $university->id])}}">{{$university->name}}</a></td>
        <td class="px-4 py-2">@if($university->url)<a class="underline" href="{{$university->url}}">公式サイト（外部）</a>@else（未登録）@endif</td>
        <td class="px-4 py-2">{{$university->nearest_station ?: "（未登録）"}}</td>
        <td class="px-4 py-2"><a class="underline" href="{{ route('university_edit', ['university' => $university->id]) }}">編集</a></td>
    </tr>
    @endforeach
    </tbody>
    </table>
</div>
</div>
</div>
</div>
</x-app-layout>