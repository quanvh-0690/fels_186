<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Repositories\Contracts\AnswerRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\Contracts\WordRepositoryInterface;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    private $lessonRepository;
    private $categoryRepository;
    private $wordRepository;
    private $answerRepository;
    public function __construct(
        LessonRepositoryInterface $lessonRepository,
        CategoryRepositoryInterface $categoryRepository,
        WordRepositoryInterface $wordRepository,
        AnswerRepositoryInterface $answerRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->categoryRepository = $categoryRepository;
        $this->wordRepository = $wordRepository;
        $this->answerRepository = $answerRepository;
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
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = $this->lessonRepository->find($id);
        if ($lesson) {
            return view('admin.lesson.show', compact('lesson'));
        }
    
        return redirect()->route('admin.lessons.index')->with([
            'status' => 'danger',
            'message' => trans('messages.admin.lessons.show.not_found')
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = $this->lessonRepository->find($id);
        if ($lesson) {
            $categories = $this->getCategoriesForSelectbox();
            
            return view('admin.lesson.edit', compact('lesson', 'categories'));
        }
        
        return redirect()->back()->with([
            'status' => 'danger',
            'message' => trans('messages.admin.lessons.edit.not_found')
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->only('name', 'category_id', 'description');
        $lesson = $this->lessonRepository->update($params, $id);
        if ($lesson) {
            return redirect()->route('admin.lessons.index')->with([
                'status' => 'success',
                'message' => trans('messages.admin.lessons.edit.success')
            ]);
        }
    
        return redirect()->back()->with([
            'status' => 'danger',
            'message' => trans('messages.admin.lessons.edit.failed')
        ]);
    }
    
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->lessonRepository->delete($id);
            $wordIds = $this->wordRepository->where('lesson_id', $id)->lists('id');
            $this->answerRepository->whereIn('word_id', $wordIds)->deleteAll();
            $this->wordRepository->delete($wordIds);
            DB::commit();
            
            return redirect()->route('admin.lessons.index')->with([
                'status' => 'success',
                'message' => trans('messages.admin.lessons.delete.success')
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => trans('messages.admin.lessons.delete.failed')
            ]);
        }
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
