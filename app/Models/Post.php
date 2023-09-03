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
        'image_addless',
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
    return $this::with(['genre','category','university','user'])->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
    
    // Categoryに対するリレーション（1対多）
    public function postcomments()   
    {
        return $this->hasMany(PostComment::class);  
    }
    
    
}
