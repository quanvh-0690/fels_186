<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerRequest;
use App\Models\Lesson;
use App\Models\Word;
use App\Repositories\Contracts\AnswerRepositoryInterface;
use App\Repositories\Contracts\WordRepositoryInterface;

class AnswerController extends Controller
{
    private $answerRepository;
    private $wordRepository;
    public function __construct(
        AnswerRepositoryInterface $answerRepository,
        WordRepositoryInterface $wordRepository
    ) {
        $this->answerRepository = $answerRepository;
        $this->wordRepository = $wordRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request)
    {
        //
    }
    
    public function addAnswerForWord(AnswerRequest $request, $word_id)
    {
        $data = $request->only('content');
        $data['is_correct'] = $request->get('is_correct') ?: 0;
        $word = $this->wordRepository->find($word_id);
        if ($word->answers->count() >= 4) {
            return response()->json([
                'status' => 'danger',
                'message' => trans('messages.admin.answers.add.exceed_number')
            ]);
        }
        $data['word_id'] = $word_id;
        $answer = $this->answerRepository->create($data);
        if ($answer) {
            return response()->json([
                'status' => 'success',
                'message' => trans('messages.admin.answers.add.success'),
                'answer' => $answer,
                'editUrl' => route('admin.words.edit_answer', [$answer->word_id, $answer->id])
            ]);
        }
    
        return response()->json([
            'status' => 'danger',
            'message' => trans('messages.admin.answers.add.failed')
        ]);
    }
}
