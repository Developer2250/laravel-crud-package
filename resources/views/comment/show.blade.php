@extends('layouts.app')

@section('title', 'View Comment')

@section('content')
    <h1>View Comment</h1>
    <p><strong>Post_id:</strong> {{ $item->post_id }}</p>
    <p><strong>User_id:</strong> {{ $item->user_id }}</p>
    <p><strong>Body:</strong> {{ $item->body }}</p>
    
    <a href="{{ route('comments.index') }}" class="btn btn-secondary mt-3">Back to List</a>
@endsection