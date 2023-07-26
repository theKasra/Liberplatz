<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        // not sorted
        // $book = Book::with(['authors', 'publishers', 'users_rating'])->orderByDesc('id')->findOrFail($id);

        $book = Book::find($id);

        $author = DB::table('author_book')
            ->join('authors', 'author_book.author_id', '=', 'authors.id')
            ->select('author_book.*', 'authors.first_name AS first_name',
                     'authors.last_name AS last_name')
            ->where('author_book.book_id', $id)
            ->get();

        $publisher = DB::table('publishers')->find($book->publisher_id);

        $ratings = DB::table('users')
            ->select('users.*', 'book_user_rating.*')
            ->join('book_user_rating', 'users.id', '=','book_user_rating.user_id')
            ->where('book_user_rating.book_id', $id)
            ->orderByDesc('book_user_rating.created_at')
            ->get();

        return view('book', compact('book', 'author', 'publisher', 'ratings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showAllBooks()
    {
        $books = Book::all();

        return view('books', compact('books'));
    }
}
