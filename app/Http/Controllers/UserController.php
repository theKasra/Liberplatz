<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(string $id)
    {
        // $user = User::with('books_status')->latest('id')->find($id);
        
        $user = User::find($id);
        $follower_count = $user->followers->count();
        $following_count = $user->followings->count();

        $statuses = DB::table('book_user_status')
            ->join('users', 'book_user_status.user_id', '=', 'users.id')
            ->join('books', 'book_user_status.book_id', '=', 'books.id')
            ->select('book_user_status.*',
                     'users.name AS user_name',
                     'users.first_name AS first_name',
                     'users.last_name AS last_name',
                     'books.title AS book_title')
            ->where('users.id', $user->id)
            ->orderByDesc('book_user_status.created_at')
            ->get();
        
        $books = Book::all();

        return view('user', compact('user', 'statuses', 'follower_count', 'following_count', 'books'));
    }

    public function follow(string $id)
    {
        $user = Auth::user();

        if(!$user->relationLoaded('followings'))
        {
            $user->load('followings');
        }

        $following_user = User::find($id);

        $user->followings()->attach($following_user);
        return redirect()->back()->with('success', "کاربر با موفقیت دنبال شد");
    }

    public function unfollow(string $id)
    {
        $user = Auth::user();

        if(!$user->relationLoaded('followings'))
        {
            $user->load('followings');
        }

        $followed_user = User::find($id);

        $user->followings()->detach($followed_user);
        return redirect()->back()->with('success', "دنبال کردن این کاربر با موفقیت متوقف شد");
    }

    public function followPublisher(string $id)
    {
        $user = Auth::user();

        if(!$user->relationLoaded('publishers'))
        {
            $user->load('publishers');
        }

        $following_publisher = Publisher::find($id);

        $user->publishers()->attach($following_publisher);
        return redirect()->back()->with('success', "دنبال کردن ناشر با موفقیت انجام شد");
    }

    public function unfollowPublisher(string $id)
    {
        $user = Auth::user();

        if(!$user->relationLoaded('publishers'))
        {
            $user->load('publishers');
        }

        $followed_publisher = Publisher::find($id);

        $user->publishers()->detach($followed_publisher);
        return redirect()->back()->with('success', "دنبال کردن ناشر با موفقیت متوقف شد");
    }

    public function showFollowings(string $id)
    {
        $user = User::find($id);
        $follower_count = $user->followers->count();
        $following_count = $user->followings->count();
        $followings = $user->followings;

        return view('followings', compact('user', 'followings', 'follower_count', 'following_count'));
    }

    public function showFollowers(string $id)
    {
        $user = User::find($id);
        $follower_count = $user->followers->count();
        $following_count = $user->followings->count();
        $followers = $user->followers;

        return view('followers', compact('user', 'followers', 'follower_count', 'following_count'));
    }

    public function showFavorites(string $id)
    {
        $user = User::find($id);
        $follower_count = $user->followers->count();
        $following_count = $user->followings->count();

        $favorite_books = DB::table('books')
            ->join('book_user_rating', 'books.id', '=', 'book_user_rating.book_id')
            ->select('books.*', 'book_user_rating.is_favorite')
            ->where('book_user_rating.user_id', $id)
            ->where('book_user_rating.is_favorite', true)
            ->get();
        
        return view('favorites', compact('favorite_books', 'user', 'follower_count', 'following_count'));
    }

    public function showComments(string $id)
    {
        $user = User::find($id);
        $follower_count = $user->followers->count();
        $following_count = $user->followings->count();

        $comments = DB::table('books')
            ->join('book_user_rating', 'books.id', '=', 'book_user_rating.book_id')
            ->select('book_user_rating.*', 'books.title AS book_title')
            ->where('book_user_rating.user_id', $user->id)
            ->orderByDesc('book_user_rating.created_at')
            ->get();

        return view('comments', compact('follower_count', 'following_count', 'user', 'comments'));
    }

    public function showQuotes(string $id)
    {
        $user = User::find($id);
        $books = Book::all();
        $follower_count = $user->followers->count();
        $following_count = $user->followings->count();

        $quotes = DB::table('books')
            ->join('book_user_quote', 'books.id', '=', 'book_user_quote.book_id')
            ->select('book_user_quote.*', 'books.title AS book_title')
            ->where('book_user_quote.user_id', $user->id)
            ->orderByDesc('book_user_quote.created_at')
            ->get();
        
        return view('quotes', compact('user', 'follower_count', 'following_count', 'quotes', 'books'));
    }

    public function showFollowingPublishers(string $id)
    {
        $user = User::find($id);
        $follower_count = $user->followers->count();
        $following_count = $user->followings->count();

        $following_publishers = DB::table('publishers')
            ->join('publisher_user', 'publishers.id', '=', 'publisher_user.publisher_id')
            ->select('publishers.*')
            ->where('publisher_user.user_id', $user->id)
            ->get();
        
        return view('following-publishers', compact('user', 'follower_count', 'following_count', 'following_publishers'));
    }
}
