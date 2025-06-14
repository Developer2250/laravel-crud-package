    @extends('layouts.app')

    @section('title', 'User List')

    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    @endpush

    @section('content')
        <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
            <h1>User List</h1>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
        </div>

        <div class="table-responsive">
            <table id="users-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S. No.</th>
<th>{{ __('labels.name') }}</th>
<th>{{ __('labels.email') }}</th>
<th>{{ __('labels.password') }}</th>
<th>{{ __('labels.gender') }}</th>
<th>{{ __('labels.posts_count') }}</th>
<th>{{ __('labels.comments_count') }}</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
<td>{{ $item->name }}</td>
<td>{{ $item->email }}</td>
<td>{{ $item->password }}</td>
<td>{{ $item->gender }}</td>
<td>{{ $item->posts_count ?? 0 }}</td>
<td>{{ $item->comments_count ?? 0 }}</td>

                            <td>
                                <a href="{{ route('users.show', $item->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('users.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No Users found.</td>
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
                $('#users-table').DataTable();
            });
        </script>
    @endpush