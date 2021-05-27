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

Auth::routes();

Route::get('email', function () {
return new \App\Mail\NewUserEmail();
});

Route::post('follow/{user}',  [App\Http\Controllers\FollowsController::class, 'store']);

// Route::get('/', [App\Http\Controllers\Auth\LoginController::class, '__construct']);
Route::get('/home', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::get('/p/{posts}', [App\Http\Controllers\PostsController::class, 'show']);
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::get('/profile/{user}/profile', [App\Http\Controllers\ProfilesController::class, 'showProfile']);
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');