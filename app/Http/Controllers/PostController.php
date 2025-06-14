<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user'])->withCount(['comments'])->latest()->get();
        return view('Post.index', compact('posts'));
    }

    public function create()
    {
        return view('Post.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->all();
        Post::create($data);
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show($id)
    {
        $item = Post::findOrFail($id);
        return view('Post.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Post::findOrFail($id);
        return view('Post.edit', compact('item'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $item = Post::findOrFail($id);
        $item->update($request->validated());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $item = Post::findOrFail($id);
        $item->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}