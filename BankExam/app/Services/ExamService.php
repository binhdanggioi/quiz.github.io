<?php

namespace App\Services;
use App\Models\Exam;
class ExamService
{
    /**
     * @param array $data
     * data['name']
     * int $id
     * @return
     */
    public function save(array $data,$id = null)
    {
        return Exam::UpdateOrCreate(
            ['id' => $id],
            ['name' => $data['name']]
        );
    }

	public function getAll($orderBys = [],$limit = 10)
	{
	    $query = Exam::query();

	    if ($orderBys) {
	        $query->orderBy($orderBys['column'], $orderBys['sort']);
        }

	    return $query->paginate($limit);
	}

	public function findById($id)
    {
        return Exam::find($id);
    }
	public function delete($ids = [])
    {
        return Exam::destroy($ids);
    }
}
