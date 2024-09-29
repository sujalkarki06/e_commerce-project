<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Shop')</title>

</head>
<body>
  
        @include('profile.partials.header')

    
    <div class="main-content">
        @yield('content')
    </div>
    

        @include('profile.partials.footer')

    
</body>
</html>
