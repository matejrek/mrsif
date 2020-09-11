<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
    <div id="app">
        {{--<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="navItem">
                                <a class="navLink" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="navItem">
                                    <a class="navLink" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="navItem dropdown">
                                <a id="navbarDropdown" class="navLink dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdownItem" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="navItem">
                                <a class="navLink" href="/app">Home</a>
                            </li>
                            <li class="navItem">
                                <a class="navLink" href="/data">Add new routine</a>
                            </li>
                            <li class="navItem">
                                <a class="navLink" href="/routines">View routines</a>
                            </li>
                            <li class="navItem">
                                <a class="navLink" href="/trackers">Trackers</a>
                            </li>
                            <li class="navItem">
                                <a class="navLink" href="/tasks">Tasks</a>
                            </li>
                            <li class="navItem">
                                <a class="navLink" href="/stopwatch">Stopwatch</a>
                            </li>
                            <li class="navItem">
                                <a class="navLink" href="/feedback">Give feeback</a>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>--}}
        <div class="sidebar">
            <a class="navbarBrand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <ul class="navbar">
                <!-- Authentication Links -->
                @guest
                    <li class="navItem">
                        <a class="navLink" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="navItem">
                            <a class="navLink" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="navItem dropdown">
                        <a id="navbarDropdown" class="navLink dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdownMenu dropdownMenuRight" aria-labelledby="navbarDropdown">
                            <a class="dropdownItem" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="navItem">
                        <a class="navLink" href="/app">Home</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink" href="/data">Add new routine</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink" href="/routines">View routines</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink" href="/trackers">Trackers</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink" href="/tasks">Tasks</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink" href="/stopwatch">Stopwatch</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink" href="/food">Food</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink" href="/planner">Planner</a>
                    </li>
                    <li class="navItem">
                        <a class="navLink" href="/feedback">Give feeback</a>
                    </li>
                @endguest
            </ul>
        </div>
        <main class="mainContent">
            @yield('content')
        </main>
    </div>


    @yield('scripts')
</body>
    
</html>
