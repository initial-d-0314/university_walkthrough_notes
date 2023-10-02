<!DOCTYPE html>
<x-app-layout>
    <div class="p-8">
    <div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
    <h1 class="text-3xl">ユーザー追加情報編集</h1>
    <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
    <form action="{{route('useradditional_update')}}" method="post" enctype="multipart/form-data">
        @CSRF
        @method('PUT')
        
        <h2 class="text-xl">大学選択</h2>
        <p>あなたがどの大学に所属しているかについてです。大学に所属していない場合、あるいは卒業している場合は未設定でも構いません。</p>
        <p>この一覧は大学一覧ページと同じ順番で並んでいます。</p>
        <select class="text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md" name="additional[university_id]">
            <option value="">未設定</option>
            @foreach($universities as $university)
            <option value="{{ $university->id }}" {{($user->university_id == $university->id ||  old('post.university_id') == $university->id) ? 'selected' : '' }}>{{ $university->name }}</option>
            @endforeach
        </select>
        @if($errors->has('post.university_id'))
        <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
        @foreach($errors->get('post.university_id') as $message)
        <li>{{$message}}</li>
        @endforeach</div>
        @endif
            
        <h2 class="text-xl">区分選択</h2>
        <p>あなたがどの区分に所属しているかです。</p>
        <fieldset>
        <div>
            <input type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" id="kubun0" name="additional[grade]" value=""{{($user->grade == "" ||  old('additional.grade') == "") ? 'checked' : '' }}/>
            <label for="kubun0" class="ml-2 text-sm">未設定</label>
            <input type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" id="kubun1" name="additional[grade]" value="大学入学前" {{($user->grade == "大学入学前" ||  old('additional.grade') == "大学入学前") ? 'checked' : '' }} />
            <label for="kubun1" class="ml-2 text-sm">大学入学前</label>
            <input type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" id="kubun2" name="additional[grade]" value="大学生" {{($user->grade == "大学生" ||  old('additional.grade') == "大学生") ? 'checked' : '' }} />
            <label for="kubun2" class="ml-2 text-sm">大学生</label>
            <input type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" id="kubun3" name="additional[grade]" value="大学院生（修士）" {{($user->grade == "大学院生（修士）" ||  old('additional.grade') == "大学院生（修士）") ? 'checked' : '' }} />
            <label for="kubun3" class="ml-2 text-sm">大学院生（修士）</label>
            <input type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" id="kubun4" name="additional[grade]" value="大学院生（博士）" {{($user->grade == "大学院生（博士）" ||  old('additional.grade') == "大学院生（博士）") ? 'checked' : '' }}/>
            <label for="kubun4" class="ml-2 text-sm">大学院生（博士）</label>
            <input type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" id="kubun5" name="additional[grade]" value="卒業生" {{($user->grade == "卒業生" ||  old('additional.grade') == "卒業生") ? 'checked' : '' }}/>
            <label for="kubun5" class="ml-2 text-sm">卒業生</label>
        </div>
        </fieldset>
        
        <h2 class="text-xl">分野</h2>
        <p>所属している分野です。卒業している場合などは以前の所属を記入してください。</p>
        <input type="text" name="additional[section]" placeholder="タイトル" class="border border-gray-300 rounded-lg bg-gray-50 sm:text-md" value="{{ $errors->any() ? old('additional.section'): $user->section}}"/>
        <br>
        @if($errors->has('post.title'))
        <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
        @foreach($errors->get('post.title') as $message)
        <li>{{$message}}</li>
        @endforeach</div>
        @endif
        
        <h2 class="text-xl">自己紹介文</h2>
        <textarea id="comment" name="additional[introduction]" placeholder="自己紹介">{{ $errors->any() ? old('additional.introduction'): $user->introduction}}</textarea>
        @if($errors->has('additional.introduction'))
        <div class="box-border bg-[#fce3e3] border-2 border-solid border-[#ba2020] rounded border-l-[8px] mt-2 indent-2">
            @foreach($errors->get('additional.introduction') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
        @endif
            
        <h2 class="text-xl">画像</h2>
        <p>画像を追加できます。画像が存在する場合は上書きします。</p>
        <input type="file" name="image">
        
        <h2 class="text-xl">画像削除</h2>
        <p>画像を削除できます。画像の変更と同時に使用した場合、変更した画像も含めて削除されます。</p>
        <input type="checkbox" id="del_img" name="additional[delete_image]" value="use" {{($errors->any() && old('additional.delete_image') == "use") ? 'checked' : '' }}/>
        <label for="del_img">画像を削除する</label>
        <div>
        <input type="submit" class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md  text-xs text-white hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out" value="編集を確定する" />
        <a class="bg-gray-200 inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-xs  text-gray-700 shadow-sm transition ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25" href="{{route('useradditional_index')}}">編集せずに戻る</a>
        </div>
    </form>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>