<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}


</head>
<body id="app-layout">
<div class="container-fluid">
<div class="row">
<header>
    <div class="col-md-9 menu">
        <a href="{{ route('home') }}">Главная</a>
        <a href="{{ route('gallery') }}">Галерея</a>
        @if(Auth::check())
            <a href="{{ url('admin/'.Auth::user()->id) }}">Aдминкa</a>
        @endif
    </div>

                <div class=" col-md-3 profile-menu">
                <ul class="profile">
                    <!-- если пользователь не зареган -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Авторизация</a></li>
                        <li><a href="{{ url('/register') }}">Регистрация</a></li>
                </ul>
                    @else
                        <a href="#" onclick="down()">
                            <img src="{{ asset('assets/avatars/'.Auth::user()->avatar) }}" class="img-avatar">
                            {{ Auth::user()->name }}
                        </a>
                            <ul style="display: none" class="droplink">
                                <li class="dropmenu"><a href="{{ url('/profile/'.Auth::user()->id) }}"><i class="fa fa-btn "></i>Мой профиль</a></li>
                                <li class="dropmenu"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Выход</a></li>
                            </ul>

                </div>
    @endif
</header>
</div>
</div>

<div class="container">

    @yield('content')
</div>
    <!-- JavaScripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
