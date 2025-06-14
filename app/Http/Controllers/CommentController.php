<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['post', 'user'])->latest()->get();
        return view('Comment.index', compact('comments'));
    }

    public function create()
    {
        return view('Comment.create');
    }

    public function store(StoreCommentRequest $request)
    {
        $data = $request->all();
        Comment::create($data);
        return redirect()->route('comments.index')->with('success', 'Comment created successfully.');
    }

    public function show($id)
    {
        $item = Comment::findOrFail($id);
        return view('Comment.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Comment::findOrFail($id);
        return view('Comment.edit', compact('item'));
    }

    public function update(UpdateCommentRequest $request, $id)
    {
        $item = Comment::findOrFail($id);
        $item->update($request->validated());

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully.');
    }

    public function destroy($id)
    {
        $item = Comment::findOrFail($id);
        $item->delete();
        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully.');
    }
}