<?php

namespace App\Services;
use App\Models\Answer;
class AnswerService
{
    
    public function save(array $data, int $id = null)
    {
        return Answer::UpdateOrCreate(
            [
                'id' => $id
            ],
            [
                'question_id' => $data['question_id'],
                'content'     => $data['content'],
                'correct'     => $data['correct'],
            ]
        );
    }

    public function delete($ids = [])
    {
        return Answer::destroy($ids);
    }

    public function deleteByQuestion($questionId)
    {
        Answer::where('question_id', $questionId)->delete();
    }
}
