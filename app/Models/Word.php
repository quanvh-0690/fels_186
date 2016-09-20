<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model {

    protected $table = 'words';
    protected $fillable = [
        'lesson_id',
        'content',
    ];

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson', 'lesson_id');
    }
}