<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\category;

class Wellcome extends Controller
{
    //

    public function welcome() {
        $category=category::paginate(10 , ['*'], 'cat');
        $posts = Post::where("state", 1)->paginate(10 , ['*'], 'post');
        return view('welcome',compact('posts', 'category'));
    }
}