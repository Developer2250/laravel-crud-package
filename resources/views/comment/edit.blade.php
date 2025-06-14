    @extends('layouts.app')

    @section('title', 'Edit Comment')

    @section('content')
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Edit Comment</h1>
                <a href="{{ route('comments.index') }}" class="btn btn-secondary">← Back to List</a>
            </div>

            <form action="{{ route('comments.update', $item->id) }}" method="POST" id="edit-form">
                @csrf
                @method('PUT')
                    <div class="mb-3">
        <label for="post_id" class="form-label">{{ __('labels.post_id') }} <span class="required">*</span></label>
            <input type="text" name="post_id" id="post_id" class="form-control @error('post_id') is-invalid @enderror" placeholder="Enter {{ __('labels.post_id') }}" value="{{ old('post_id', $item->post_id) }}">
    @error('post_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
    <div class="mb-3">
        <label for="user_id" class="form-label">{{ __('labels.user_id') }} <span class="required">*</span></label>
            <input type="text" name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" placeholder="Enter {{ __('labels.user_id') }}" value="{{ old('user_id', $item->user_id) }}">
    @error('user_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">{{ __('labels.body') }} <span class="required">*</span></label>
            <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" placeholder="Enter {{ __('labels.body') }}" rows="4" cols="50">{{ old('body', $item->body) }}</textarea>
    @error('body')
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