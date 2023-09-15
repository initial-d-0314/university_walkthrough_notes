<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    /*
    *どの要素をfillで流し込んでもいいのかの一覧
    */
    protected $fillable = [
        'name',
        'description',
        'genre_id',
    ];
    
    // Postに対するリレーション（1対多）
    public function posts()   
    {
        return $this->hasMany(Post::class);  
    }

    // Genreに対するリレーション（1対多）
    public function genre()   
    {
        return $this->belongsTo(Genre::class);  
    }
    
    // SearchSettingに対するリレーション（1対多）
    public function searchsettings()
    {
        return $this->hasMany(SearchSetting::class);
    }

}
