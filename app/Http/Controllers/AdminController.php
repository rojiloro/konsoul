<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use Auth;
use App\category;
use App\Post;
use App\Comment;
use App\FavouritePost;
use Mail;
class AdminController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function users(){

        $new_users=user::where('state',0)->paginate(10);
        $app_users=user::where('state',1)->where('role', '!=',0)->paginate(10);
        return view('admin.users', compact('new_users', 'app_users'));
    }

    public function usersAlumni(){

        $sort_users=user::where('state',1)->where('role', 3)->paginate(10);
        $type="Alumni";
        return view('admin.sortUser', compact('sort_users','type'));
    }

    public function usersTeacher(){
        $sort_users=user::where('state',1)->where('role', 2)->paginate(10);
        $type="Teacher";
        return view('admin.sortUser', compact('sort_users','type'));
    }

    public function usersStudent(){
        $sort_users=user::where('state',1)->where('role', 1)->paginate(10);
        $type="Student";
        return view('admin.sortUser', compact('sort_users','type'));
    }

    public function approve($id){
        $user=user::find($id);
        $user->state=1;
        $user->save();
        Toastr::success('User Approved Successfully', 'Approved', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-users');
    }

    public function delete($id){
        $user=user::find($id);
        $user->delete();
        Toastr::success('User Deleted Successfully', 'Deleted', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-users');
    }

    public function edit($id){
        $user=user::find($id);
        return view('admin.edit', compact('user'));
    }

    public function edited(Request $req,$id){
        $user=user::find($id);
        $user->name=$req->name;
        $user->role=$req->role;
        $user->home_town=$req->home_town;
        $user->current_city=$req->current_city;
        $user->phone=$req->phone;
        $user->save();
        Toastr::success('User Edited Successfully', 'Edited', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-users-edit',['id'=>$user->id]);
    }

    public function category(){
        $category=category::all();
        return view('admin.category' ,compact('category'));
    }

    public function categoryNew(Request $req){
        $category=category::create([
            'name' =>  $req->name,
        ]);

        Toastr::success('Category Created Successfully', 'Created', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-category');
    }

    public function categoryEdit($id){
        $category=category::find($id);
        return view('admin.categoryEdit' ,compact('category'));
    }

    public function categoryEdited(Request $req, $id){
        $category=category::find($id);
        $category->name=$req->name;
        $category->save();
        Toastr::success('Category Edited Successfully', 'Edited', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-category');
    }

    public function categoryDelete($id){
        $category=category::find($id);
        $category->delete();
        Toastr::success('Category Deleted Successfully', 'Deleted', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-category');
    }

    public function categoryDeletePost($id){
        $category=category::find($id);
        $category->delete();
        Post::where('category',$id)->delete();
        Toastr::success('Category Deleted with Posts Successfully', 'Deleted', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-category');
    }
    
    public function post(){
        $posts=post::paginate(10, ['*'], 'posts');
        $flag_posts=post::where('flag',1)->paginate(10 , ['*'], 'flag_post');
        $new_posts=post::where('state',0)->paginate(10, ['*'], 'new_post');
        $category=category::all();
        return view('admin.post' ,compact('category','posts','flag_posts','new_posts'));
    }

    public function PostDelete($id){
        $post=post::find($id);
        $Comment=Comment::where("post_id",$id)->get();
        foreach($Comment as $cmnt){
            $cmnt->delete();
        }
        $FavouritePost=FavouritePost::where("post_id",$id)->get();
        foreach($FavouritePost as $fav){
            $fav->delete();
        }
        $post->delete();
        Toastr::success('Post Deleted Successfully', 'Deleted', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-post');
    }

    public function PostApprove($id){
        $post=post::find($id);
        $post->state=1;
        $post->save();
        Toastr::success('Post Approved Successfully', 'Approved', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-post');
    }

    public function PostRemoveFlag($id){
        $post=post::find($id);
        $post->flag=0;
        $post->save();
        Toastr::success('Post Approved Successfully', 'Approved', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-post');
    }

    public function Comment(){
        $comments=Comment::where("flag",1)->paginate(10);
        return view('admin.comment' ,compact('comments'));
    }

    public function CommentRemoveFlag($id){
        $comments=Comment::find($id);
        $comments->flag=0;
        $comments->save();
        Toastr::success('Flag removed successfully', 'Flag Removed', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-comment');
    }

    public function CommentDelete($id){
        $comments=Comment::find($id);
        $comments->delete();
        Toastr::success('Comment removed successfully', 'Comment Removed', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin-comment');
    }

    public function sendEmail(){

        
  


        for($i=1709001; $i<=1709030; $i++){

            sleep(1);

            echo $i.'</br>';
            
        }
        
    }
    
}