<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <link rel="stylesheet" href="{{asset('assets/css/navbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/footer.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('users/assets/css/index.css')}}"> --}}
    @yield('styles')
</head>

<body>
    @include('layouts.userNavbar')

    @yield('content')

    @include('layouts.userFooter')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        window.onscroll = function() {
            var navbar = document.querySelector('nav');
            if (window.scrollY > 50) {
                navbar.classList.add('gradient-bg');
            } else {
                navbar.classList.remove('gradient-bg');
            }
        };
    </script>
    @yield('scripts')
</body>

</html>
