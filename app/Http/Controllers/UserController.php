<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['posts', 'comments'])->latest()->get();
        return view('User.index', compact('users'));
    }

    public function create()
    {
        
        return view('User.create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        User::create($data);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $item = User::findOrFail($id);
        return view('User.show', compact('item'));
    }

    public function edit($id)
    {
        $item = User::findOrFail($id);
        
        return view('User.edit', compact('item'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $item = User::findOrFail($id);
        $item->update($request->validated());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}