<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class CheckUserBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() && $request->user()->blocked){
            Auth::logout();
            return redirect()->to('/login')->with('danger', 'Your account is blocked. Contact the support for help!');
        }

        return $next($request);
    }
}
