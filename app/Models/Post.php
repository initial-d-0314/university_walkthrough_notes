<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    /*
    *どの要素をfillで流し込んでもいいのかの一覧
    */
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'genre_id',
        'category_id',
        'university_id',
        'image_url',
        'use_time',
        'sttime',
        'stdate',
        'start_time',
        'entime',
        'endate',
        'end_time',
    ];
    
    //要素が多すぎるけどeagerロードする
    function getPaginateByLimit(int $limit_count = 5)
    {
    return $this::with(['genre','category','university','user'])->withCount('helps')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    //ユーザーを限定して行う
    function getPaginateByLimitwithUser(int $user_id,int $limit_count = 5)
    {
    return $this::with(['user'])->withCount('helps')->where('user_id',$user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    // Userに対するリレーション（1対多）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Universityに対するリレーション（1対多）
    public function university()
    {
        return $this->belongsTo(University::class);
    }
    // Genreに対するリレーション（1対多）
    public function genre()   
    {
        return $this->belongsTo(Genre::class);  
    }

    // Categoryに対するリレーション（1対多）
    public function category()   
    {
        return $this->belongsTo(Category::class);  
    }
    
    //PostCommentに対するリレーション（1対多）
    public function postcomments()   
    {
        return $this->hasMany(PostComment::class);  
    }
    
    //いいね機能の手引き
    // 実装1
    public function helps()
    {
        return $this->hasMany(Help::class);
    }
    
    // 実装2
    // Viewで使う、いいねされているかを判定するメソッド。
    public function isHelpedBy($user): bool {
        return Help::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
    
    // 実装1
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    
    // 実装2
    // Viewで使う、いいねされているかを判定するメソッド。
    public function isFavoritedBy($user): bool {
        return Favorite::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
    
}
