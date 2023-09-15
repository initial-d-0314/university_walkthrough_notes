<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    
    /*追加を考えていないためfillableは無い*/
    

    // Postに対するリレーション（1対多）
    public function posts()   
    {
        return $this->hasMany(Post::class);  
    }

    // Categoryに対するリレーション（1対多）
    public function categories()   
    {
        return $this->hasMany(Category::class);  
    }
    
    // SearchSettingに対するリレーション（1対多）
    public function searchsettings()
    {
        return $this->hasMany(SearchSetting::class);
    }
}
