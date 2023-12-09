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

    <style>
        nav {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 100px;
            /* margin-top: 100px; */
            background-color: black;
            position: fixed;
            width: 100%;
            transition: background-color 0.5s ease;
        }

        nav.gradient-bg {
            background: linear-gradient(to right, #000000, #333333);
        }

        .logo {
            width:75px;
        }

        .navbar-nav .nav-item .nav-link {
            color: white;

        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #ffbd59;
        }
    </style>
    <style>
        footer {
            margin-top: 100px;
            background-color: #000;
            color: #ffbd59;
            padding: 1px; /* Reduced padding to make the footer smaller */
            display: flex;
            justify-content: center; /* Centering content in both columns */
            flex-wrap: wrap;
            text-align: center;
            padding-top: 20px;
        }

        .company-column {
            flex-basis: 100%; /* Full width for the right column */
        }

        .company-name {
            margin: 0;
            font-size: 1.5rem; /* Reduced font size */
        }

        .tagline {
            color: #ffffff;
            margin: 0 0 10px 0; /* Adjusted margin */
            font-size: 0.8rem; /* Reduced font size */
            color: #ffbd59;
        }

        .icon-row {
            display: flex;
            justify-content: center;
            margin-top: 5px; /* Reduced margin */
        }

        .icon-row a i {
            margin: 0 15px; /* Reduced margin */
            font-size: 20px; /* Reduced icon size */
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }


        .title {
            font-weight: 1000;
            font-size: 3rem;
        }

        .sub-title {
            font-size: 1rem;
            color: #ffbd59;
        }

        .sub-content {
            text-align: justify;
            margin-left: 30px;
            margin-right: 30px;
            font-size: 1rem;
            color: #ffffff;
        }

        .gold {
            color: #ffbd59;
        }

        .white, .text-center {
            color: #ffffff;
        }
    </style>
    <style>
        #main-container {
            margin-top: 500px;
            flex: 1; /* Let the main container grow to fill the available space */
        }
        .title {
    font-weight: 1000;
    font-size: 3rem;
}

.sub-title {
    font-size: 0.8rem;
    color: #222;
}

.ps-3 {
    text-align: justify;
    margin-left: 70px;
    margin-right: 50px;
}

.mb-0 {
    font-weight: bolder;
    color: #ffbd59;
}

.login-here {
    font-size: 0.9rem;
    font-family: system-ui;
    font-weight: 100;
    color: #ffffff;
}

.form-container {
    padding: 20px;
    background: #ffffff26;
    box-shadow: 0 8px 32px 0 rgba(170, 163, 163, 0.37);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    border-radius: 15px;
    border: 1px solid rgba(255, 255, 255, 0.18);
    width: 72%;
    height: auto;
    display: flex;
    flex-direction: column;
}

.hove:hover {
    color: #FFFFFF;
    text-decoration: none;
}

.hove{
    color: #ffbd59;
}

label {
    font-size: .9rem;
    font-weight: 100;
    color: #f3f3f3;
}

.gold {
    color: #ffbd59;
}

.white {
    color: #ffffff;
}

.custom-btn {
    background-color: #ffbd59;
    color: black;
    font-weight: bold;
    width: 100%;
    display: block;
    margin: auto;
    transition: background-color 0.3s;
    border-radius: 7px;
    padding: 5px;
    font-size: 1.1rem;
}

.custom-btn:hover {
    background-color: #d9a500;
}

.form-check {
    margin-left: 10px;
}

#passwordHelp{
    color: #f3f3f3;
    font-size: .7rem;
}
    </style>
    @yield('styles')
</head>
<body style="background-image: url('{{asset('users/assets/img/bg2.jpg')}}'); background-repeat: no-repeat; background-size: cover; margin: 0;
display: flex;
flex-direction: column;
min-height: 100vh;">

    @include('layouts.nav')

    @yield('content')

    @include('layouts.footer')

    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
