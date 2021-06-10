<?php

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

use App\Mail\NewUserWelcomeMail;


Route::get('/', [App\Http\Controllers\PostsController::class, 'index'])->middleware('auth');

Auth::routes();

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});


Route::post('follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);

Route::post('favorite/{post}', [App\Http\Controllers\PostsController::class, 'favoritePost'])->middleware('auth');

Route::get('p/favorites', [App\Http\Controllers\PostsController::class, 'myFavorites'])->middleware('auth');
Route::get('/comments', [App\Http\Controllers\PostsController::class, 'comments'])->middleware('auth');

Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create'])->middleware('auth');
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store'])->middleware('auth');
Route::get('/p/{post}/edit', [App\Http\Controllers\PostsController::class, 'edit'])->middleware('auth');
Route::patch('/p/{post}', [App\Http\Controllers\PostsController::class, 'update'])->middleware('auth');
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);
Route::delete('/p/{post}', [App\Http\Controllers\PostsController::class, 'delete']);


Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');