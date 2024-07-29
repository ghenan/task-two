<?php

namespace App\Http\Controllers\Api;

use App\Events\SendEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use App\Traits\UploadImage;
class SignupController extends Controller
{
    use UploadImage ;
    public function signup(SignupRequest $request)
    {
        $user_new = $request->validated();
        $user_new['password']=Hash::make($request['password']);
        $user = User::query()->create($user_new);
        self::upload($request , $user , 'files' , 'files of signup');

     if ($user){
         event(new SendEmail($user));
     }

        $access['token']    = $user->createToken('user')->plainTextToken;

        $access['success']  = true;
        $code = User::where('email',$this->input('email'))->first();
        $code =generatecode();
        return ApiResponse::sendResponse('200','welcome user',$user);

    }
}
