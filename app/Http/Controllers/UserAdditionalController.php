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
        $user->fill($input_useradditional)->save();
        //updateでなくsaveを利用すれば変更がない場合にDBにアクセスしないという利点がある
        return redirect('/useradditional');
    }
    
    public function index(Post $post)
    {
        $user_id = \Auth::user()->id;
        $user = User::where("id",$user_id)->first();
        
        return view('user_additional.posts')->with([
            'posts'=> $post->getPaginateByLimitwithUser(),
            'user' => $user,
        ]);
    }
}
