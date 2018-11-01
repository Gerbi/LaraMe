<!DOCTYPE html>
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
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
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
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/findFriends')}}">Find Friends</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/requests')}}">My Requests
                                <span style="color:green; font-weight:bold;
                                       font-size:14px">({{App\friendships::where('status', Null)
                                                  ->where('user_requested', Auth::user()->id)
                                                  ->count()}})
                                </span>
                            </a>
                        </li>
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/friends')}}"><i class="fas fa-user-friends fa-2x"></i></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-globe-americas fa-2x" aria-hidden="true"></i>
                                <span class="badge badge-danger"
                                      style="position: relative; top: -15px; left: -10px;">
                                    {{App\notifications::where('status', 1)
                                            ->where('user_hero', Auth::user()->id)
                                            ->count()}}
                                </span>
                            </a>
                            <?php
                            $notes = DB::table('notifications')
                            ->where('user_logged',Auth::user()->id)
                            ->get();
                            ?>

                            <?php
                            $notes = DB::table('notifications')
                                    ->leftJoin('users','users.id', 'notifications.user_logged')
                                    ->where('user_hero', Auth::user()->id)
                                    ->where('status',1)//No leido
                                    ->orderBy('notifications.created_at','ASC')
                                    ->get();

                            ?>    
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width: 320px;">
                                @foreach($notes as $note)
                                    <a class="dropdown-item" href="{{url('/notifications')}}/{{$note->id}}" style="text-decoration: none">
                                            <li style="padding:10px" class="dropdown-item">

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <img src="{{url('../')}}/public/img/{{$note->pic}}"
                                                             style="width:50px; padding:5px; background:#fff; border:1px solid #eee" class="rounded-circle">
                                                    </div>

                                                    <div class="col-md-10">
                                                        <b style="color:green; font-size:90%">{{ucwords($note->name)}}</b><br>
                                                        <span style="color:#000; font-size:90%">{{$note->note}}</span>
                                                        <br/>
                                                        <small style="color:#90949C"> <i aria-hidden="true" class="fa fa-users"></i>
                                                            {{date('F j, Y', strtotime($note->created_at))}}
                                                            at {{date('H: i', strtotime($note->created_at))}}</small>
                                                    </div>

                                                </div>
                                            </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="28px" height="28px" class="rounded-circle">
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('/profile')}}/{{Auth::user()->slug }}">Profile</a>
                                <a class="dropdown-item" href="{{url('editProfile')}}">Edit Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
