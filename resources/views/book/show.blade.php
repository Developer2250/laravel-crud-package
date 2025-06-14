@extends('layouts.app')

@section('title', 'View Book')

@section('content')
    <h1>View Book</h1>
    <p><strong>Title:</strong> {{ $item->title }}</p>
    <p><strong>Author_id:</strong> {{ $item->author_id }}</p>
    <p><strong>Published_date:</strong> {{ $item->published_date }}</p>
    <p><strong>Isbn:</strong> {{ $item->isbn }}</p>
    <p><strong>Summary:</strong> {{ $item->summary }}</p>
    
    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back to List</a>
@endsection