    @extends('layouts.app')

    @section('title', 'Create User')

    @section('content')
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Create User</h1>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">← Back to List</a>
            </div>
            <form action="{{ route('users.store') }}" method="POST" id="create-form">
                @csrf
                    <div class="mb-3">
        <label for="name" class="form-label">{{ __('labels.name') }} <span class="required">*</span></label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter {{ __('labels.name') }}" value="{{ old('name') }}">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="email" class="form-label">{{ __('labels.email') }} <span class="required">*</span></label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter {{ __('labels.email') }}" value="{{ old('email') }}">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="password" class="form-label">{{ __('labels.password') }} <span class="required">*</span></label>
            <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter {{ __('labels.password') }}" value="{{ old('password') }}">
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>    <div class="mb-3">
        <label for="gender" class="form-label">{{ __('labels.gender') }} <span class="required">*</span></label>
            <div>
            <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
        <label class="form-check-label" for="gender_male">Male</label>
    </div>    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
        <label class="form-check-label" for="gender_female">Female</label>
    </div>    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="gender_other" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
        <label class="form-check-label" for="gender_other">Other</label>
    </div>
        @error('gender')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
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