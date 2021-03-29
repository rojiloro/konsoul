<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use app\user;
use Auth;
use App\AlumniWork as Work;
class AlumniWork
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
        $workId=$request->route('workId');
        $id = Auth::user()->id;
        
        $work=Work::find($workId);

        if($work->user_id != $id){
            return redirect()->route('home');
        }
        return $next($request);
    }
}