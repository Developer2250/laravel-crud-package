<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author'])->get();
        return view('Book.index', compact('books'));
    }

    public function create()
    {
        return view('Book.create');
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->all();
        Book::create($data);
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show($id)
    {
        $item = Book::findOrFail($id);
        return view('Book.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Book::findOrFail($id);
        return view('Book.edit', compact('item'));
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $item = Book::findOrFail($id);
        $item->update($request->validated());

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        $item = Book::findOrFail($id);
        $item->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}