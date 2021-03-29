<?php

namespace App\Http\Middleware;

use Closure;
use app\user;
use Auth;

class checkApproval
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

        if($user->state == 0){
            return redirect()->route('waitting-for-approval');
        }
        return $next($request);
    }
}