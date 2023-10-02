<!DOCTYPE html>
<x-app-layout>
<div class="p-8">
<div class="max-w-7xl mx-auto py-6">
<div class="bg-white shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900">
<h1 class="text-3xl">新規投稿追加</h1>
    <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
    <form action="{{route('postcomment_store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h2 class='text-xl'>タイトル</h2>
    <p>必須です。投稿のタイトルです。</p>
    <input type="text" class="border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="post[title]" placeholder="タイトル" value="{{old('post.title')}}" /><br>
    <!--エラーがある場合リストで全部見せる-->
    @if($errors->has('post.title'))
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors->get('post.title') as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif

    <h2 class='text-xl'>本文</h2>
    <p>必須です。投稿の本文です。</p>
    <textarea name="post[body]" placeholder="投稿内容を書いてね" class="border border-gray-300 rounded-lg bg-gray-50 sm:text-md">{{old('post.body')}}</textarea><br>
    @if($errors->has('post.body'))
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors->get('post.body') as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif

    <h2 class='text-xl'>ジャンル・カテゴリ選択</h2>
    <p>必須です。投稿がどのジャンル、カテゴリに含まれているのかについてです。</p>
    <p>この一覧はジャンル・カテゴリ一覧ページと同じ順番で並んでいます。</p>
{{--カテゴリのidとジャンルの所属しているカテゴリのidで判定を行う、カテゴリの編集は考えていないのでこの書き方で--}}
    <select class="border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="post[category_id]">
        <option value="">（ジャンルを選んでください）</option>
        @foreach($genres as $genre)
        <optgroup label="{{$genre->name}}:{{$genre->description}}">
            @foreach($categories as $category)
@continue($genre->id != $category->genre_id)
            <option value="{{ $category->id }}" {{old('post.category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        @endforeach
    </select>
    @if($errors->has('post.category_id'))
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors->get('post.category_id') as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif

    <h2 class='text-xl'>大学選択</h2>
    <p>必須です。投稿がどの大学に関連しているかについてです。</p>
    <p>この一覧は大学一覧ページと同じ順番で並んでいます。</p>{{--ユーザーの所属する大学idを初期値に、oldがある場合はoldを優先する--}}
    <select class="border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="post[university_id]">
    @if(empty(old('post.university_id')))
        @foreach($universities as $university)
        <option value="{{ $university->id }}" {{($univ == $university->id)? 'selected' : '' }}>{{ $university->name }}</option>
        @endforeach
    @else
        @foreach($universities as $university)
        <option value="{{ $university->id }}" {{(old('post.university_id') == $university->id)? 'selected' : '' }}>{{ $university->name }}</option>
        @endforeach
    @endif
    </select>
    @if($errors->has('post.university_id'))
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors->get('post.university_id') as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif
    <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
    <h1 class='text-2xl'>オプション</h1>
    <h2 class='text-xl'>開始時刻、終了時刻</h2>
    <p>イベントなどの日時を記載できます。使用する場合は開始時刻と終了時刻の両方の入力が必要です。半永久的に続く場合は、本文に記載をお願いします。</p>
    <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" name="post[use_time]" id="use_time"value="use" {{($errors->any() && old('post.use_time') == "use") ? 'checked' : '' }}/>
    <label for="use_time">時刻を設定する</label>
    
    <div class="frex justify-start">
    <h2 class='text-xl'>開始日時</h2>
    <input type="date" name="post[stdate]" value="{{old('post.stdate')}}" />
    <input type="time" name="post[sttime]" value="{{old('post.sttime')}}">
    </div>
    <div class="frex justify-start">
    <h2 class='text-xl'>終了日時</h2>
    <input type="date" name="post[endate]" value="{{old('post.endate')}}" />
    <input type="time" name="post[entime]" value="{{old('post.entime')}}">
    </div>
    @if($errors->has('post.stdate'))
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors->get('post.stdate') as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif
    @if($errors->has('post.sttime'))
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors->get('post.sttime') as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif
    @if($errors->has('post.endate'))
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors->get('post.endate') as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif
    @if($errors->has('post.entime'))
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors->get('post.entime') as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif
    @if($errors->has('start_time'))
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors->get('start_time') as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif
    @if($errors->has('start_time'))
    <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
    @foreach($errors->get('end_time') as $message)
    <li>{{$message}}</li>
    @endforeach</div>
    @endif
    
    <div>
    <h2 class='text-xl'>画像</h2>
    <p>画像を追加できます。</p>
    <input type="file" name="image">
    </div>
    
    <div>
    <input class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md text-white hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out" type="submit" value="投稿する" />
    <a class="bg-gray-200 inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-gray-700 shadow-sm transition ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25" href="{{route('postcomment_index')}}">投稿せず一覧に戻る</a>
    </div>
    </form>
</div>
</div>
</div>
</div>
</x-app-layout>