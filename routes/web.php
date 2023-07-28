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
use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Support\Facades\Auth;
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
    if(Auth::user()->is_admin)
    {
        $authors = Author::all();
        $books = Book::all();
        $publishers = Publisher::all();

        return view('dashboard', compact('authors', 'books', 'publishers'));
    }
    else return redirect()->back();
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/book/{id}', [BookController::class, 'index'])->middleware('auth')->name('book');
Route::get('/book-create', [BookController::class, 'create'])->middleware('auth')->name('book.create');
Route::post('/book-store', [BookController::class, 'store'])->middleware('auth')->name('book.store');
Route::get('/book-delete', [BookController::class, 'showAllForDelete'])->middleware('auth')->name('book.delete.list');
Route::delete('/book-delete/{id}', [BookController::class, 'destroy'])->middleware('auth')->name('book.destroy');
Route::get('/book-edit/{id}', [BookController::class, 'edit'])->middleware('auth')->name('book.edit');
Route::get('/book-edit-list', [BookController::class, 'showAllForEdit'])->middleware('auth')->name('book.edit.list');
Route::post('/book-update/{id}', [BookController::class, 'update'])->middleware('auth')->name('book.update');
Route::get('/books', [BookController::class, 'showAllBooks'])->middleware('auth')->name('books');

Route::get('/author/{id}', [AuthorController::class, 'index'])->middleware('auth')->name('author');
Route::get('/author-create', [AuthorController::class, 'create'])->middleware('auth')->name('author.create');
Route::post('/author-store', [AuthorController::class, 'store'])->middleware('auth')->name('author.store');
Route::get('/author-delete', [AuthorController::class, 'showAllForDelete'])->middleware('auth')->name('author.delete.list');
Route::delete('/author-delete/{id}', [AuthorController::class, 'destroy'])->middleware('auth')->name('author.destroy');
Route::get('/author-edit-list', [AuthorController::class, 'showAllForEdit'])->middleware('auth')->name('author.edit.list');
Route::get('/author-edit/{id}', [AuthorController::class, 'edit'])->middleware('auth')->name('author.edit');
Route::post('/author-update/{id}', [AuthorController::class, 'update'])->middleware('auth')->name('author.update');
Route::get('/authors', [AuthorController::class, 'showAllAuthors'])->middleware('auth')->name('author.all');

Route::get('/publisher/{id}', [PublisherController::class, 'index'])->middleware('auth')->name('publisher');
Route::post('/publisher-store', [PublisherController::class, 'store'])->middleware('auth')->name('publisher.store');
Route::delete('/publisher/{id}', [PublisherController::class, 'destroy'])->middleware('auth')->name('publisher.destroy');
Route::put('/publisher/{id}', [PublisherController::class, 'update'])->middleware('auth')->name('publisher.update');
Route::get('/publishers', [PublisherController::class, 'showAllPublishers'])->middleware('auth')->name('publishers');

Route::post('/status-store', [StatusController::class, 'store'])->middleware('auth')->name('status.store');
Route::delete('/status/{id}', [StatusController::class, 'destroy'])->middleware('auth')->name('status.destroy');

Route::get('/user/{id}', [UserController::class, 'index'])->middleware('auth')->name('user');
Route::post('/user/{id}/follow', [UserController::class, 'follow'])->middleware('auth')->name('user.follow');
Route::post('/user/{id}/unfollow', [UserController::class, 'unfollow'])->middleware('auth')->name('user.unfollow');
Route::post('/follow-publisher/{id}', [UserController::class, 'followPublisher'])->middleware('auth')->name('user.follow.publisher');
Route::post('/unfollow-publisher/{id}', [UserController::class, 'unfollowPublisher'])->middleware('auth')->name('user.unfollow.publisher');
Route::get('/user/{id}/followings', [UserController::class, 'showFollowings'])->middleware('auth')->name('user.followings');
Route::get('/user/{id}/followers', [UserController::class, 'showFollowers'])->middleware('auth')->name('user.followers');
Route::get('/user/{id}/favorites', [UserController::class, 'showFavorites'])->middleware('auth')->name('user.favorites');
Route::get('/user/{id}/comments', [UserController::class, 'showComments'])->middleware('auth')->name('user.comments');
Route::get('/user/{id}/quotes', [UserController::class, 'showQuotes'])->middleware('auth')->name('user.quotes');
Route::get('/user/{id}/following-publishers', [UserController::class, 'showFollowingPublishers'])->middleware('auth')->name('user.following.publishers');

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
