<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <h1>Product List</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->description }}</td>
                
                    <td>
                        <a href="{{ route('products.show', $item->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>