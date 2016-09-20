<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model {

    protected $table = 'relationships';
    protected $fillable = [
        'follower_id', 'followed_id',
    ];

    public function follower()
    {
        return $this->belongsTo('App\Models\User', 'follower_id');
    }

    public function followed()
    {
        return $this->belongsTo('App\Models\User', 'followed_id');
    }
}