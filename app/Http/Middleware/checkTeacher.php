<?php

namespace App\Http\Middleware;

use Closure;
use app\user;
use Auth;
class checkTeacher
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
        $id = Auth::user()->id;
        $user=user::find($id);

        if($user->role != 2){
            return redirect()->route('home');
        }
        return $next($request);
    }
}