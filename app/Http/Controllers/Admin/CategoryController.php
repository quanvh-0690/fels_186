<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Contracts\AnswerRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\Contracts\WordRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $lessonRepository;
    private $wordRepository;
    private $answerRepository;
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        LessonRepositoryInterface $lessonRepository,
        WordRepositoryInterface $wordRepository,
        AnswerRepositoryInterface $answerRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->lessonRepository = $lessonRepository;
        $this->wordRepository = $wordRepository;
        $this->answerRepository = $answerRepository;
    }
    
    public function create()
    {
        return view('admin.category.create', ['parent_categories' => $this->categoryRepository->whereNull('parent_id')->lists('name', 'id')]);
    }
    
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepository->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id ?: null,
        ]);
        if ($category) {
            return redirect()->route('admin.categories.index')->with([
                'status' => 'success',
                'message' => trans('messages.admin.categories.add.success')
            ]);
        }
        
        return redirect()->back()->with([
            'status' => 'danger',
            'message' => trans('messages.admin.categories.add.failed')
        ]);
    }
    
    public function index()
    {
        $categories = $this->categoryRepository->paginate();
        
        return view('admin.category.index', compact('categories'));
    }
    
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $parentCategories = $this->categoryRepository->whereNull('parent_id')->lists('name', 'id');
        
        return view('admin.category.edit', compact('category', 'parentCategories'));
    }
    
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id ?: null,
        ], $id);
        if ($category) {
            return redirect()->route('admin.categories.index')->with([
                'status' => 'success',
                'message' => trans('messages.admin.categories.edit.success')
            ]);
        }
        
        return redirect()->back()->with([
            'status' => 'danger',
            'message' => trans('messages.admin.categories.edit.failed')
        ]);
    }
    
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            $category = $this->categoryRepository->find($id);
            if (!$category->parent_id) {
                $categoryIds = $this->categoryRepository->where('parent_id', $id)->lists('id');
                $lessonIds = $this->lessonRepository->whereIn('category_id', $categoryIds)->lists('id');
            } else {
                $lessonIds = $this->lessonRepository->where('category_id', $id)->lists('id');
                $categoryIds = $id;
            }
            
            $wordIds = $this->wordRepository->whereIn('lesson_id', $lessonIds)->lists('id');
            $this->answerRepository->whereIn('word_id', $wordIds)->deleteAll();
            $this->wordRepository->delete($wordIds);
            $this->lessonRepository->delete($lessonIds);
            $this->categoryRepository->delete($categoryIds);
            DB::commit();
            
            return redirect()->route('admin.categories.index')->with([
                'status' => 'success',
                'message' => trans('messages.admin.categories.delete.success')
            ]);
        } catch (Exception $e) {
            DB::rollback();
            
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => trans('messages.admin.categories.delete.failed')
            ]);
        }
        
    }
    
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        if ($category) {
            return view('admin.category.show', compact('category'));
        }
        
        return redirect()->route('admin.categories.index')->with([
            'status' => 'danger',
            'message' => trans('messages.admin.categories.show.not_found')
        ]);
    }
}
