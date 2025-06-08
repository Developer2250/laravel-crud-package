<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" value="{{ $item->name }}" step="0.01" required>
</div>
<div class="form-group">
    <label for="price">Price</label>
    <input type="number" name="price" class="form-control" value="{{ $item->price }}" step="0.01" required>
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control" required>{{ $item->description }}</textarea>
</div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</body>
</html>