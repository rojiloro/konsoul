<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Post;
use App\category;

class Wellcome extends Controller
{
    //

    public function welcome() {
        $category=Post::rightJoin('categories', 'posts.category', '=', 'categories.id')
        ->select(DB::raw('categories.id, categories.name,count(posts.category) as total'))
        ->groupBy('categories.id','categories.name')->get();

        $posts = Post::where("state", 1)->orderBy('created_at','DESC')->paginate(10 , ['*'], 'post');
        
        return view('welcome',compact('posts', 'category'));
    }
}