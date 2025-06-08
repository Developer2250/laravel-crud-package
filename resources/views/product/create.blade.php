@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Create Product</h1>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">← Back to List</a>
        </div>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
                <div class="mb-3">
        <label for="name" class="form-label">Name <span class="required">*</span></label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" value="{{ old('name') }}">
@error('name')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price <span class="required">*</span></label>
        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" step="0.01" placeholder="Enter Price" value="{{ old('price') }}">
@error('price')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description <span class="required">*</span></label>
        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description" rows="4" cols="50">{{ old('description') }}</textarea>
@error('description')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>

            <div class="d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-danger">Cancel</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
@endsection