<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <h1>Create Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" required>
</div>
<div class="form-group">
    <label for="price">Price</label>
    <input type="number" name="price" class="form-control" step="0.01" required>
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control" required></textarea>
</div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</body>
</html>