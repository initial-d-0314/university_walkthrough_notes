<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Cloudinary;  //dev4_画像アップロード

class UserAdditionalController extends Controller
{
    //ユーザーの固有情報とそれに関連するアレコレを管理する
    public function edit(University $university)
    {
        $user_id = \Auth::user()->id;
        $user = User::where("id",$user_id)->first();

        //id直打ちで変なことになりそうなので暗黙の結合使いたくない
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
        //updateでなくsaveを利用すれば変更がない場合にDBにアクセスしないという利点がある
        return redirect('/useradditional/my');
    }
    
    public function index(Post $post)
    {
        $user_id = \Auth::user()->id;
        $user = User::where("id",$user_id)->first();
        
        return view('user_additional.posts')->with([
            'posts'=> $post->getPaginateByLimitwithUser($user_id,5),
            'user' => $user,
        ]);
    }
    public function index_other(User $user,Post $post)
    {
        return view('user_additional.posts_other')->with([
            'posts'=> $post->getPaginateByLimitwithUser($user->id,5),
            'user' => $user,
        ]);
    }
    
    
    //クエリビルダを使うことになる？
    public function favorite(Post $post)
    {
        $user_id = \Auth::user()->id;
        $user = User::where("id",$user_id)->first();
        $posts = Post::query()->join('favorites', 'posts.id', '=', 'favorites.post_id')->join('users', 'favorites.user_id', '=','users.id' );
        $posts->where('favorites.user_id',$user->id)->get();
        $posts = $posts->withcount('helps')->paginate(5)->withQueryString();
        return view('user_additional.posts_favorite')->with([
            'posts'=> $posts,
            'user' => $user,
        ]);
    }
    
    public function favorite_other(User $user,Post $post)
    {
        $posts = Post::query()->join('favorites', 'posts.id', '=', 'favorites.post_id')->join('users', 'favorites.user_id', '=','users.id' );
        $posts->where('favorites.user_id',$user->id)->get();
        $posts = $posts->withcount('helps')->paginate(5)->withQueryString();
        return view('user_additional.posts_favorite_other')->with([
            'posts'=> $posts,
            'user' => $user,
        ]);
    }
}
