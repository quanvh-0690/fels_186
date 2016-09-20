<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

    protected $table = 'answers';
    protected $fillable = [
        'word_id',
        'content',
        'is_correct'
    ];

    public function word()
    {
        return $this->belongsTo('App\Models\Word', 'word_id');
    }
}