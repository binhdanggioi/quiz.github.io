<?php

namespace App\Services;
use App\Models\Question;
class QuestionService
{
    /**
     * @param array $data
     * data['name']
     * int $id
     * @param null $id
     * @return
     */
    public function save(array $data,int $id = null)
    {
        return Question::UpdateOrCreate(
            [
                'id' => $id
            ],
            [
                'content' => $data['content']
            ]
        );
    }
    public function getAll($orderBys = [], $limit = 10)
    {
        $query = Question::query();

        if ($orderBys) {
            $query->orderBy($orderBys['column'], $orderBys['sort']);
        }

        return $query->paginate($limit);
    }

    public function findById(int $id)
    {
        return Question::find($id);
    }

    public function delete($ids = [])
    {
        return Question::destroy($ids);
    }

}
