<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountain Artisan Collective</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    @include('profile.partials.header')

    <main>
        @yield('content')
    </main>

    @include('profile.partials.footer')
</body>
</html>
