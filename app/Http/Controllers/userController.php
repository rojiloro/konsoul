<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\profileImg;
use App\User;
use App\Post;
use App\Like;
use App\category;
use App\Comment;
use App\FavouritePost;
use Brian2694\Toastr\Facades\Toastr;
use Response;
use Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class userController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function imgChange(Request $req){
        $id = Auth::user()->id;
        $user = user::find($id);
        $extension = $req->image->extension();
        $name= $id.".".$extension;
        $req->image->storeAs('profile-img', $name, 'upload-img');


        $profileImg=profileImg::where("user_id",$id)->first();
        if($profileImg==null){
            $pp_img = profileImg::create([
                'user_id' =>  $id,
                'path' => $name,
            ]);
        }else{
            $profileImg->path=$name;
            $profileImg->save();
        }

        return redirect()->route('home');
         
    }

    public function edited(Request $req){
        $id = Auth::user()->id;
        $user=user::find($id);
        $user->name=$req->name;
        $user->role=$req->role;
        $user->home_town=$req->home_town;
        $user->current_city=$req->current_city;
        $user->phone=$req->phone;
        $user->save();
        Toastr::success('User Edited Successfully', 'Edited', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('home');
    }

   

    public function mypost(){
        $id = Auth::user()->id;
        $category=category::all();
        $role = Auth::user()->role;
        if ($role != 2) {
            $posts = Post::where("user_id", $id)->paginate(10);
        } else {
            $posts = Post::paginate(10);
        }
        
        return view("user.mypost", compact("category",'posts'));
    }

    public function newPost(Request $req){
        $id = Auth::user()->id;
        $flag=0;
        $badword = array("idiot", "stupid", "badword", "bangsat", "keparat", "sialan");
        
        foreach ($badword  as $w) {
            if(strpos($req["wysiwyg-editor"], $w)){
                $flag=1;
            }
          }

        $post = Post::create([
            'user_id' =>  $id,
            'title' =>  $req->title,
            'content' =>  $req["wysiwyg-editor"],
            'category' =>  $req->category,
            'own' =>  1,
            'other_id' =>  null,
            'flag' =>  $flag
        ]);

        $postId=$post->id;
        Toastr::success('Post created Successfully', 'Created', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('postView',['id'=>$postId]);
    }

    public function postView($id){
        $own=0;
        $fav=0;
        $userid = Auth::user()->id;
        $post = Post::find($id);
        $user = user::find($post->user_id);
        $category=category::find($post->category);
        $comments=Comment::where('post_id',$id)->get();


        $comments = Comment::leftJoin('users', 'comments.User_id', '=', 'users.id')
        ->select('users.id as user_id','users.name','comments.id','comments.comment')
        ->where('post_id',$id)->get();
        $pp_img=profileImg::where("user_id",$userid)->first();
        if($pp_img==null){
            $pp_img="/img/avatar_default.png";
        }else{
            $pp_img="/img/profile-img/".$pp_img->path;
        }

        if($userid==$post->user_id){
            $own=1;
        }else{
            $own=0;
        }

        $FavouritePost=FavouritePost::where('user_id',$userid)->where('post_id',$id)->first();
        if($FavouritePost!=null){
            $fav=1;
        }

        return view("viewPost", compact('post','category','user','comments','pp_img','own','fav'));
    }

    public function postDelete($id){
        $post = Post::find($id);
        $user_id= Auth::user()->id;
        if($post->user_id==$user_id){
            $post->delete();
            $Comment=Comment::where("post_id",$id)->get();
            foreach($Comment as $cmnt){
                $cmnt->delete();
            }
            $FavouritePost=FavouritePost::where("post_id",$id)->get();
            foreach($FavouritePost as $fav){
                $fav->delete();
            }

            Toastr::success('Post Deleted Successfully', 'Deleted', ["positionClass" => "toast-bottom-right"]);
        }
        return redirect()->route('mypost');
    }

    public function postLike($id){
        
        $like = Like::create([
            'user_id' => Auth::user()->id,
            'post_id'=>$id
        ]);

        $data=['success'=>'1'];
        return Response::json($data, 200);
    }

    public function postUnLike($id){
        
        $like = Like::where('post_id',$id)->where('user_id', Auth::user()->id)->first();
        $like->delete();
        $data=['success'=>'1'];
        return Response::json($data, 200);
    }

    public function postLikeCount($id){
        $like=like::where('post_id',$id)->get();
        $count = count($like);
        $data=['count'=>$count];
        return Response::json($data, 200);
    }

    public function postLikeCheck($id){
        $like = Like::where('post_id',$id)->where('user_id', Auth::user()->id)->get();
        if(count($like)>0){
            $data=['liked'=>'1'];
        }else{
            $data=['liked'=> '0'];
        }
        return Response::json($data, 200);
    }

    public function Comment(Request $req,$id){
        $flag=0;
        $badword = array("idiot", "stupid", "badword", "bangsat", "keparat", "sialan");

        foreach ($badword  as $w) {
            if(strpos($req->comment, $w)){
                $flag=1;
            }
          }

        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id'=>$id,
            'comment'=> $req->comment,
            'flag'=>$flag
        ]);
    return redirect()->route('postView',['id'=>$id]);

    }

    public function CommentDelete($id,$postId){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('postView',['id'=>$postId]);
    }

    public function PasswordUpdate(){
        return view("setting");
    }

    public function PasswordUpdateCheck(Request $req){
        $id = Auth::user()->id;
        $user=User::find($id);

        
        if(!Hash::check($req->password, $user->password)){
            return redirect()->back()->with('message', 'Old password didn\'t match');  
        }

        if(Hash::check($req->n_password, $user->password)){
            return redirect()->back()->with('message', 'New password cannot be same as old password');  
        }

        if($req->n_password!=$req->c_password){
            return redirect()->back()->with('message', 'Confirm password didm\'t match');
        }

        $user->password=Hash::make($req['n_password']);
        $user->save();
        return redirect()->back()->with('message', 'Password Updated');
    }

    public function AddFavourite($id){
        $FavouritePost = FavouritePost::create([
            'post_id' =>  $id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('postView',['id'=>$id]);
    }
    public function RemoveFavourite($id){
        $FavouritePost = FavouritePost::where("post_id",$id)->where("user_id", Auth::user()->id)->first();
        $FavouritePost->delete();
        return redirect()->route('postView',['id'=>$id]);
    }

    public function FavouritePosts(){
        $p=null;
        $posts=array();
        $fav= FavouritePost::where("user_id", Auth::user()->id)->get();
        foreach($fav as $fav){
            $post=Post::find($fav->post_id);
            $posts[]=$post;
        }
        $category=category::all();
        

        return view("post",compact('posts','category','p'));
    }


    public function CategoryPosts($id){
        $p=$id;
        $posts=Post::where('category',$id)->paginate(10);
        $category=category::all();
        $name=category::find($id)->name;
        if($name==null){
            $name="Undefined";
        }
        return view("post",compact('posts','category','p','name'));
    }

    public function allUser(){
        $search=null;
        $profileImg;
        $users = User::leftJoin('profile_imgs', 'users.id', '=', 'profile_imgs.user_id')->where('role','!=',0)->where('role','!=',2)
        ->select('users.id','users.name','users.role','profile_imgs.path')->paginate(10);
        return view("allusers",compact('users','search'));
    }

    public function UserSearch(Request $req){
        $profileImg;
        $search=$req->name;
        $users = User::leftJoin('profile_imgs', 'users.id', '=', 'profile_imgs.user_id')
        ->where('role','!=',0)->where("name",'LIKE', '%'.$search.'%')
        ->select('users.id','users.name','users.role','profile_imgs.path')->paginate(10);
        return view("allusers",compact('users','search'));
    }

    public function allUserStudent(){
        $search=null;
        $profileImg;
        $users = User::leftJoin('profile_imgs', 'users.id', '=', 'profile_imgs.user_id')->where('role',1)
        ->select('users.id','users.name','users.role','profile_imgs.path')->paginate(10);
        return view("allusers",compact('users','search'));
    }

    public function allUserTeacher(){
        $search=null;
        $profileImg;
        $users = User::leftJoin('profile_imgs', 'users.id', '=', 'profile_imgs.user_id')->where('role',2)
        ->select('users.id','users.name','users.role','profile_imgs.path')->paginate(10);
        return view("allusers",compact('users','search'));
    }


    public function userProfileView($id){
        $user=User::find($id);
        $pp_img=profileImg::where("user_id",$id)->first();
        if($pp_img==null){
            $pp_img="/img/avatar_default.png";
        }else{
            $pp_img="/img/profile-img/".$pp_img->path;
        }
        $posts=Post::where("user_id",$id)->paginate(10);
        $category=Category::all();
        return view('userProfileView',compact('user','pp_img','work','all_work','posts','category'));
    }

   
}