<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'avatar',
        'role',
        'address',
        'birthday',
        'job',
        'gender',
        'password',
    ];

    protected $rules_update = [
        'fullname' => 'string|max:100',
        'email' => 'email',
        'avatar' => 'image|max:2000',
        'address' => 'string',
        'job' => 'string',
    ];

    protected $rules_role_user = [
        'role' => 'integer',
    ];

    protected function validateUpdateUser(array $data)
    {
        return Validator::make($data, $this->rules_update);
    }

    protected function validateUpdateRoleUser(array $data)
    {
        return Validator::make($data, $this->rules_role_user);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id')->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
