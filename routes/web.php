<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RatingController;
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

Route::get('/book/{id}', [BookController::class, 'index'])->middleware('auth')->name('book');
Route::post('/book-store', [BookController::class, 'store'])->middleware('auth')->name('book.store');
Route::delete('/book/{id}', [BookController::class, 'destroy'])->middleware('auth')->name('book.destroy');
Route::patch('/book/{id}', [BookController::class, 'update'])->middleware('auth')->name('book.update');

Route::get('/author/{id}', [AuthorController::class, 'index'])->middleware('auth')->name('author');
Route::post('/author-store', [AuthorController::class, 'store'])->middleware('auth')->name('author.store');
Route::delete('/author/{id}', [AuthorController::class, 'destroy'])->middleware('auth')->name('author.destroy');
Route::put('/author/{id}', [AuthorController::class, 'update'])->middleware('auth')->name('author.update');

Route::get('/publisher/{id}', [PublisherController::class, 'index'])->middleware('auth')->name('publisher');
Route::post('/publisher-store', [PublisherController::class, 'store'])->middleware('auth')->name('publisher.store');
Route::delete('/publisher/{id}', [PublisherController::class, 'destroy'])->middleware('auth')->name('publisher.destroy');
Route::put('/publisher/{id}', [PublisherController::class, 'update'])->middleware('auth')->name('publisher.update');

Route::post('/status-store', [StatusController::class, 'store'])->middleware('auth')->name('status.store');
Route::delete('/status/{id}', [StatusController::class, 'destroy'])->middleware('auth')->name('status.destroy');

Route::get('/user/{id}', [UserController::class, 'index'])->middleware('auth')->name('user');
Route::post('/user/{id}/follow', [UserController::class, 'follow'])->middleware('auth')->name('user.follow');
Route::post('/user/{id}/unfollow', [UserController::class, 'unfollow'])->middleware('auth')->name('user.unfollow');
Route::get('/user/{id}/followings', [UserController::class, 'showFollowings'])->middleware('auth')->name('user.followings');
Route::get('/user/{id}/followers', [UserController::class, 'showFollowers'])->middleware('auth')->name('user.followers');
Route::get('/user/{id}/favorites', [UserController::class, 'showFavorites'])->middleware('auth')->name('user.favorites');
Route::get('/user/{id}/comments', [UserController::class, 'showComments'])->middleware('auth')->name('user.comments');
Route::get('/user/{id}/quotes', [UserController::class, 'showQuotes'])->middleware('auth')->name('user.quotes');

Route::post('/rate-book/{id}', [RatingController::class, 'store'])->middleware('auth')->name('book.rate');
Route::delete('/book/{id}', [RatingController::class, 'destroy'])->middleware('auth')->name('book.destroy.rating');

Route::post('/user/quotes/quote-store', [QuoteController::class, 'store'])->middleware('auth')->name('quote.store');
Route::delete('/quote/{id}', [QuoteController::class, 'destroy'])->middleware('auth')->name('quote.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
