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
        <h1>ユーザー追加情報編集</h1>
        <form action="/useradditional/" method="post">
            @CSRF
            @method('PUT')
            
            <h2>大学選択</h2>
            <p>あなたがどの大学に所属しているかについてです。</p
            <p>大学に所属していない場合、あるいは卒業している場合は未設定でも構いません。</p>
            <p>この一覧は大学一覧ページと同じ順番で並んでいます。</p>
            <select name="additional[university_id]">
                <option value="">未設定</option>
                @foreach($universities as $university)
                <option value="{{ $university->id }}" {{($user->university_id == $university->id ||  old('post.university_id') == $university->id) ? 'selected' : '' }}>{{ $university->name }}</option>
                @endforeach
            </select>
            </select>
            @if($errors->has('post.university_id'))
            <div class="validerror">
            @foreach($errors->get('post.university_id') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif
                
                
            <h2>区分選択</h2>
            <p>あなたがどの区分に所属しているかです。</p>
            <fieldset>
            <div>
                <input type="radio" id="kubun0" name="additional[grade]" value=""{{($user->grade == "" ||  old('additional.grade') == "") ? 'checked' : '' }}/>
                <label for="kubun0">未設定</label>
                <input type="radio" id="kubun1" name="additional[grade]" value="大学入学前" {{($user->grade == "大学入学前" ||  old('additional.grade') == "大学入学前") ? 'checked' : '' }} />
                <label for="kubun1">大学入学前</label>
                <input type="radio" id="kubun2" name="additional[grade]" value="大学生" {{($user->grade == "大学生" ||  old('additional.grade') == "大学生") ? 'checked' : '' }} />
                <label for="kubun2">大学生</label>
                <input type="radio" id="kubun3" name="additional[grade]" value="大学院生（修士）" {{($user->grade == "大学院生（修士）" ||  old('additional.grade') == "大学院生（修士）") ? 'checked' : '' }} />
                <label for="kubun3">大学院生（修士）</label>
                <input type="radio" id="kubun4" name="additional[grade]" value="大学院生（博士）" {{($user->grade == "大学院生（博士）" ||  old('additional.grade') == "大学院生（博士）") ? 'checked' : '' }}/>
                <label for="kubun4">大学院生（博士）</label>
                <input type="radio" id="kubun5" name="additional[grade]" value="卒業生" {{($user->grade == "卒業生" ||  old('additional.grade') == "卒業生") ? 'checked' : '' }}/>
                <label for="kubun5">卒業生</label>
            </div>
            </fieldset>
            
            <h2>分野</h2>
            <p>所属している分野です。</p>
            <p>卒業している場合などは以前の所属を記入してください。</p>
            <input type="text" name="additional[section]" placeholder="タイトル" value="{{ $errors->any() ? old('additional.section'): $user->section}}"/>
            <br>
            <!--エラーがある場合リストで全部見せる-->
            @if($errors->has('post.title'))
            <div class="validerror">
            @foreach($errors->get('post.title') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif
            
            <h2>自己紹介文</h2>
            <textarea id="comment" name="additional[introduction]" placeholder="自己紹介">{{ $errors->any() ? old('additional.introduction'): $user->introduction}}</textarea>
            @if($errors->has('additional.introduction'))
            <div class="validerror">
                @foreach($errors->get('additional.introduction') as $message)
                <li>{{$message}}</li>
                @endforeach</div>
            @endif
                
            <h2>画像（未実装）</h2>
            <p>削除ボタンとかになると思うよ</p>
            <input type="submit" value="編集を確定する" />
        </form>
        <div class="footer">
            <a href="/">投稿せずトップページに戻る</a>
        </div>
    </body>

</html>
</x-app-layout>