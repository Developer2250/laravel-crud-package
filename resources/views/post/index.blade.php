    @extends('layouts.app')

    @section('title', 'Post List')

    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    @endpush

    @section('content')
        <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
            <h1>Post List</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
        </div>

        <div class="table-responsive">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S. No.</th>
<th>{{ __('labels.user_id') }}</th>
<th>{{ __('labels.title') }}</th>
<th>{{ __('labels.content') }}</th>
<th>{{ __('labels.comments_count') }}</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
<td>
    {{
        $item->user->full_name
        ?? $item->user->name
        ?? $item->user->title
        ?? '-'
    }}
</td>
<td>{{ $item->title }}</td>
<td>{{ $item->content }}</td>
<td>{{ $item->comments_count ?? 0 }}</td>

                            <td>
                                <a href="{{ route('posts.show', $item->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('posts.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Posts found.</td>
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
                $('#posts-table').DataTable();
            });
        </script>
    @endpush