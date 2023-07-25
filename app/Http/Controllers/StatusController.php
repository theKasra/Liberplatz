<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function destroy(Request $request, string $id)
    {
        $user = Auth::user();

        // $user->load('books_status');

        // $status = $user->books_status()->find($id);

        // dd($status);
        
        // if(!$status)
        // {
        //     return;
        // }

        // $user->books_status()->detach($status);

        $status = DB::table('book_user_status')
            ->where('book_user_status.id', $id)
            ->where('book_user_status.user_id', $user->id)
            ->first();
        
        if($status)
        {
            DB::table('book_user_status')
                ->where('book_user_status.id', $id)
                ->where('book_user_status.user_id', $user->id)
                ->delete();
            
            return redirect()->back()->with('success', 'نوشته با موفقیت حذف شد');
        }

        return redirect()->back()->with('success', "خطا در حذف نوشته");
    }
}
