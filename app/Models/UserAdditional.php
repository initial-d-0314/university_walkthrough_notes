<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdditional extends Model
{
    use HasFactory;
    
    /*
    *どの要素をfillで流し込んでもいいのかの一覧
    */
    protected $fillable = [
    'section',
    'grade',
    'introduction',
    'image_address',
    'user_id',
    'university_id', 
    ];
    // Userに対するリレーション（1対1）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Universityに対するリレーション（1対多）
    public function university()
    {
        return $this->belongsTo(University::class);
    }

}


