<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        // $books = Book::all();

        // get all statuses
        // $statuses = DB::table('book_user_status')
        //     ->join('users', 'users.id', '=', 'book_user_status.user_id')
        //     ->join('books', 'books.id', '=', 'book_user_status.book_id')
        //     ->select('book_user_status.*', 'users.name', 'users.first_name', 'users.last_name', 'books.title')
        //     ->orderBy('book_user_status.created_at')
        //     ->get();

        //$books = Book::with('users_status')->latest('id')->get();

        // $user = Auth::user();
        // $books = Book::all();

        // $user->load('books_status', 'followings.books_status');

        // $user_statuses = $user->books_status;
        // $following_statuses = $user->followings->flatMap->books_status;
        // $statuses = $user_statuses->merge($following_statuses)->sortByDesc('pivot.created_at');

        $books = Book::all();

        $user = Auth::user();
        $user_statuses = DB::table('book_user_status')
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
        
        $followings_id = DB::table('user_user')
            ->where('user_user.follower_id', $user->id)
            ->pluck('user_user.following_id');
        
        
        $followings_statuses = DB::table('book_user_status')
            ->join('users', 'book_user_status.user_id', '=', 'users.id')
            ->join('books', 'book_user_status.book_id', '=', 'books.id')
            ->select('book_user_status.*',
                     'users.name AS user_name',
                     'users.first_name AS first_name',
                     'users.last_name AS last_name',
                     'books.title AS book_title')
            ->whereIn('users.id', $followings_id)
            ->orderByDesc('book_user_status.created_at')
            ->get();
        
        $statuses = $user_statuses->merge($followings_statuses)->sortByDesc('created_at');

        //dd($statuses);

        return view('home', compact('books', 'statuses'));
    }
}
