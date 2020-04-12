<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
    public function login()
    {
        try {
            $params = request()->only(['email', 'password']);

//            $token = auth()->attempt($params);

//            if (!$token){
//
//                return response()->json([
//                   'errors' => [
//                        'status' => false,
//                        'code'   => Response::HTTP_UNAUTHORIZED,
//                        'message'=> 'Unauthozial',
//                    ]
//                ]);
//            }
            if (! $token = auth()->attempt($params)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->respondWithToken($token);


        }catch (Exception $e){
            return response()->json([
                'errors' => [
                    'status' => false,
                    'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message'=> $e->getMessage(),
                ]
            ]);
        }
    }

    public function logout()
    {
        try {
            $user = auth()->user();
            if(!$user){
                return response()->json([
                'errors' => [
                    'status' => false,
                    'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message'=> 'User expire',
                ]
            ]);
            }

            auth()->logout();

            return response()->json([
                    'status' => true,
                    'code'   => Response::HTTP_OK,
                    'message'=> 'logout successfully',
            ]);
        }catch (Exception $e){
            return response()->json([
                'errors' => [
                    'status' => false,
                    'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message'=> $e->getMessage(),
                ]
            ]);
        }
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
