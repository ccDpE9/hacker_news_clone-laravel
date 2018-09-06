<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{

    /*
    public function __construct() {
        $this->middleware('auth');
    }
     */

    public function index()
    {
        $links = Link::with('user')
            ->get();
        return view('links.index')
            ->with('links', $links);
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required|max:255',
            'url' => 'bail|required',
        ]);

        $link = new Link;
        $link->title = $request->title;
        $link->url = $request->url;
        $link->description = $request->description;
        $link->user_id = Auth::user()->id;
        $link->save();

        return redirect()
            ->route('links.show', $link->id);
    }

    // public function show(Link $link)
    public function show($id)
    {
        $link = Link::where('id', $id)
            ->firstOrFail();
        return view('links.show')
            ->with('link', $link);
    }

    public function edit(Link $link)
    {
        //
    }

    public function update(Request $request, Link $link)
    {
        //
    }

    public function destroy(Link $link)
    {
        //
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3',
        ]);
        // is just a string equal to input value
        $query = $request->input('query');
        $links = Link::where('title', $query)->get();
        return view('links.index')->with('links', $links);
    }

}