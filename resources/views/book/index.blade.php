@extends('layouts.app')

@section('title', 'Book List')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
        <h1>Book List</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Create Book</a>
    </div>

    <div class="table-responsive">
        <table id="books-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S. No.</th>
<th>{{ __('labels.title') }}</th>
<th>{{ __('labels.author_id') }}</th>
<th>{{ __('labels.published_date') }}</th>
<th>{{ __('labels.isbn') }}</th>
<th>{{ __('labels.summary') }}</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
<td>{{ $item->title }}</td>
<td>{{ $item->author->full_name ?? '-' }}</td>
<td>{{ optional($item->published_date)->format('Y-m-d') }}</td>
<td>{{ $item->isbn }}</td>
<td title="{{ $item->summary }}">{{ Str::limit($item->summary, 50) }}</td>

                        <td>
                            <a href="{{ route('books.show', $item->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('books.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('books.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Books found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#books-table').DataTable();
        });
    </script>
@endpush