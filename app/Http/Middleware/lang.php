<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('local')) {
            App::setlocale(session()->get('local'));
        }else{
         $user_lang=$request->user()->lang;
            session()->put('local',$user_lang);
       App::setLocale(session()->get('local'));// the config method read the value from config file
        }
        return $next($request);
    }
}
