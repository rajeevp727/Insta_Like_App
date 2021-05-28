<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm col-lg-12">
            <div class="container d-flex">
                {{-- INSTA LOGO --}}
                <a class="navbar-brand d-flex" href="{{ url('/home') }}">
                    <div><img src="/SVG/insta.svg" style="height: 20px; border-right: 1px solid black;" class="pr-3"></div>
                    <div class="pl-3 pt-1">Insta_Like_App</div>
                </a>

                <div class="search" style="margin-left:25%;">
                    <div style="border: 1px solid black; width: 170px; height:30px;">
                        <input type="input" class=" text-center" placeholder="Search">
                    </div>
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
                        <a class="navbar-brand d-flex" href="{{ url('/home') }}">
                            <div><img src="/SVG/home.png" style="height: 30px;"></div>
                        </a>

                        {{-- Chat Img --}}
                        <a class="navbar-brand d-flex" href="{{ url('/chat') }}">
                            <div><img src="/SVG/chat.png" style="height: 30px;"></div>
                        </a>
                        
                        {{-- Notifications Img --}}
                        <a class="navbar-brand d-flex" href="{{ url('/notifications') }}">
                            <div><img src="/SVG/notifications.png" style="height: 30px;"></div>
                        </a>
                            <div style="float: right;">
                                {{-- User Profile Img --}}  
                                <a id="navbarDropdown" class="nav-item dropdown nav-link navbar-brand d-flex" role="button" data-toggle="dropdown" aria-haspopup="true" href="{{ url('/home') }}" aria-expanded="false" v-pre>
                                    <div><img src="/SVG/userProfile.png" style="height: 30px;"></div>
                                </a>

                                <div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdown" style="margin-left:80%;">
                                    <a class="dropdown-item" href="/profile/" onclick="document.getElementById('profile-form').submit();">Profile</a>
                                    <form id="profile-form" action="/profile/" class="d-none"> @csrf </form>

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
                                </div>
                                
                            </div>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
