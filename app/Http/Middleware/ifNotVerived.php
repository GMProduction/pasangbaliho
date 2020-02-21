<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ifNotVerived
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
        if(!(Auth::guard('advertiser')->check())){
            return redirect('/');
        }else{
            if(Auth::guard('advertiser')->user()->telp == null){
                return redirect('verifikasi');
            }
        }
        return $next($request);
    }
}
