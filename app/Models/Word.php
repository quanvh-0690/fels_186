<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model {

    protected $table = 'words';
    protected $fillable = [
        'lesson_id',
        'content',
    ];
    protected $appends = [
        'correct_answers',
        'wrong_answers',
    ];

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson', 'lesson_id');
    }
    
    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'word_id');
    }
    
    public function getCorrectAnswersAttribute()
    {
        return $this->answers()->where('is_correct', config('answer.correct'))->get();
    }
    
    public function getWrongAnswersAttribute()
    {
        return $this->answers()->where('is_correct', config('answer.wrong'))->get();
    }
}