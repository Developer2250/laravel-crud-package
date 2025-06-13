<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::get();
        return view('Author.index', compact('authors'));
    }

    public function create()
    {
        return view('Author.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        $data = $request->all();
        Author::create($data);
        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    public function show($id)
    {
        $item = Author::findOrFail($id);
        return view('Author.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Author::findOrFail($id);
        return view('Author.edit', compact('item'));
    }

    public function update(UpdateAuthorRequest $request, $id)
    {
        $item = Author::findOrFail($id);
        $item->update($request->validated());

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy($id)
    {
        $item = Author::findOrFail($id);
        $item->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}