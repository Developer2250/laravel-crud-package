@extends('layouts.app')

@section('title', 'View Author')

@section('content')
    <h1>View Author</h1>
    <p><strong>First_name:</strong> {{ $item->first_name }}</p>
    <p><strong>Last_name:</strong> {{ $item->last_name }}</p>
    <p><strong>Bio:</strong> {{ $item->bio }}</p>
    
    <a href="{{ route('authors.index') }}" class="btn btn-secondary mt-3">Back to List</a>
@endsection