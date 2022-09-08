<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocalFormRequest;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    //

    public function __invoke(LocalFormRequest $request)
    {
        try {
            //code...

        session()->put('local',$request->lang);
        $user=$request->user();
        $user->lang=$request->lang;
        $user->save();

        return successResponse($user,__('profile.lang.success'),201);
    } catch (\Throwable $th) {
        return errorResponse($th->getMessage(),__('profile.lang.error'),500);
    }

    }
}
