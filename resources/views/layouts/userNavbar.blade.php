<nav class="navbar navbar-expand-lg fixed-top mb-4 p-1">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img class="logo" src="{{asset('img/cslogo.png')}}" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto" style="font-weight:bold;">
                @auth
                @if ( auth()->user()->is_admin)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admins.home')}}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admins.index')}}">Users</a>
                </li>
                @endif
                @endauth

                {{-- <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link" href="{{route('movieList')}}">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about')}}">About</a>
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">Register</a>
                </li>
                @endguest
                @auth
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endauth

            </ul>
        </div>
    </div>
</nav>
