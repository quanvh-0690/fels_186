<?php
namespace App\Repositories\Eloquent;

use App\Models\Answer;
use App\Repositories\Contracts\AnswerRepositoryInterface;

class AnswerRepository extends BaseRepository implements AnswerRepositoryInterface
{
    public function model()
    {
        return Answer::class;
    }
}