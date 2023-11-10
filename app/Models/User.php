<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        'password' => 'hashed',
    ];

    public function ideas(): Relation
    {
        return $this->hasMany(Ideas::class);
    }

    public function votes(): Relation
    {
        return $this->belongsToMany(Idea::class, 'votes');
    }

    public function getAvatar()
    {
        $firstCharacterInEmail = $this->email[0];
        if(is_numeric($firstCharacterInEmail)) {
            $integerToUse = ord(strtolower($firstCharacterInEmail)) - 21;
        } else {
            $integerToUse = ord(strtolower($firstCharacterInEmail)) - 96;
        }
        return 'https://www.gravatar.com/avatar/'
            .md5($this->email)
            .'?s=200'
            .'&d=s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-'
            .$integerToUse
            .'.png';
    }
}
