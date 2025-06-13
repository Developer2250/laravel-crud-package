@extends('layouts.app')

@section('title', 'Author List')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
        <h1>Author List</h1>
        <a href="{{ route('authors.create') }}" class="btn btn-primary">Create Author</a>
    </div>

    <div class="table-responsive">
        <table id="authors-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S. No.</th>
<th>{{ __('labels.first_name') }}</th>
<th>{{ __('labels.last_name') }}</th>
<th>{{ __('labels.bio') }}</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
<td>{{ $item->first_name }}</td>
<td>{{ $item->last_name }}</td>
<td>{{ $item->bio }}</td>

                        <td>
                            <a href="{{ route('authors.show', $item->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('authors.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('authors.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Authors found.</td>
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
            $('#authors-table').DataTable();
        });
    </script>
@endpush