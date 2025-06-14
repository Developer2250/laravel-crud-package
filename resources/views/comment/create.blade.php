    @extends('layouts.app')

    @section('title', 'Create Comment')

    @section('content')
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Create Comment</h1>
                <a href="{{ route('comments.index') }}" class="btn btn-secondary">← Back to List</a>
            </div>
            <form action="{{ route('comments.store') }}" method="POST" id="create-form">
                @csrf
                    <div class="mb-3">
        <label for="post_id" class="form-label">{{ __('labels.post_id') }} <span class="required">*</span></label>
            <select name="post_id" id="post_id" class="form-select @error('post_id') is-invalid @enderror">
        <option value="">-- Select Post --</option>
        @foreach($posts as $item)
            <option value="{{ $item->id }}" {{ old('post_id') == $item->id ? 'selected' : '' }}>
                {{ $item->title ?? $item->full_name ?? $item->first_name ?? $item->name }}
            </option>
        @endforeach
    </select>
    @error('post_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="user_id" class="form-label">{{ __('labels.user_id') }} <span class="required">*</span></label>
            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
        <option value="">-- Select User --</option>
        @foreach($users as $item)
            <option value="{{ $item->id }}" {{ old('user_id') == $item->id ? 'selected' : '' }}>
                {{ $item->title ?? $item->full_name ?? $item->first_name ?? $item->name }}
            </option>
        @endforeach
    </select>
    @error('user_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="body" class="form-label">{{ __('labels.body') }} <span class="required">*</span></label>
            <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" placeholder="Enter {{ __('labels.body') }}" rows="4" cols="50">{{ old('body') }}</textarea>
    @error('body')
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