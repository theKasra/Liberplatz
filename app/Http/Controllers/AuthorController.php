<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $author = Author::find($id);
        $books = $author->books;

        return view('author', compact('author', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->is_admin)
        {
            return view('author-create');
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'biography' => 'required',
        ]);

        $author = new Author;
        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->biography = $request->biography;

        $author->save();

        return redirect()->route('dashboard')->with('success', 'نویسنده با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showAllForEdit()
    {
        if(Auth::user()->is_admin)
        {
            $authors = Author::all();
            return view('author-edit-list', compact('authors'));
        }

        return redirect()->back();
    }

    public function showAllForDelete()
    {
        if(Auth::user()->is_admin)
        {
            $authors = Author::all();
            return view('author-delete-list', compact('authors'));
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Auth::user()->is_admin)
        {
            $author = Author::find($id);
            return view('author-edit', compact('author'));
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'biography' => 'required',
        ]);

        $author = Author::find($id);

        $author->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'biography' => $request->biography,
        ]);

        return redirect()->route('dashboard')->with('success', 'نویسنده با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);
        $author->delete();
        return redirect()->route('dashboard')->with('success', 'نویسنده با موفقیت حذف شد');
    }
}
