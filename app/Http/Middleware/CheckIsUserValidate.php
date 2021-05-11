<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsUserValidate
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
        if(!$request->user()->validated){
            return redirect()->action('Wallet\ValidationController@index')->with('danger', 'You need Validade your Documents to access Staking!');
        }

        return $next($request);
    }
}
