@extends('layouts.app')

@section('title', 'View Post')

@section('content')
    <h1>View Post</h1>
    <p><strong>User_id:</strong> {{ $item->user_id }}</p>
    <p><strong>Title:</strong> {{ $item->title }}</p>
    <p><strong>Content:</strong> {{ $item->content }}</p>
    <p><strong>Comments_count:</strong> {{ $item->comments_count }}</p>
    
    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back to List</a>
@endsection