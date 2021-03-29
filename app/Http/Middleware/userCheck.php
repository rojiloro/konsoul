<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use app\user;
use Auth;

class userCheck
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
        $id = Auth::user()->id;
        $user=user::find($id);

        if($user->role == 0){
            return redirect()->route('home');
        }
        return $next($request);
    }
}