<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $user = Auth::user();
        $book = Book::find($request->input('book_id'));
        $quote = $request->input('description');

        $user->books_quote()->attach($book, ['quote' => $quote]);

        return redirect()->back()->with('success', "بریده با موفقیت ثبت شد");
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
        $user = Auth::user();
        $quote = DB::table('book_user_quote')
            ->where('book_user_quote.id', $id)
            ->where('book_user_quote.user_id', $user->id)
            ->first();
        
        if($quote)
        {
            $quote = DB::table('book_user_quote')
            ->where('book_user_quote.id', $id)
            ->where('book_user_quote.user_id', $user->id)
            ->delete();

            return redirect()->back()->with('success', 'بریده با موفقیت حذف شد');
        }

        return redirect()->back()->with('success', 'خطا در حذف بریده');
    }
}
