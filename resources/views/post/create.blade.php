    @extends('layouts.app')

    @section('title', 'Create Post')

    @section('content')
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Create Post</h1>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">← Back to List</a>
            </div>
            <form action="{{ route('posts.store') }}" method="POST" id="create-form">
                @csrf
                    <div class="mb-3">
        <label for="user_id" class="form-label">{{ __('labels.user_id') }} <span class="required">*</span></label>
            <input type="text" name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" placeholder="Enter {{ __('labels.user_id') }}" value="{{ old('user_id') }}">
    @error('user_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="title" class="form-label">{{ __('labels.title') }} <span class="required">*</span></label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter {{ __('labels.title') }}" value="{{ old('title') }}">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="content" class="form-label">{{ __('labels.content') }} <span class="required">*</span></label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" placeholder="Enter {{ __('labels.content') }}" rows="4" cols="50">{{ old('content') }}</textarea>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="comments_count" class="form-label">{{ __('labels.comments_count') }} <span class="required">*</span></label>
            <input type="text" name="comments_count" id="comments_count" class="form-control @error('comments_count') is-invalid @enderror" placeholder="Enter {{ __('labels.comments_count') }}" value="{{ old('comments_count') }}">
    @error('comments_count')
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