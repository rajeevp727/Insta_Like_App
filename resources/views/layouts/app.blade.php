<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Insta_Like_App</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        * {
            margin: 0px;
        }
    </style>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class=" main navbar navbar-expand-md navbar-light bg-white shadow-sm col-lg-12"
            style="position: fixed; top:0px; overflow: hidden; width: 100%; height: 45px;">
            <div class="container d-flex">
                {{-- INSTA LOGO --}}
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <div><img src="/SVG/insta.svg" style="height: 20px; border-right: 1px solid black;" class="pr-3">
                    </div>
                    <div class="pl-3">Insta_Like_App</div>
                </a>

                <div style="margin-left:22%;">
                    <input type="input" class=" text-center" placeholder="Search"
                        style="border-radius: 7px; width: 250px;">
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else

                        {{-- HOME Img --}}
                        <a class="navbar-brand d-flex" href="{{ url('/') }}">
                            <div><img src="/SVG/home.png" style="height: 30px;"></div>
                        </a>

                        {{-- Chat Img --}}
                        <a class="navbar-brand d-flex" href="{{ url('/chat') }}">
                            <div><img src="/SVG/chat.png" style="height: 30px;"></div>
                        </a>

                        {{-- Notifications Img --}}
                        <a class="navbar-brand d-flex">
                            <div><img src="/SVG/notifications.png" style="height: 30px;"></div>
                        </a>
                        <div style="float: right;">

                            {{-- User Profile Img --}}
                            <a id="navbarDropdown" class="nav-item dropdown nav-link navbar-brand d-flex pl-0"
                                role="button" data-toggle="dropdown" aria-expanded="false" v-pre>
                                <div><img src="/SVG/userProfile.png" style="height: 30px;"></div>
                            </a>

                            {{-- DropDown options viz. Profile, Logout --}}
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile/{{Auth::user()->profile->id}}">Profile</a>
                                <a class="dropdown-item" href="/p/favorites">Favorites</a>
                                <a class="dropdown-item" href="/comments">Comments</a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</body>

</html>
