<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Students
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
  
      if(Auth::user()->role_id == 2){
        return redirect('/dashboard');
      }
      elseif(Auth::user()->role_id == 3){
        return redirect('/subjectload');
      }
        return $next($request);
    }
}
