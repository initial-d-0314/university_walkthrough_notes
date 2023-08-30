<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;
    /*
    *どの要素をfillで流し込んでもいいのかの一覧
    */
    protected $fillable = [
        'user_id',
        'post_id',
    ];
    
    // Userに対するリレーション(1対多)
    public function user()   
    {
        return $this->belongsTo(User::class);  
    }
    // Postに対するリレーション(1対多)
    public function post()   
    {
        return $this->belongsTo(Post::class);  
    }
}
