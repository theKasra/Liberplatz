<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if(auth()->check())
    {
        return redirect('/home');
    }
    else
    {
        return view('welcome');
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::post('/create-status', [StatusController::class, 'create'])->middleware('auth')->name('status.create');
Route::delete('/status/{id}', [StatusController::class, 'destroy'])->middleware('auth')->name('status.destroy');

Route::get('/book/{id}', [BookController::class, 'index'])->middleware('auth')->name('book');
Route::post('/book/{id}', [UserController::class, 'rate'])->middleware('auth')->name('book.rate');

Route::get('/user/{id}', [UserController::class, 'index'])->middleware('auth')->name('user');
Route::post('/user/{id}/follow', [UserController::class, 'follow'])->middleware('auth')->name('user.follow');
Route::post('/user/{id}/unfollow', [UserController::class, 'unfollow'])->middleware('auth')->name('user.unfollow');
Route::get('/user/{id}/followings', [UserController::class, 'showFollowings'])->middleware('auth')->name('user.followings');
Route::get('/user/{id}/followers', [UserController::class, 'showFollowers'])->middleware('auth')->name('user.followers');
Route::get('/user/{id}/favorites', [UserController::class, 'showFavorites'])->middleware('auth')->name('user.favorites');
Route::get('/user/{id}/comments', [UserController::class, 'showComments'])->middleware('auth')->name('user.comments');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
