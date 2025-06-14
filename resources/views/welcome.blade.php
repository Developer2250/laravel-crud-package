<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
	<div class="text-center mt-4">
		<a href="{{ route('books.index') }}" class="btn btn-success">Book</a>
		<a href="{{ route('products.index') }}" class="btn btn-success">Product</a>
		<a href="{{ route('authors.index') }}" class="btn btn-success">Author</a>
		<a href="{{ route('users.index') }}" class="btn btn-success">User</a>
		<a href="{{ route('posts.index') }}" class="btn btn-success">Post</a>
		<a href="{{ route('comments.index') }}" class="btn btn-success">Comment</a>

	</div>
</body>

</html>
