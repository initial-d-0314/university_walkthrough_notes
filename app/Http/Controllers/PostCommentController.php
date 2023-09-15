<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostCommentRequest;
use App\Http\Requests\SearchRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Help;
use App\Models\Favorite;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\Category;
use App\Models\Genre;
use App\Models\University;
use App\Models\User;
use App\Models\SearchSetting;

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
        //ユーザーの情報見る
        $user_id = \Auth::user()->id;
        $user = User::where("id",$user_id)->first();
        //ユーザー所属のidを見る
        $univ = $user->university_id;
        return view('post_comment.create')->with([
        'universities'=>$university->get(),
        'genres'=>$genre->get(),
        'categories' => $category->get(),
        'univ' =>$univ,
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
        $input += ['start_time' => $start_time,'end_time' => $end_time,];
        }
        
        //画像投稿
        if($request->file('image')){
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += ['image_url' => $image_url];
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
        
        //削除のチェックがオンである場合はアップロードもしない
        if(!empty($input_post['delete_image'])){
            $input_post += ['image_url' => ""];
        }else{
            //画像投稿（上書き）
            if($request->file('image')){
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input_post += ['image_url' => $image_url];
            }
        }
        
        $post->fill($input_post)->save();
        //今回は事前に$Postの中身が存在するのでその中身の変更だけにとどまる
        //updateでなくsaveを利用すれば変更がない場合にDBにアクセスしないという利点がある
        return redirect('/post/'. $post->id);
    }
    
    //投稿詳細ページから使う想定で
    public function delete(Request $request,Post $post){
        $input = $request['post'];
        $userid = Auth::user()->id;
        if($post->user_id == $userid){
            if($input["deletecheck"] == 'on'){
            $post->delete();
            return redirect('/post');
            }
        }else{
            abort(403,"投稿者ではないので削除できません");
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
        $userid = Auth::user()->id;
        if($postcomment->user_id == $userid){
            if($input["deletecheck"] == 'on'){
            $postcomment->delete();
            }
            return redirect('/post/'.$post->id);
        }else{
            abort(403,"投稿者ではないので削除できません");
        }
    }
    
    //検索機能
    public function search(SearchRequest $request,Genre $genre,Category $category,University $university){
        $posts = Post::query();
        //各種情報
        $userid = $request->input('userid');
        $univid = $request->input('univid');
        $genreid = $request->input('genreid');
        $categoryid = $request->input('categoryid');
        //イベントの開催前、開催中、開催後、未設定
        //before,during,after,none
        $eventb = $request->input('eventb');
        $eventd = $request->input('eventd');
        $eventa = $request->input('eventa');
        $eventn = $request->input('eventn');
        $keyword = $request->input('keyword'); //キーワード
        
        /* イベントの開催日時に関しての処理 */
        //現在時刻を文字列で取得
        //タイムゾーンの設定をしないとUTC（9時間前）で渡されてしまう
        date_default_timezone_set('Asia/Tokyo');
        $date = strtotime("now");
        $nowtime = date('Y-m-d H:i:s',$date);
        //全部無入力かどうかの判定、もし全部無入力なら絞り込みはしない
        if(!(empty($eventn)&&empty($eventb)&&empty($eventd)&&empty($eventa))){
            if(empty($eventn)){
                if(empty($eventb)) {
                    $posts->whereNot('start_time','>',$nowtime)->get();
                }
                if(empty($eventd)) {
                    $posts->whereNot(function($query) use ($nowtime){
                        $query->where('start_time','<=',$nowtime)->Where('end_time','>=',$nowtime);
                    })->get();
                }
                if(empty($eventa)){
                    $posts->whereNot('end_time','<',$nowtime)->get();
                }
            }else{
                if(empty($eventb)) {
                    $posts->whereNot('start_time','>',$nowtime)->get();
                }
                if(empty($eventd)) {
                    $posts->whereNot(function($query) use ($nowtime){
                        $query->where('start_time','<=',$nowtime)->Where('end_time','>=',$nowtime);
                    })->get();
                }
                if(empty($eventa)){
                    $posts->whereNot('end_time','<',$nowtime)->get();
                }
                //最後に時間未指定も含むようにする
                //wherenullの影響範囲が広すぎる（ユーザーとかの絞り込みを飛び越える）ので先に処理をかける
                $posts->orWhereNull('use_time');
            }
        }
        
        /* キーワードから検索処理 */
        //「存在するならそれ以外を落とす」処理になっている
        if(!empty($keyword)) {
        $posts->where(function($query) use($keyword){
            $query->where('title', 'LIKE', "%{$keyword}%")->orwhere('body', 'LIKE', "%{$keyword}%");
        })->get();
        }
        /* ユーザーidから検索処理 */
        if(!empty($userid)) {
                $posts->where('user_id',$userid)->get();
        }
        /* 大学idから検索処理 */
        if(!empty($univid)) {
                $posts->where('university_id',$univid)->get();
        }
        /* ジャンルとカテゴリidから検索処理 */
        //両方入ってもいいけど一件もヒットしなくなるよと書いておく
        if(!empty($genreid)) {
                $posts->where('genre_id',$genreid)->get();
        }
        if(!empty($categoryid)) {
                $posts->where('category_id',$categoryid)->get();
        }
        
        /* 入力情報整理 */
        //viewの入力欄などに反映させたいので、汚いがこういう形で書いておく
        $array=array(
        'userid' => $request->input('userid'),
        'univid' => $request->input('univid'),
        'genreid' => $request->input('genreid'),
        'categoryid' => $request->input('categoryid'),
        'eventb' => $request->input('eventb'),
        'eventd' => $request->input('eventd'),
        'eventa' => $request->input('eventa'),
        'eventn' => $request->input('eventn'),
        'keyword' => $request->input('keyword'));

        /* ペジネーション */
        // 5レコードずつ表示する(変更可能にしておきたいけどひとまず)
        $posts = $posts->withcount('helps')->paginate(5)->withQueryString();
        return view('search.posts', ['univid' => $univid])->with([
            'posts' => $posts,
            'universities'=>$university->get(),
            'genres'=>$genre->get(),
            'categories' => $category->get(),
            'datas' => $array,
            ]);
        //ページを開き直すとともに、$postsの情報をHTMLへ送る
    }
    
    //1ページ目にクエリ文字列入れたいという要望に備えて：
    //名前付きのルートにリダイレクトで渡せば自然とのこと
    //参考：https://stackoverflow.com/questions/54702550/how-to-add-query-string-to-laravel-view
    public function search_before(Request $request){
        return redirect()->route('search_index', [
        'userid' => $request->input('userid'),
        'univid' => $request->input('univid'),
        'genreid' => $request->input('genreid'),
        'categoryid' => $request->input('categoryid'),
        'eventb' => $request->input('eventb'),
        'eventd' => $request->input('eventd'),
        'eventa' => $request->input('eventa'),
        'eventn' => $request->input('eventn'),
        'keyword' => $request->input('keyword')
        ]);
    }
    
    //助かった機能の実現に向けて
    public function help(Request $request){
    $user_id = Auth::user()->id;
    $post_id = $request->post_id; // 投稿のidを取得
    // すでにいいねがされているか判定するためにhelpsテーブルから1件取得
    $already_helped = Help::where('user_id', $user_id)->where('post_id', $post_id)->first(); 
    if (!$already_helped) {
        //なかった場合
        $help = new Help; // Helpクラスのインスタンスを作成
        $help->post_id = $post_id;
        $help->user_id = $user_id;
        $help->save();
    } else {
        //あった場合はdeleteする（ソフトデリートの設定があるのでforcedeleteする）
        Help::where('post_id', $post_id)->where('user_id', $user_id)->forceDelete();
    }
    // 投稿のいいね数を取得
    $post_helps_count = Post::withCount('helps')->findOrFail($post_id)->helps_count;
    $param = [
        'post_helps_count' => $post_helps_count,
    ];
    return response()->json($param); // JSONデータをjQueryに返す
    }
    
    //お気に入り機能に向けて
    public function favorite(Request $request){
    $user_id = Auth::user()->id;
    $post_id = $request->post_id; // 投稿のidを取得
    // すでにいいねがされているか判定するためにhelpsテーブルから1件取得
    $already_favorited = Favorite::where('user_id', $user_id)->where('post_id', $post_id)->first(); 
    if (!$already_favorited) {
        //なかった場合
        $favorite = new Favorite; // Helpクラスのインスタンスを作成
        $favorite->post_id = $post_id;
        $favorite->user_id = $user_id;
        $favorite->save();
    }else{
        //あった場合はdeleteする（ソフトデリートの設定があるのでforcedeleteする）
        Favorite::where('post_id', $post_id)->where('user_id', $user_id)->forceDelete();
    }
    }
    
    
    //検索設定の保存と呼び出しについて
    //設定一覧へのルート
    public function index_setting(SearchSetting $searchsetting,Genre $genre,Category $category,University $university)
    {
        $userid = Auth::user()->id;
        return view('search.settings')->with([
            'settings'=>$searchsetting->getPaginateByLimitwithUser($userid,10),
            'universities'=>$university->get(),
            'genres'=>$genre->get(),
            'categories' => $category->get(),
            ]);
    }
    //todo:検索設定を保存するルート
    public function savesetting(Request $request,SearchSetting $searchsetting,Genre $genre,Category $category,University $university)
    {
        $makeuserid = Auth::user()->id;
        $userid = $request->input('userid');
        $univid = $request->input('univid');
        $genreid = $request->input('genreid');
        $categoryid = $request->input('categoryid');
        
        $input = $request->input();
        $input += ['make_user_id' => $makeuserid,
        'user_id' => $userid,
        'university_id' => $univid,
        'genre_id' => $genreid,
        'category_id' => $categoryid,];
        //
        $searchsetting->fill($input)->save();
        //今回は事前に$Postの中身が存在するのでその中身の変更だけにとどまる
        //updateでなくsaveを利用すれば変更がない場合にDBにアクセスしないという利点がある
        return redirect('/search/setting');
    }

    //設定の削除のルート
    public function settingdelete(SearchSetting $searchsetting){
        $searchsetting->delete();
        return redirect('/search/setting');
    }
    
}