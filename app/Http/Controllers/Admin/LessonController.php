<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\LessonRepositoryInterface;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    private $lessonRepository;
    private $categoryRepository;
    public function __construct(
        LessonRepositoryInterface $lessonRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = $this->lessonRepository->paginate(config('setting.category.index_page_size'));
        
        return view('admin.lesson.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategoriesForSelectbox();
        
        return view('admin.lesson.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LessonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request)
    {
        $params = $request->only('name', 'category_id', 'description');
        $lesson = $this->lessonRepository->create($params);
        if ($lesson) {
            return response()->json([
                'status' => 'success',
                'message' => trans('messages.admin.lessons.add.success'),
                'url' => route('admin.lessons.index')
            ]);
        }
    
        return response()->json([
            'status' => 'danger',
            'message' => trans('messages.admin.lessons.add.failed')
        ]);
    }
    
    private function getCategoriesForSelectbox()
    {
        $parentCategories = $this->categoryRepository->whereNull('parent_id')->get();
        $categories = [];
        foreach ($parentCategories as $category) {
            if ($category->childCategories->count()) {
                $categories[$category->name] = $this->categoryRepository->where('parent_id', $category->id)->lists('name', 'id')->toArray();
            }
        }
        
        return $categories;
    }
}
