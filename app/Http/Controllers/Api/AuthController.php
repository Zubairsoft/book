<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\forgetPasswordFormRequest;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\ResetPasswordFormRequest;
use App\Http\Resources\ProfileResource;
use App\Jobs\ResetPassword;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
    {
        $validate_data=$request->validated();
        $validate_data['password']=bcrypt($request->password);
        $user=User::create($validate_data);
        $user->sendEmailVerificationNotification();//this function will be send the email verifiction;
        // $accessToken = $user->createToken('authToken')->accessToken;


        return successResponse($user,__('index.data.found'),201);

    }

    public function login(LoginFormRequest $request)
    {
     $validate_data=$request->validated();
     if (!Auth::attempt($validate_data)) {
        return response()->json([
            'status'=>false,
            'message'=>"we have not this"
        ]);
     }

     $accessToken = auth()->user()->createToken('authToken')->accessToken;
     return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }


    public function profile()
    {
     $user=auth()->user();
     return response(['status'=>true,'user' =>  new ProfileResource($user) ]);
    }



    public function logout(Request $request)
    {
    // take user token
    $token=$request->user()->token();
    // remove user token
    $token->revoke();

    return [
        'status'=>true,
        'message='=> "logout successfully"
    ];
    }


    public function forgetPassword(forgetPasswordFormRequest $request)
    {
        try {
            //code...

        $email=$request->email;

        if (User::where('email',$email)->doesntExist()) {

            return errorResponse(null,__('auth.email.error'),404);
        }

        $token=Str::random(10);

        $token=DB::table('password_resets')->insert([
            'email'=>$email,
            'token'=>$token
        ]);

        ResetPassword::dispatch($token,$email);

        return successResponse(null,"check your email ");
    } catch (\Throwable $th) {
       return errorResponse($th->getMessage(),"error email not sending");
    }


    }
    public function reset(ResetPasswordFormRequest $request)
    {
$token=$request->token;
$found_token=DB::table('password_resets')->where('token',$token)->first();
if (!$found_token) {
    return errorResponse(null,"don't found token ",404);
}
$user=User::where('email',$found_token->email)->first();
if (!$user) {
    return errorResponse($user,__('auth.email.error'),404);
}

$user->password=Hash::make($request->password);
$user->save();
return successResponse($user,__('auth.password.change'),201);

    }


}
