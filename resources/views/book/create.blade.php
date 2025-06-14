    @extends('layouts.app')

    @section('title', 'Create Book')

    @section('content')
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Create Book</h1>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">← Back to List</a>
            </div>
            <form action="{{ route('books.store') }}" method="POST" id="create-form">
                @csrf
                    <div class="mb-3">
        <label for="title" class="form-label">{{ __('labels.title') }} <span class="required">*</span></label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter {{ __('labels.title') }}" value="{{ old('title') }}">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="author_id" class="form-label">{{ __('labels.author_id') }} <span class="required">*</span></label>
            <select name="author_id" id="author_id" class="form-select @error('author_id') is-invalid @enderror">
        <option value="">-- Select Author --</option>
        @foreach($authors as $item)
            <option value="{{ $item->id }}" {{ old('author_id') == $item->id ? 'selected' : '' }}>
                {{ $item->title ?? $item->full_name ?? $item->first_name ?? $item->name }}
            </option>
        @endforeach
    </select>
    @error('author_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="published_date" class="form-label">{{ __('labels.published_date') }} <span class="required">*</span></label>
            <input type="date" name="published_date" id="published_date" class="form-control @error('published_date') is-invalid @enderror" placeholder="Enter {{ __('labels.published_date') }}" value="{{ old('published_date') }}">
    @error('published_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="isbn" class="form-label">{{ __('labels.isbn') }} <span class="required">*</span></label>
            <input type="text" name="isbn" id="isbn" class="form-control @error('isbn') is-invalid @enderror" placeholder="Enter {{ __('labels.isbn') }}" value="{{ old('isbn') }}">
    @error('isbn')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="summary" class="form-label">{{ __('labels.summary') }} <span class="required">*</span></label>
            <textarea name="summary" id="summary" class="form-control @error('summary') is-invalid @enderror" placeholder="Enter {{ __('labels.summary') }}" rows="4" cols="50">{{ old('summary') }}</textarea>
    @error('summary')
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
                    const type = input.type;
                    if (type === 'hidden') return;

                    if (type === 'radio' || type === 'checkbox') {
                        input.checked = false;
                    } else if (input.tagName.toLowerCase() === 'select') {
                        input.selectedIndex = 0;
                    } else {
                        input.value = '';
                    }
                });
            });
        </script>
    @endsection