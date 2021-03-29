<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\profileImg;
use App\AlumniWork;
use App\category;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $user=user::find($id);
        $post=post::all();

        $teacher=user::where('role', 1)->get();
        $student=user::where('role', 2)->get();
        $alumni=user::where('role', 3)->get();
        $category=category::all();

        $new_user=user::where('state', 0)->get();

        if($user->role==0){
            return view('admin', compact('user','new_user','teacher','student','alumni','category','post'));
        }else{
            $profileImg=profileImg::where("user_id",$id)->first();
            $pp_img="/img/avatar_default.png";
            if(!$profileImg==null){
                $pp_img="/img/profile-img/".$profileImg->path;
            }
            $works=AlumniWork::where("user_id", $id)->get();
            return view('users' ,compact('pp_img', 'user', 'works'));
        }
    }

    public function waitingForApproval(){
        return view('pendingApproval');
    }

    
}