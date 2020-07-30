<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div id="app" class="home-sidebar">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/app') }}">App</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        <div class="welcome-section-1">
            <div class="center-text">
                <h1>RoutineAMP</h1>
            </div>
        </div>
        <div class="welcome-section-2">
            <div class="center-text">
                <h1>RoutineAMP 2</h1>
            </div>
        </div>
        <div class="welcome-section-3">
            <div class="center-text">
                <h1>RoutineAMP 3</h1>
            </div>
        </div>
    </body>
</html>
