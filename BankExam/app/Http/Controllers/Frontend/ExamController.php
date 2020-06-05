<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamService;

class ExamController extends Controller
{
	protected $examService;
	public function __constructor(ExamService $examService)
	{
		$this->examService = $examService;
	}
    public function index()
    {
    	$exams = $this->examService->getAll();

        return view('frontend.exams.index',['exams' => $exams]);
    }

    public function show($id)
    {
        $exam = $this->examService->findById($id);
        return view('frontend.exams.show',['exam' => $exam]);
    }
}
