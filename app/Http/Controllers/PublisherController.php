<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $publisher = Publisher::find($id);
        $books = $publisher->books;

        return view('publisher', compact('publisher', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->is_admin)
        {
            return view('publisher-create');
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'province' => 'required|max:255',
            'city' => 'required|max:255',
            'street' => 'required|max:255',
            'zipcode' => 'required|max:255',
        ]);

        $publisher = new Publisher;

        $publisher->name = $request->name;
        $publisher->email = $request->email;
        $publisher->phone = $request->phone;
        $publisher->province = $request->province;
        $publisher->city = $request->city;
        $publisher->street = $request->street;
        $publisher->zipcode = $request->zipcode;

        $publisher->save();

        return redirect()->route('dashboard')->with('success', 'انتشارات با موفقیت ایجاد شد');
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
            $publishers = Publisher::all();
            return view('publisher-edit-list', compact('publishers'));
        }

        return redirect()->back();
    }

    public function showAllForDelete()
    {
        if(Auth::user()->is_admin)
        {
            $publishers = Publisher::all();
            return view('publisher-delete-list', compact('publishers'));
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
            $publisher = Publisher::find($id);
            return view('publisher-edit', compact('publisher'));
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'province' => 'required|max:255',
            'city' => 'required|max:255',
            'street' => 'required|max:255',
            'zipcode' => 'required|max:255',
        ]);

        $publisher = Publisher::find($id);

        $publisher->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'province' => $request->province,
            'city' => $request->city,
            'street' => $request->street,
            'zipcode' => $request->zipcode,
        ]);

        return redirect()->route('dashboard')->with('success', 'انتشارات با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publisher = Publisher::find($id);
        $publisher->delete();
        return redirect()->route('dashboard')->with('success', 'انتشارات با موفقیت حذف شد');
    }

    public function showAllPublishers()
    {
        $publishers = Publisher::all();

        return view('publishers', compact('publishers'));
    }
}
