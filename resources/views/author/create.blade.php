@extends('layouts.app')

@section('title', 'Create Author')

@section('content')
    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Create Author</h1>
            <a href="{{ route('authors.index') }}" class="btn btn-secondary">← Back to List</a>
        </div>
        <form action="{{ route('authors.store') }}" method="POST" id="create-form">
            @csrf
                <div class="mb-3">
        <label for="first_name" class="form-label">{{ __('labels.first_name') }} <span class="required">*</span></label>
        <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter {{ __('labels.first_name') }}" value="{{ old('first_name') }}">
@error('first_name')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">{{ __('labels.last_name') }} <span class="required">*</span></label>
        <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter {{ __('labels.last_name') }}" value="{{ old('last_name') }}">
@error('last_name')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="mb-3">
        <label for="bio" class="form-label">{{ __('labels.bio') }} <span class="required">*</span></label>
        <textarea name="bio" id="bio" class="form-control @error('bio') is-invalid @enderror" placeholder="Enter {{ __('labels.bio') }}" rows="4" cols="50">{{ old('bio') }}</textarea>
@error('bio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>

            <div class="d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-danger" id="clear-form">Cancel</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
<script>
    document.getElementById('clear-form').addEventListener('click', function () {
        const form = document.getElementById('create-form');
        form.querySelectorAll('input, textarea, select').forEach(input => {
            if (input.type === 'checkbox' || input.type === 'radio') {
                input.checked = false;
            } else {
                input.value = '';
            }
        });
    });
</script>
@endsection