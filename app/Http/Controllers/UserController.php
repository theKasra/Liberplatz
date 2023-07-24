<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(string $id)
    {
        $user = User::with('books_status')->latest('id')->find($id);
        $follower_count = $user->followers->count();
        $following_count = $user->followings->count();
        
        $books = Book::all();

        return view('user', compact('user', 'follower_count', 'following_count', 'books'));
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
}
