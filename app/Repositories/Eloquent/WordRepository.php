<?php
namespace App\Repositories\Eloquent;

use App\Models\Word;
use App\Repositories\Contracts\WordRepositoryInterface;

class WordRepository extends BaseRepository implements WordRepositoryInterface
{
    public function model()
    {
        return Word::class;
    }
}