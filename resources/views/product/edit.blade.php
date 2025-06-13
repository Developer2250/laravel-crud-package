@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Edit Product</h1>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">← Back to List</a>
        </div>

        <form action="{{ route('products.update', $item->id) }}" method="POST" id="edit-form">
            @csrf
            @method('PUT')
                <div class="mb-3">
        <label for="name" class="form-label">{{ __('labels.name') }} <span class="required">*</span></label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter {{ __('labels.name') }}" value="{{ old('name', $item->name) }}">
@error('name')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">{{ __('labels.price') }} <span class="required">*</span></label>
        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" step="0.01" placeholder="Enter {{ __('labels.price') }}" value="{{ old('price', $item->price) }}">
@error('price')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">{{ __('labels.description') }} <span class="required">*</span></label>
        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter {{ __('labels.description') }}" rows="4" cols="50">{{ old('description', $item->description) }}</textarea>
@error('description')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>

            <div class="d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-danger" id="edit-clear-form">Cancel</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
<script>
    document.getElementById('edit-clear-form').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent any default actions
        const form = document.getElementById('edit-form');
        form.querySelectorAll('input, textarea, select').forEach(input => {
            if (input.type === 'hidden') return; // Skip hidden inputs, e.g., _method field
            if (input.type === 'checkbox' || input.type === 'radio') {
                input.checked = false;
            } else {
                input.value = '';
            }
        });
    });
</script>
@endsection