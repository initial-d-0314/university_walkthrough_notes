<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

class UserAdditionalController extends Controller
{
    /*
    *ユーザーの固有情報と、それに関連するお気に入りや投稿を管理する
    */
    public function edit(University $university)
    {
        //id直打ちで編集画面に入られたくないのでユーザー情報を取得する
        $user_id = \Auth::user()->id;
        $user = User::where("id",$user_id)->first();

        return view('user_additional.edit')->with([
        'universities'=>$university->get(),
        'user' => $user,
        ]);
    }
    
    public function update(Request $request)
    {
        $user_id = \Auth::user()->id;
        $user = User::where("id",$user_id )->first();
        
        $input_useradditional = $request['additional'];
        
        //削除のチェックがオンである場合はアップロードもしない
        if(!empty($input_useradditional['delete_image'])){
            $input_useradditional += ['image_url' => ""];
        }else{
            //画像投稿（上書き）
            if($request->file('image')){
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input_useradditional += ['image_url' => $image_url];
            }
        }
        $user->fill($input_useradditional)->save();
        return redirect('/useradditional/my');
    }
    
    public function index(Post $post)
    {
        //自分用ページなので自分のidのみを取得する
        $user_id = \Auth::user()->id;
        $user = User::where("id",$user_id)->first();
        return view('user_additional.posts')->with([
            'posts'=> $post->getPaginateByLimitwithUser($user_id,5),
            'user' => $user,
        ]);
    }
    
    public function index_other(User $user,Post $post)
    {
        //他人用ページなので暗黙の結合を使う
        return view('user_additional.posts')->with([
            'posts'=> $post->getPaginateByLimitwithUser($user->id,5),
            'user' => $user,
        ]);
    }
    
    public function favorite(Post $post)
    {
        //自分のお気に入りを参照する
        $user_id = \Auth::user()->id;
        $user = User::where("id",$user_id)->first();
        //joinで結合して疑似的にpost->favorite->userのリレーションをたどる
        $posts = Post::query()->join('favorites', 'posts.id', '=', 'favorites.post_id')->join('users', 'favorites.user_id', '=','users.id' );
        $posts->where('favorites.user_id',$user->id)->get();
        $posts = $posts->withcount('helps')->paginate(5)->withQueryString();
        return view('user_additional.favorites')->with([
            'posts'=> $posts,
            'user' => $user,
        ]);
    }
    
    public function favorite_other(User $user,Post $post)
    {
        //指定された番号のユーザーのお気に入りを取得
        //joinで結合して疑似的にpost->favorite->userのリレーションをたどる
        $posts = Post::query()->join('favorites', 'posts.id', '=', 'favorites.post_id')->join('users', 'favorites.user_id', '=','users.id' );
        $posts->where('favorites.user_id',$user->id)->get();
        //ぺジネーションを5で取っているのがまだ気になる
        $posts = $posts->withcount('helps')->paginate(5)->withQueryString();
        return view('user_additional.favorites')->with([
            'posts'=> $posts,
            'user' => $user,
        ]);
    }
}
