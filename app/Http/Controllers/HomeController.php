<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Book;
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

        $books = Book::with(['users_status' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();

        return view('home', compact('books'));
    }
}
