<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'Wellcome@welcome')->name('welcome');

Auth::routes();


Route::group(['middleware' => 'checkApproval'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    // Only Admin
    Route::group(['middleware' => 'checkAdmin'], function () {
        Route::get('admin/users', 'AdminController@users')->name('admin-users');

        Route::get('admin/users/alumni', 'AdminController@usersAlumni')->name('admin-users-alumni');
        Route::get('admin/users/teacher', 'AdminController@usersTeacher')->name('admin-users-teacher');
        Route::get('admin/users/student', 'AdminController@usersStudent')->name('admin-users-student');

        Route::get('admin/users/approve/{id}', 'AdminController@approve')->name('admin-users-approve');
        Route::get('admin/users/delete/{id}', 'AdminController@delete')->name('admin-users-delete');
        Route::get('admin/users/edit/{id}', 'AdminController@edit')->name('admin-users-edit');

        Route::post('admin/users/edited/{id}', 'AdminController@edited')->name('admin-users-edited');

        Route::get('admin/category', 'AdminController@category')->name('admin-category');
        Route::post('admin/category/new', 'AdminController@categoryNew')->name('admin-category-new');
        Route::get('admin/category/edit/{id}', 'AdminController@categoryEdit')->name('admin-category-edit');
        Route::post('admin/category/edited/{id}', 'AdminController@categoryEdited')->name('admin-category-edited');

        Route::get('admin/category/delete/{id}', 'AdminController@categoryDelete')->name('admin-category-delete');
        Route::get('admin/category/deleteWithPost/{id}', 'AdminController@categoryDeletePost')->name('admin-category-delete-post');

        Route::get('admin/post/', 'AdminController@Post')->name('admin-post');
        Route::get('admin/post/delete/{id}', 'AdminController@PostDelete')->name('admin-post-delete');
        Route::get('admin/post/approve/{id}', 'AdminController@PostApprove')->name('admin-post-approve');
        Route::get('admin/post/remove/flag/{id}', 'AdminController@PostRemoveFlag')->name('admin-post-removeFlag');

        Route::get('admin/comment/', 'AdminController@Comment')->name('admin-comment');
        Route::get('admin/comment/remove/flag/{id}', 'AdminController@CommentRemoveFlag')->name('admin-comment-flag-remove');
        Route::get('admin/comment/delete/{id}', 'AdminController@CommentDelete')->name('admin-comment-delete');

    });

    // Only Teacher Consultant
    Route::group(['middleware' => 'checkTeacher'], function () {
        Route::get('/all/users', 'userController@allUser')->name('allUser');
        Route::get('/all/users/students', 'userController@allUserStudent')->name('allUserStudent');
    });

    //Image Change
    Route::post('/home/imageChange', 'userController@imgChange')->name('imgChange');
    Route::post('/users/edited/', 'userController@edited')->name('users-edited');

    Route::post('/users/alumni/work-update', 'userController@alumniWorkCreate')->name('alumniWorkCreate');

    Route::group(['middleware' => 'AlumniWork'], function () {
        Route::get('/users/alumni/work-update/{workId}', 'userController@workUpdate')->name('alumni-work-update');
        Route::post('/users/alumni/work-updated/{workId}', 'userController@workUpdated')->name('alumni-work-updated');
        Route::get('/users/alumni/work-delete/{workId}', 'userController@workDelete')->name('alumni-work-delete');
    });

    Route::get('/users/post', 'userController@myPost')->name('mypost')->middleware('userCheck');
    Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');
    Route::post('/users/post/create', 'userController@newPost')->name('newPost');
    Route::get('/postDelete/{id}', 'userController@postDelete')->name('postDelete');

    Route::get('/post/like/{id}', 'userController@postLike')->name('postLike');
    Route::get('/post/unlike/{id}', 'userController@postUnLike')->name('postUnLike');
    Route::get('/post/like/check/{id}', 'userController@postLikeCheck')->name('postLikeCheck');
    Route::get('/post/like/count/{id}', 'userController@postLikeCount')->name('postLikeCount');

    Route::post('/post/comment/{id}', 'userController@Comment')->name('Comment');
    Route::get('/post/comment/delet/{id}/{postId}', 'userController@CommentDelete')->name('CommentDelete');

    //Password Update
    Route::get('/user/password/', 'userController@PasswordUpdate')->name('PasswordUpdate');
    Route::post('/user/password/update', 'userController@PasswordUpdateCheck')->name('PasswordUpdateCheck');
});

Route::get('/postView/{id}', 'userController@postView')->name('postView');
Route::get('/post/myfavaourite', 'userController@FavouritePosts')->name('myFavPost');
Route::get('/post/Category/{id}', 'userController@CategoryPosts')->name('CategoryPosts');

Route::get('/all/users/teacher', 'userController@allUserTeacher')->name('allUserTeacher');
Route::get('/all/users/alumni', 'userController@allUserAlumni')->name('allUserAlumni');

Route::get('/users/profile/{id}', 'userController@userProfileView')->name('userProfileView');

Route::get('/all/users/search', 'userController@UserSearch')->name('UserSearch');

Route::get('/postView/fav/{id}', 'userController@AddFavourite')->name('AddFavourite');
Route::get('/postView/fav/rmv/{id}', 'userController@RemoveFavourite')->name('RemoveFavourite');

Route::get('/waitting-for-approval', 'HomeController@waitingForApproval')->name('waitting-for-approval');

Route::get('login/#signup', 'Auth\RegisterController@showRegistrationForm')->name('daftar');

Route::get('sendemail', 'AdminController@sendEmail')->name('sendemail');