@extends('layouts.app')

@section('title', 'View Product')

@section('content')
    <h1>View Product</h1>
    <p><strong>Name:</strong> {{ $item->name }}</p>
    <p><strong>Price:</strong> {{ $item->price }}</p>
    <p><strong>Description:</strong> {{ $item->description }}</p>
    
    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to List</a>
@endsection