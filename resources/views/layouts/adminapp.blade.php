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
    <link href="{{ asset('css/allpatient.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="z-index: 1000">
            <div class="container p-0 m-0">
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <i class="fa fa-home" aria-hidden="true">Home</i>
                    <div class="gradient-border" id="box"><img style="width:50px;height:50px;border-radius:50%;border:2px solid yellow" src={{asset(Auth::user()->image != ''? "storage/".Auth::user()->image:'mp/anon.png')}} />
                        
                    {{-- <img style="width:50px;height:50px;border-radius:50%;border:2px solid yellow" src="storage/{{ Auth::user()->image }}" alt=""/>   --}}
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if (Auth::check())
                    <a class="navbar-brand select" href="{{ url('admin/showuser') }}">
                        Patients
                    </a>
                    <br>
                    <a class="navbar-brand select" href="{{route('admin.doctors') }}">
                        Doctors
                    </a>
                    <br>
                    <a class="navbar-brand select" href="{{route('admin.editprofileview') }}">
                        edit profile
                    </a>
                    <br>
                    <a class="navbar-brand select" href="{{ url('admin/sympcontroll') }}">
                        Spymptoms controll
                    </a>
                    @endif
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <li class="list-group"> <a class="navbar-brand select text-secondary" href="{{route('help')}}" style="font-size: 10px"> <img src="{{asset('mp/help.svg')}}" width="30" alt=""> Help &support</a></li>
               
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                            </li>
                            
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
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
