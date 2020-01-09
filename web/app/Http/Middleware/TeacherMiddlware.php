<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Constant;
use Auth;

class TeacherMiddlware
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
        if(!auth()->user()->is_active) {
            Auth::logout();
            return redirect('/');
        }
        
        if(auth()->user()->role == Constant::USER_ROLES['teacher']) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
