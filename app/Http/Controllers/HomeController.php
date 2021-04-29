<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\profileImg;
use App\category;
use App\Post;
use App\Comment;

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
        $post=post::all()->count();

        $student=user::where('role', 1)->get()->count();
        $teacher=user::where('role', 2)->get()->count();
        $category=category::all()->count();
        $comment=Comment::all()->count();

        $new_user=user::where('state', 0)->get()->count();
    
        if($user->role==0){
            return view('admin', compact('user','new_user','teacher','student','category','post','comment'));
        }else{
            $profileImg=profileImg::where("user_id",$id)->first();
            $pp_img="/img/avatar_default.png";
        }
            if(!$profileImg==null){
                $pp_img="/img/profile-img/".$profileImg->path;
            }
        return view('users' ,compact('pp_img', 'user'));
    }

    public function waitingForApproval(){
        return view('pendingApproval');
    }

    
}