<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerRequest;
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
    
    public function create($wordId)
    {
        $words = $this->wordRepository->lists('content', 'id');
        
        return view('admin.answer.create', compact('wordId', 'words'));
    }
    
    public function store(AnswerRequest $request, $wordId)
    {
        $data = $request->only('content', 'action');
        $data['is_correct'] = $request->get('is_correct') == config('answer.correct') ? $request->get('is_correct') : config('answer.wrong');
        $word = $this->wordRepository->find($wordId);
        $validNumberAnswer = true;
        $message = '';
        if ($word->answers->count() >= config('answer.total_answer_each_word')) {
            $validNumberAnswer = false;
            $message = trans('messages.admin.answers.add.exceed_number', ['total' => config('answer.total_answer_each_word')]);
        } elseif ($word->wrong_answers->count() >= (config('answer.total_answer_each_word') - 1) && !$data['is_correct']) {
            $validNumberAnswer = false;
            $message = trans('messages.admin.answers.add.must_have_correct');
        }
        
        if (!$validNumberAnswer) {
            return response()->json([
                'status' => 'danger',
                'message' => $message
            ]);
        }
        
        $data['word_id'] = $wordId;
        $answer = $this->answerRepository->create($data);
        if ($answer) {
            return response()->json([
                'status' => 'success',
                'message' => trans('messages.admin.answers.add.success'),
                'answer' => $answer,
                'action' => $data['action'],
                'editUrl' => route('admin.words.answers.edit', [$answer->word_id, $answer->id]),
                'redirectUrl' => route('admin.words.show', $answer->word_id),
                'html' => view('admin.answer.answer_row', compact('answer'))->render(),
            ]);
        }
    
        return response()->json([
            'status' => 'danger',
            'message' => trans('messages.admin.answers.add.failed')
        ]);
    }
    
    public function destroy($wordId, $answerId)
    {
        if ($this->answerRepository->delete($answerId)) {
            return response()->json([
                'status' => 'success',
                'id' => $answerId,
                'message' => trans('messages.admin.answers.delete.success')
            ]);
        }
        
        return response()->json([
            'status' => 'danger',
            'message' => trans('messages.admin.answers.delete.failed')
        ]);
    }
    
    public function edit($wordId, $answerId)
    {
        $words = $this->wordRepository->lists('content', 'id');
        $answer = $this->answerRepository->find($answerId);
        if ($answer) {
            return view('admin.answer.edit', compact('answer', 'wordId', 'words'));
        }
        
        return redirect()->back()->with([
            'status' => 'danger',
            'message' => trans('messages.admin.words.edit.not_found')
        ]);
    }
    
    public function update(AnswerRequest $request, $wordId, $answerId)
    {
        $data = $request->only('content', 'is_correct');
        $word = $this->wordRepository->find($wordId);
        $data['is_correct'] = $request->get('is_correct') == config('answer.correct') ? $request->get('is_correct') : config('answer.wrong');
        $validNumberAnswer = true;
        $message = '';
        if ($word->wrong_answers->count() >= (config('answer.total_answer_each_word') - 1) && !$data['is_correct']) {
            $validNumberAnswer = false;
            $message = trans('messages.admin.answers.add.must_have_correct');
        }
        
        if (!$validNumberAnswer) {
            return response()->json([
                'status' => 'danger',
                'message' => $message
            ]);
        }
        
        $answer = $this->answerRepository->update($data, $answerId);
        if ($answer) {
            return response()->json([
                'status' => 'success',
                'message' => trans('messages.admin.answers.edit.success'),
                'action' => $request->get('action'),
                'redirectUrl' => route('admin.words.show', $wordId)
            ]);
        }
    
        return response()->json([
            'status' => 'danger',
            'message' => trans('messages.admin.answers.edit.failed')
        ]);
    }
}
