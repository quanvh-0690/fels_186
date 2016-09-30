<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $appends = [
        'registered_at',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followers()
    {
        return $this->belongsToMany('App\Models\User', 'relationships', 'followed_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany('App\Models\User', 'relationships', 'follower_id', 'followed_id');
    }
    public function isAdmin()
    {
        return $this->role == config('user.role.admin');
    }
    
    public function getRegisteredAtAttribute()
    {
        $created_at = new Carbon($this->attributes['created_at']);
        
        return $created_at->diffForHumans();
    }
}
