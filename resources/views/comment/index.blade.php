    @extends('layouts.app')

    @section('title', 'Comment List')

    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    @endpush

    @section('content')
        <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
            <h1>Comment List</h1>
            <a href="{{ route('comments.create') }}" class="btn btn-primary">Create Comment</a>
        </div>

        <div class="table-responsive">
            <table id="comments-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S. No.</th>
<th>{{ __('labels.post_id') }}</th>
<th>{{ __('labels.user_id') }}</th>
<th>{{ __('labels.body') }}</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
<td>
    {{
        $item->post->full_name
        ?? $item->post->name
        ?? $item->post->title
        ?? '-'
    }}
</td>
<td>
    {{
        $item->user->full_name
        ?? $item->user->name
        ?? $item->user->title
        ?? '-'
    }}
</td>
<td>{{ $item->body }}</td>

                            <td>
                                <a href="{{ route('comments.show', $item->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('comments.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('comments.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Comments found.</td>
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
                $('#comments-table').DataTable();
            });
        </script>
    @endpush