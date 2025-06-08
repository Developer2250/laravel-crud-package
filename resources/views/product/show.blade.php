<!DOCTYPE html>
<html>
<head>
    <title>View Product</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <h1>View Product</h1>
    <p><strong>Name:</strong> {{ $item->name }}</p>
        <p><strong>Price:</strong> {{ $item->price }}</p>
        <p><strong>Description:</strong> {{ $item->description }}</p>
        
    <a href="{{ route('products.index') }}" class="btn btn-primary">Back to List</a>
</body>
</html>