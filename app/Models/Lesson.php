<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model {

    protected $table = 'lessons';
    protected $fillable = [
        'category_id',
        'name',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    
    public function words()
    {
        return $this->hasMany('App\Models\Word', 'lesson_id');
    }
}