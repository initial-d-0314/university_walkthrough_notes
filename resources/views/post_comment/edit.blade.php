<!DOCTYPE html>
<x-app-layout>
    <body>
    @unless($post->user->id == Auth::id())
    この投稿の投稿者ではないので編集できません。
    @else
        <h1>投稿編集</h1>
        <form action="{{route('postcomment_edit', ['post' => $post->id])}}" method="post" enctype="multipart/form-data">
            @CSRF
            @method('PUT')
            <h2>タイトル</h2>
            <p>必須です。投稿のタイトルです。</p>
            <input type="text" name="post[title]" placeholder="タイトル" value="{{ $errors->any() ? old('post.title'): $post->title}}"/>
            <br>
            <!--エラーがある場合リストで全部見せる-->
            @if($errors->has('post.title'))
            <div class="validerror">
            @foreach($errors->get('post.title') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif

            <h2>本文</h2>
            <p>必須です。投稿の本文です。</p>
            <textarea name="post[body]" placeholder="投稿内容を書いてね">{{ $errors->any() ? old('post.body'): $post->body}}</textarea><br>
            @if($errors->has('post.body'))
            <div class="validerror">
            @foreach($errors->get('post.body') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif

            <h2>ジャンル・カテゴリ選択</h2>
            <p>必須です。投稿がどのカテゴリに含まれているのかについてです。</p>
            <p>この一覧はジャンル・カテゴリ一覧ページと同じ順番で並んでいます。</p>
            <select name="post[category_id]">
                <option value="">（未選択）</option>
                @foreach($genres as $genre)
                <optgroup label="{{$genre->name}}:{{$genre->description}}">
                    @foreach($categories as $category)
@continue($genre->id != $category->genre_id)
                    <option value="{{ $category->id }}" {{($post->category_id == $category->id || old('post.category_id') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                    @endforeach
            </select>
            @if($errors->has('post.category_id'))
            <div class="validerror">
            @foreach($errors->get('post.category_id') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif
            

            <h2>大学選択</h2>
            <p>必須です。投稿がどの大学に関連しているかについてです。</p>
            <p>この一覧は大学一覧ページと同じ順番で並んでいます。</p>
            <select name="post[university_id]">
                @foreach($universities as $university)
                <option value="{{ $university->id }}" {{($post->university_id == $university->id || old('post.university_id') == $university->id) ? 'selected' : '' }}>{{ $university->name }}</option>
                @endforeach
            </select>
            @if($errors->has('post.university_id'))
            <div class="validerror">
            @foreach($errors->get('post.university_id') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif

            <h1>オプション</h1>
            <h2>開始時刻、終了時刻</h2>
            <p>イベントやキャンペーンの日時を記載できます。使用する場合は開始時刻と終了時刻の両方の入力が必要です。</p>
            <p>正確な値がわからない場合には適当な値でも構いません。</p>
            <input type="checkbox" name="post[use_time]" id="use_time" value="use" {{($post->use_time == "use" || ($errors->any() && old('post.use_time') == "use")) ? 'checked' : '' }}/>
            <label for="use_time">時刻を設定する</label>
            <p>開始日時</p>
            <input type="date" name="post[stdate]" value="{{ $errors->any() ? old('post.stdate'): $post->stdate}}" />
            <input type="time" name="post[sttime]" value="{{ $errors->any() ? old('post.sttime'): substr($post->sttime, 0,-3)}}"/><br>
            @if($errors->has('post.stdate'))
            <div class="validerror">
            @foreach($errors->get('post.stdate') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif
            @if($errors->has('post.sttime'))
            <div class="validerror">
            @foreach($errors->get('post.sttime') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif

            <p>終了日時</p>
            <input type="date" name="post[endate]" value="{{ $errors->any() ? old('post.endate'): $post->endate}}" />
            <input type="time" name="post[entime]" value="{{ $errors->any() ? old('post.entime'): substr($post->entime, 0,-3)}}"/><br>
            @if($errors->has('post.endate'))
            <div class="validerror">
            @foreach($errors->get('post.endate') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif
            @if($errors->has('post.entime'))
            <div class="validerror">
            @foreach($errors->get('post.entime') as $message)
            <li>{{$message}}</li>
            @endforeach</div>
            @endif

            <h2>画像変更</h2>
            <div class="image">
            <p>画像を上書き、追加する形で変更できます。</p>
            <input type="file" name="image">
            </div>
            <h2>画像削除削除</h2>
            <div class="delete_image">
            <p>画像を削除できます。画像の変更と同時に使用した場合、変更した画像も含めて削除されます。</p>
            <input type="checkbox" id="del_img" name="post[delete_image]" value="use" {{($errors->any() && old('post.delete_image') == "use") ? 'checked' : '' }}/>
            <label for="del_img">画像を削除する</label>
            </div>

            <input type="submit" value="編集する" />
        </form>
        <hr>
                <div>
                <form action="/post/{{$post->id}}/delete" method="POST">
                @csrf
                @method('PUT')
                <input type="checkbox" id="del" value = 'on' name="post[deletecheck]"/>
                    <label for="del">この投稿を削除する</label>
                    <input type="submit" value="削除" />
                </form>
                </div>
        
        
        @php
            $ref = request()->server->get('HTTP_REFERER');
        @endphp
        {{--リファラ値があり、かつ外部サイトでなければaタグで戻るリンクを表示--}}
        <div class="footer">
            <a href={{$ref}}>編集せず前のページに戻る</a>
        </div>
    @endunless
    </body>
</x-app-layout>