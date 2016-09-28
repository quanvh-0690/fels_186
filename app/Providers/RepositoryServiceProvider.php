<?php
namespace App\Providers;

use App\Repositories\Contracts\AnswerRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\Eloquent\AnswerRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\LessonRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        
    }
    
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
        $this->app->bind(AnswerRepositoryInterface::class, AnswerRepository::class);
    }
}