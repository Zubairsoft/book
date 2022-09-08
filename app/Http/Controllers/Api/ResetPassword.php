<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Controller
{
    //

    public function changePassword(ChangePasswordFormRequest $request)
    {
        $validate_data=$request->validated();

        $user=Auth::user();
        $user->password=Hash::make($validate_data['password']);
        $user->save();
        return successResponse(new ProfileResource($user),__('auth.password.change'),201);



    }
}
