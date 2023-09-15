<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchSetting extends Model
{
    use HasFactory;
    /*
    *どの要素をfillで流し込んでもいいのかの一覧
    */
    protected $fillable = [
        'user_id',
        'university_id',
        'genre_id',
        'category_id',
        'eventb',
        'eventd',
        'eventa',
        'eventn',
        'keyword',
        'make_user_id',
    ];
    
    //eagerロードする
    function getPaginateByLimitwithUser(int $user_id,int $limit_count = 5)
    {
        
        return $this::with(['user','university','genre','category'])->where('make_user_id',$user_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
    // Universityに対するリレーション（1対多）
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}

