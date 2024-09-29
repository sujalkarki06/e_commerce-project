<!-- resources/views/errors/page-not-found.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
</head>
<body>
    <h1>Page Not Found</h1>
    <p>{{ $message }}</p>
    <a href="{{ url('/') }}">Return to Home</a>
</body>
</html>
