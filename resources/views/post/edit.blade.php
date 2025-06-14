    @extends('layouts.app')

    @section('title', 'Edit Post')

    @section('content')
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Edit Post</h1>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">← Back to List</a>
            </div>

            <form action="{{ route('posts.update', $item->id) }}" method="POST" id="edit-form">
                @csrf
                @method('PUT')
                    <div class="mb-3">
        <label for="user_id" class="form-label">{{ __('labels.user_id') }} <span class="required">*</span></label>
            <input type="text" name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" placeholder="Enter {{ __('labels.user_id') }}" value="{{ old('user_id', $item->user_id) }}">
    @error('user_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">{{ __('labels.title') }} <span class="required">*</span></label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter {{ __('labels.title') }}" value="{{ old('title', $item->title) }}">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">{{ __('labels.content') }} <span class="required">*</span></label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" placeholder="Enter {{ __('labels.content') }}" rows="4" cols="50">{{ old('content', $item->content) }}</textarea>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
    <div class="mb-3">
        <label for="comments_count" class="form-label">{{ __('labels.comments_count') }} <span class="required">*</span></label>
            <input type="text" name="comments_count" id="comments_count" class="form-control @error('comments_count') is-invalid @enderror" placeholder="Enter {{ __('labels.comments_count') }}" value="{{ old('comments_count', $item->comments_count) }}">
    @error('comments_count')
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