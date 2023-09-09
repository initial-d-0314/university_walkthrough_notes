<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    /*
    *どの要素をfillで流し込んでもいいのかの一覧
    */
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'post_id',
    ];
    
    //eagerロードする
    function getPaginateByLimit(int $limit_count = 5)
    {
        return $this::with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    // Postに対するリレーション（1対多）
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    // Userに対するリレーション（1対多）
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
