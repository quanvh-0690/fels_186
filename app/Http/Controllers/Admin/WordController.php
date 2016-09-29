<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordRequest;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\Contracts\WordRepositoryInterface;

class WordController extends Controller
{
    private $wordRepository;
    private $lessonRepository;
    public function __construct(
        WordRepositoryInterface $wordRepository,
        LessonRepositoryInterface $lessonRepository
    ) {
        $this->wordRepository = $wordRepository;
        $this->lessonRepository = $lessonRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = $this->wordRepository->paginate(config('word.index_page_size'));
        
        return view('admin.word.index', compact('words'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.word.create', ['lessons' => $this->lessonRepository->lists('name', 'id')]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  WordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordRequest $request)
    {
        $data = $request->only('content', 'lesson_id');
        $word = $this->wordRepository->create($data);
        if ($word) {
            return redirect()->route('admin.words.index')->with([
                'status' => 'success',
                'message' => trans('messages.admin.words.add.success')
            ]);
        }
    
        return redirect()->back()->with([
            'status' => 'danger',
            'message' => trans('messages.admin.words.add.failed')
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
        $word = $this->wordRepository->find($id);
        if ($word) {
            return view('admin.word.show', compact('word'));
        }
    
        return redirect()->route('admin.words.index')->with([
            'status' => 'danger',
            'message' => trans('messages.admin.words.show.not_found')
        ]);
    }
    
    public function search()
    {
        $params = request()->only('type', 'keyword');
        switch ($params['type']) {
            case 'content':
                $words = $this->searchByContent($params['keyword']);
                break;
            case 'lesson':
                $words = $this->searchByLesson($params['keyword']);
                break;
        }
        
        return view('admin.word.index', ['words' => $words->appends($params)]);
    }
    
    private function searchByContent($keyword)
    {
        return $this->wordRepository->where('content', 'LIKE', "%$keyword%")->paginate(config('word.index_page_size'));
    }
    
    private function searchByLesson($keyword)
    {
        $condition = $keyword ?: "%$keyword%";
        $words = $this->wordRepository->whereHas('lesson', function($query) use ($condition) {
            $query->where('name', 'LIKE', $condition);
        })->paginate(config('word.index_page_size'));
        
        return $words;
    }
}
