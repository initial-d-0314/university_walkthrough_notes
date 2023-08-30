<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    
    /*
    *どの要素をfillで流し込んでもいいのかの一覧
    */
    protected $fillable = [
        'name',
        'section',
        'address',
        'url',
        'position',
        'nearest_station',
    ];
    
    // UserAdditionalに対するリレーション（1対多）
    public function useradditionals()
    {
        return $this->hasMany(UserAdditional::class);
    }
}
