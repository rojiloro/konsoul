<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Post;
use App\category;

class Wellcome extends Controller
{
    //

    public function welcome() {
        if (!Auth::user()) {
            return view('landing');
        }
        $role = Auth::user()->role;
        
        $category=Post::rightJoin('categories', 'posts.category', '=', 'categories.id')
        ->select(DB::raw('categories.id, categories.name,count(posts.category) as total'))
        ->groupBy('categories.id','categories.name')->get();

        if ($role != 2) {
            $id = Auth::user()->id;
            $posts = Post::join('users','posts.user_id','=', 'users.id')
            ->select(DB::raw('posts.id, posts.title, posts.content, posts.category, users.name, posts.created_at'))
            ->where("role", 2)->orWhere('user_id', $id)
            ->orderBy('created_at','DESC')->paginate(10);
        }else{
            $posts = Post::join('users','posts.user_id','=', 'users.id')
            ->select(DB::raw('posts.id, posts.title, posts.content, posts.category, users.name, posts.created_at'))
            ->orderBy('created_at','DESC')->paginate(10);
        }
        
        return view('welcome',compact('posts', 'category'));
    }
}