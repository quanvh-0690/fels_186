<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLesson extends Model {

    protected $table = 'user_lessons';
    protected $fillable = [
        'user_id',
        'lesson_id',
        'status',
    ];

    public function result()
    {
        return $this->hasOne('App\Models\Result', 'user_lesson_id');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson', 'lesson_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}