<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Publisher;
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
        if(Auth::user()->is_admin)
        {
            $publishers = Publisher::all();
            $authors = Author::all();

            return view('book-create', compact('publishers', 'authors'));
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'isbn' => 'required|max:255',
            'description' => 'required',
            'pages' => 'required|integer',
            'publisher' => 'required',
            'year_of_publication' => 'required|date',
            'author' => 'required'
        ]);

        $book = new Book;
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->description = $request->description;
        $book->pages = $request->pages;
        $book->publisher_id = $request->publisher;
        $book->year_of_publication = $request->year_of_publication;

        $book->save();

        DB::table('author_book')->insert([
            'author_id' => $request->author,
            'book_id' => $book->id,
        ]);

        return redirect()->route('dashboard')->with('success', 'کتاب با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    public function showAllForEdit()
    {
        $books = Book::all();

        return view('book-edit-list', compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        $author = DB::table('author_book')
            ->join('authors', 'author_book.author_id', '=', 'authors.id')
            ->select('author_book.*', 'authors.first_name AS first_name',
                     'authors.last_name AS last_name')
            ->where('author_book.book_id', $id)
            ->get();

        $publisher = DB::table('publishers')->find($book->publisher_id);
        
        $authors = Author::all();
        $publishers = Publisher::all();

        return view('book-edit', compact('book', 'author', 'publisher', 'authors', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|max:255',
            'isbn' => 'required|max:255',
            'description' => 'required',
            'pages' => 'required|integer',
            'publisher' => 'required',
            'year_of_publication' => 'required|date',
            'author' => 'required'
        ]);

        $book = Book::find($id);
        $author = DB::table('author_book')
            ->join('authors', 'author_book.author_id', '=', 'authors.id')
            ->select('authors.id')
            ->where('author_book.book_id', $id)
            ->get();

        $updatedPivotData = [
            'author_id' => $request->author,
            'book_id' => $book->id,
        ];

        DB::table('author_book')
            ->where('author_book.book_id', $book->id)
            ->where('author_book.author_id', $author[0]->id)
            ->update($updatedPivotData);

        $book->update([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'description' => $request->description,
            'pages' => $request->pages,
            'publisher' => $request->publisher,
            'year_of_publication' => $request->year_of_publication,
        ]);
        
        return redirect()->route('dashboard')->with('success', 'کتاب با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        DB::table('author_book')
            ->where('author_book.book_id', $book->id)
            ->delete();
        
        $book->delete();

        return redirect()->route('dashboard')->with('success', 'کتاب با موفقیت حذف شد');
    }

    public function showAllForDelete()
    {
        $books = Book::all();

        return view('book-delete-list', compact('books'));
    }

    public function showAllBooks()
    {
        $books = Book::all();

        return view('books', compact('books'));
    }
}
