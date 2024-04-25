<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/posts', function () {
    return view('welcome');
});

// Route::get('/posts',[PostController::class,'index']);
// Route::get('/posts/create',[PostController::class,'create']);
// Route::post('/posts',[PostController::class,'store']);
// route::get('/posts/{id}',[PostController::class,'show']);
// route::get('/posts/{id}/edit',[PostController::class,'edit']);
// route::put('/posts/{id}',[PostController::class,'update']);
// route::delete('/posts/{id}',[PostController::class,'destroy']);

Route::resource("posts", PostController::class)->middleware("auth"); //->only(['index','show'])









 


// Route::get('posts/{id}/edit', function($id) {
   
//     return view('edit');
// });


// Route::put('posts/{id}',function ($id){
//     return view('update');
// });

// Route::delete('posts/{id}',function ($id){
//     return "deleted";
// });
Auth::routes();

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
