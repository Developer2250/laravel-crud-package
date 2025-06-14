@extends('layouts.app')

@section('title', 'View User')

@section('content')
    <h1>View User</h1>
    <p><strong>Name:</strong> {{ $item->name }}</p>
    <p><strong>Email:</strong> {{ $item->email }}</p>
    <p><strong>Password:</strong> {{ $item->password }}</p>
    <p><strong>Gender:</strong> {{ $item->gender }}</p>
    
    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back to List</a>
@endsection