<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'section',
        'grade',
        'introduction',
        'image_url',
        'user_id',
        'university_id', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Postに対するリレーション（1対多）
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // PostCommentに対するリレーション（1対多）
    public function postcomments()
    {
        return $this->hasMany(PostComment::class);
    }

    // Favoriteに対するリレーション（1対多）
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    // Helpに対するリレーション（1対多）
    public function helps()
    {
        return $this->hasMany(Help::class);
    }
    // Universityに対するリレーション（1対多）
    public function university()
    {
        return $this->belongsTo(University::class);
    }

}
