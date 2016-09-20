<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model {

    protected $table = 'results';
    
    protected $fillable = [
        'user_lesson_id',
        'answer_id',
    ];
    
    public function answer()
    {
        return $this->belongsTo('App\Models\Answer', 'answer_id');
    }

    public function userLesson()
    {
        return $this->belongsTo('App\Models\UserLesson');
    }
}