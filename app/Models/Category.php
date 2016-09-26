<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $table = 'categories';
    protected $fillable = [
        'parent_id',
        'name',
    ];

    protected $appends = [
        'lessons_count',
        'list_lessons',
    ];

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }
    
    public function parentCategory()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id','id');
    }
    
    public function childCategories()
    {
        return $this->hasMany('App\Models\Category','parent_id','id');
    }
    
    public function getLessonsCountAttribute()
    {
        return $this->countLessons($this);
    }
    
    public function getListLessonsAttribute()
    {
        if (!$this->parent_id) {
            $lessons = collect();
            foreach ($this->childcategories as $childcategory) {
                foreach ($childcategory->lessons as $lesson) {
                    $lessons->push($lesson);
                }
            }
            
            return $lessons;
        }
        
        return $this->lessons;
    }
    
    private function countLessons($category)
    {
        $count = 0;
        if ($category->childcategories->count()) {
            foreach ($this->childcategories as $childcategory) {
                $count += $this->countLessons($childcategory);
            }
        } else {
            $count = $category->lessons->count();
        }
        
        return $count;
    }
}