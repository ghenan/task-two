<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if( Auth::guard('user')->attempt(['email'=>$request->email , 'password'=>$request->password]))
        {
            $user =  User::query()->where('email', $request->email)->first();
            $token['token'] = $user->createToken('user',['app:all'])->plainTextToken;
            $token['email'] =$user->email;
            return ApiResponse::sendResponse(201, 'User Logged In Successfully', $token);
        }
        elseif ( ! Auth::attempt($request->only(['email', 'password'])))
        {
            return response()->json([
                'status' => false,
                'message' => 'Credential Of This User Is Wrong Check It Again',
            ], 401);
        }
        return $this->creatNewToken($token);
    }
    public function creatNewToken()
    {
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*20,
        ]);
    }
}
