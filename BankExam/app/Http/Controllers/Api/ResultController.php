<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use   Illuminate\Http\Request;
use App\Services\ResultService;
use Symfony\Component\HttpFoundation\Response;

class ResultController extends Controller
{
    private $resultService;
    public function __construct(ResultService $resultService)
    {
        $this->resultService = $resultService;
    }

    public function store(Request $request)
    {
        try {
            $this->resultService->insertMultiResult($request->result);
            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'errors' => [
                    'status' => false,
                    'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message'=> $e->getMessage(),
                ]
            ]);
        }
    }
}
