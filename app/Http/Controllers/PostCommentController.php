<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostCommentRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\Category;
use App\Models\Genre;
use App\Models\University;
use App\Models\User;

use Illuminate\Database\Eloquent\SoftDeletes;

use Cloudinary;  //dev4_画像アップロード

class PostCommentController extends Controller
{
    use SoftDeletes;
    public function index(Post $post)
    {
        return view('post_comment.index')->with(['posts'=>$post->getPaginateByLimit()]);
    }

    public function create(Post $post,Genre $genre,Category $category,University $university)
    {
        return view('post_comment.create')->with([
        'universities'=>$university->get(),
        'genres'=>$genre->get(),
        'categories' => $category->get(),
        ]);
    }
    public function edit(Post $post,Genre $genre,Category $category,University $university)
    {
        return view('post_comment.edit')->with([
        'post' => $post,
        'universities'=>$university->get(),
        'genres'=>$genre->get(),
        'categories' => $category->get(),
        ]);
    }

    public function show(Post $post)
    {
        return view('post_comment.show')->with(['post' => $post]);
    }
    //表示部ここまで
    
    public function store(PostRequest $request,Post $post, Category $category)
    {
        $input = $request['post'];
        $input += ['user_id' => \Auth::user()->id];  //追加
        
        $category = Category::find($input['category_id']);
        $input += ['genre_id' => $category->genre->id];  //追加
        
        if(!empty($input['use_time'])){
        $start_time = $input['stdate'] .' '. $input['sttime']. ":00"; //文字列結合をする
        $end_time = $input['endate'] .' '. $input['entime']. ":00"; 
        $input+= ['start_time' => $start_time,'end_time' => $end_time,];
        }
        
        $post->fill($input)->save();
        //saveした時点でidとか日時とかが割り振られている
        return redirect('/post/'. $post->id);
    }
    
    public function update(PostRequest $request,Post $post)
    {
        $input_post = $request['post'];
        
        if(!empty($input_post['use_time'])){
        $start_time = $input_post['stdate'] .' '. $input_post['sttime']. ":00"; //文字列結合をする
        $end_time = $input_post['endate'] .' '. $input_post['entime']. ":00"; 
        $input_post+= ['start_time' => $start_time,'end_time' => $end_time,];
        }
        
        $post->fill($input_post)->save();
        //今回は事前に$Postの中身が存在するのでその中身の変更だけにとどまる
        //updateでなくsaveを利用すれば変更がない場合にDBにアクセスしないという利点がある
        return redirect('/post/'. $post->id);
    }
    
    
    //投稿詳細ページから使う想定で
    public function delete(Request $request,Post $post){
        $input = $request['post'];
        if($input->deletecheck){
        $post->delete();
        return redirect('/post');
        }
    }
    //コメント投稿関連について
    
    public function commentedit(Post $post,PostComment $postcomment){
        return view('post_comment.commentedit')->with([
        'post' => $post,
        'comment' => $postcomment
        ]);
    }
    
    public function commentstore(PostCommentRequest $request,PostComment $postcomment){
        $input = $request['comment'];
        $input += ['user_id' => \Auth::user()->id];  //追加
        $postcomment->fill($input)->save();
        return redirect('/post/'. $input['post_id']);
    }
    
    public function commentupdate(PostCommentRequest $request,Post $post,PostComment $postcomment){
        $input_comment = $request['comment'];
        $input_comment += ['user_id' => \Auth::user()->id];  //追加
        $postcomment->fill($input_comment)->save();
        return redirect('/post/'. $post->id);
    }
    
    //コメントの編集ページから使う想定で
    public function commentdelete(Request $request,Post $post,PostComment $postcomment){
        $input = $request['comment'];
        if($input["deletecheck"] == 'on'){
        $postcomment->delete();
        }
        return redirect('/post/'.$post->id);
    }
    
    //いずれ対応することになるであろう検索機能に備えるとこ
    //かみんぐすーん
    
    
}
