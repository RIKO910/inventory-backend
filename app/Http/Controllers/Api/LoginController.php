<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(AuthenticationRequest $request){

            $credential =[
                'email'=>$request->email,
                'password'=>$request->password,
            ];
            if(Auth::attempt($credential,true)){
                $user =Auth::user();
                $response =[
                    'status_code' =>200,
                    'status'=>"success",
                    'data'=>[
                        'token' => $user->createToken('riko')->plainTextToken,
                        'name' => $user->name,
                    ],
                ];

                return response()->json($response,200);
            }
            else{
                $response =[
                    'status_code' =>401,
                    'status'=>"success",
                    'data'=>null,
                    'message' =>'Unathorized!'
                ];
                return response()->json($response,401);
            }
    }
}
