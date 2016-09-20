<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

    protected $table = 'activities';
    protected $fillable = [
        'user_id',
        'object_id',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}