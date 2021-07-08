<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VbrCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $loggedData=session('role');
        if ($loggedData != null && $loggedData == 'vbr') {
            return $next($request);
        }else{
            return redirect('/vbr/login');
        }
    }
}
