<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();
        $book = Book::find($request->input('book_id'));
        $status = $request->input('status_checkbox_value');
        $description = $request->input('description');

        $user->books_status()->attach($book, ['description' => $description, 'status' => $status]);

        return redirect()->back()->with('success', "نوشته با موفقیت ثبت شد");
    }
}
