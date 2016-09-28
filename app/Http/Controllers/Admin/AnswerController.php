<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerRequest;
use App\Models\Lesson;
use App\Models\Word;
use App\Repositories\Contracts\AnswerRepositoryInterface;

class AnswerController extends Controller
{
    private $answerRepository;
    public function __construct(AnswerRepositoryInterface $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $words = Word::lists('content', 'id');
        $lessons = Lesson::lists('name', 'id');
        return view('admin.answer.create', compact('words', 'lessons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request)
    {
        //
    }
}
