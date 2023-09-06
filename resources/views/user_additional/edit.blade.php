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
            <p>必須です。投稿がどの大学に関連しているかについてです。</p>
            <p>この一覧は大学一覧ページと同じ順番で並んでいます。</p>
            <select name="additional[university_id]">
                <option value="">未設定</option>
                @foreach($universities as $university)
                @if($user->university_id == $university->id ||  old('post.university_id') == $university->id)
                <option value="{{ $university->id }}" selected>{{ $university->name }}</option>
                @else
                <option value="{{ $university->id }}">{{ $university->name }}</option>
                @endif
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
            <fieldset>
            <div>
                @if($user->grade == "" ||  old('additional.grade') == "")
                <input type="radio" id="kubun0" name="additional[grade]" value="" />
                @else
                <input type="radio" id="kubun0" name="additional[grade]" value="" checked />
                @endif
                <label for="kubun0">未設定</label>
                @if($user->grade == "大学入学前" ||  old('additional.grade') == "大学入学前")
                <input type="radio" id="kubun1" name="additional[grade]" value="大学入学前" />
                @else
                <input type="radio" id="kubun1" name="additional[grade]" value="大学入学前" checked />
                @endif
                <label for="kubun1">大学入学前</label>
                @if($user->grade == "大学生" ||  old('additional.grade') == "大学生")
                <input type="radio" id="kubun2" name="additional[grade]" value="大学生" checked />
                @else
                <input type="radio" id="kubun2" name="additional[grade]" value="大学生" />
                @endif
                <label for="kubun2">大学生</label>
                @if($user->grade == "大学院生（修士）" ||  old('additional.grade') == "大学院生（修士）")
                <input type="radio" id="kubun3" name="additional[grade]" value="大学院生（修士）" checked />
                @else
                <input type="radio" id="kubun3" name="additional[grade]" value="大学院生（修士）" />
                @endif
                <label for="kubun3">大学院生（修士）</label>
                @if($user->grade == "大学院生（博士）" ||  old('additional.grade') == "大学院生（博士）")
                <input type="radio" id="kubun4" name="additional[grade]" value="大学院生（博士）" checked/>
                @else
                <input type="radio" id="kubun4" name="additional[grade]" value="大学院生（博士）" />
                @endif
                <label for="kubun4">大学院生（博士）</label>
                @if($user->grade == "卒業生" ||  old('additional.grade') == "卒業生")
                <input type="radio" id="kubun5" name="additional[grade]" value="卒業生" checked/>
                @else
                <input type="radio" id="kubun5" name="additional[grade]" value="卒業生" />
                @endif
                <label for="kubun5">卒業生</label>
            </div>
            </fieldset>
            
            <h2>分野</h2>
            <p>所属する分野です。</p>
            {{--エラーがある場合初期値を差し替える--}}
            @if($errors->any())
                <input type="text" name="additional[section]" placeholder="タイトル" value="{{old('additional.section')}}"/>
            @else
                <input type="text" name="additional[section]" placeholder="タイトル" value="{{$user->section}}"/>
            @endif<br>
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
                        @endforeach
                    </div>
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