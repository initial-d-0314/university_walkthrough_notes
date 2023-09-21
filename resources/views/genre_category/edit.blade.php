<!DOCTYPE html>
<x-app-layout>
    <div class="h-full w-full" style="background-image: url('/image/p0307_m.png'); background-repeat:no-repeat; background-size:cover">
    <div class="py-12">
    <div class="max-w-7xl mx-auto">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
    <h1>カテゴリ情報変更</h1>
		<hr>
        <form action="{{ route('genrecategory_update', ['category' => $category->id]) }}" method="post">
            @csrf
            @method('PUT')
            <h2>所属ジャンル</h2>
            <p>必須です。カテゴリがどのジャンルに属しているかについてです。</p>
            <select name="category[genre_id]">
                <option value="">（ジャンルを選択してください）</option>
                @foreach($genres as $genre)
                <option value="{{ $genre->id }}" {{(old('genreid') == $genre->id || $category->genre_id == $genre->id) ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
            @if($errors->has('category.genre_id'))
            <div class="validerror">
                @foreach($errors->get('category.genre_id') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif

            <h2>カテゴリ名</h2>
            <p>必須です。カテゴリの名前です。（例：雨宿り）</p>
            <input type="text" name="category[name]" placeholder="カテゴリ名" value="{{ $errors->any() ? old('category.name'):$category->name}}"/>
            <br>
            @if($errors->has('category.name'))
            <div class="validerror">
                @foreach($errors->get('category.name') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif

            <h2>説明文</h2>
            <p>必須です。カテゴリについての説明文です。なるべく短くしてもらうと助かります。</p>
                <input type="text" name="category[description]" placeholder="説明文" value="{{ $errors->any() ? old('category.description'):$category->description}}"/>
            <br>
            @if($errors->has('category.description'))
            <div class="validerror">
                @foreach($errors->get('category.description') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif
            
        <input type="submit" value="ジャンル情報変更"/>
        </form>
        <div class="footer">
            <a href="{{route('genrecategory_index')}}">変更せず戻る</a>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>