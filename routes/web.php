<?php

use App\Http\Controllers\PostController;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TageController;
use App\Http\Controllers\VideoController;

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

Route::get('/', function () {
//     $post = Post::find(1);	
 
// $tag1 = Tag::find(3);
// $tag2 = Tag::find(4);
 
// $post->tags()->attach([$tag1->id, $tag2->id]);

    return view('welcome');
});


Route::get('/index',[App\Http\Controllers\UserController::class,'view'])
->name('user-index');

Route::get('tage', [TageController::class,'index']);
Route::get('post', [PostController::class,'index']);
Route::get('post/store', [PostController::class,'store']);
Route::get('post/update', [PostController::class,'update']);
Route::get('post/delete', [PostController::class,'destroy']);
Route::get('video', [VideoController::class,'index']);

Route::get('user', 'App\Http\Controllers\UserApiController@index');
Route::get('user/create', 'App\Http\Controllers\UserApiController@create');
Route::post('store', 'App\Http\Controllers\UserApiController@store');
Route::delete('user/{id}', 'App\Http\Controllers\UserApiController@destroy');

Route::get('image', function(){
    return view('image');
});