<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminExaminer
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
        $user = Auth::user();

        if ( isset($user) && ( $user->user_role->role->name == 'admin' || $user->user_role->role->name == 'examiner' ) ) {
            return $next($request);
        }
        Auth::logout();
        return redirect()->route('login');
    }
}
