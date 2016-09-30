<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\WordRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    private $userRepository;
    private $wordRepository;
    private $categoryRepository;
    private $lessonRepository;
    public function __construct(
        UserRepositoryInterface $userRepository,
        WordRepositoryInterface $wordRepository,
        CategoryRepositoryInterface $categoryRepository,
        LessonRepositoryInterface $lessonRepository
    ) {
        $this->userRepository = $userRepository;
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
        $this->lessonRepository = $lessonRepository;
    }
    
    public function index()
    {
        $totalUsers = $this->userRepository
            ->where('role', config('user.role.member'))
            ->count();
        $totalWords = $this->wordRepository->count();
        $totalLessons = $this->lessonRepository->count();
        $users = $this->userRepository
            ->where('role', config('user.role.member'))
            ->limit(config('admin.number_user_newest'))
            ->orderBy('created_at', 'desc')
            ->get();
        $words = $this->wordRepository
            ->with('lesson', 'answers')
            ->orderBy('created_at', 'desc')
            ->limit(config('admin.number_word_newest'))
            ->get();
        $categories = $this->categoryRepository
            ->with('lessons', 'parentCategory')
            ->orderBy('created_at', 'desc')
            ->limit(config('admin.number_category_newest'))
            ->get();
        $lessons = $this->lessonRepository
            ->with('category', 'words')
            ->orderBy('created_at', 'desc')
            ->limit(config('admin.number_lesson_newest'))
            ->get();
        
        return view('admin.index', compact('users', 'totalUsers', 'totalWords', 'totalLessons', 'words', 'categories', 'lessons'));
    }
}
