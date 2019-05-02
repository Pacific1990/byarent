<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <style>
        .bold { font-weight: bold; }
        .bolder { font-weight: bolder !important; }
        .text-blue { color : blue }
        .text-red { color : red }

        nav#first { padding: 15px 0!important; }
        a { text-decoration: none!important; }
        .logo { font-size: 25px }
        .badge { position: absolute; top: 0; }

        .charts { border: 1px solid #d3d3d3; padding: 10px; background: #fff; text-align: right }
        .charts .counter { font-weight: bolder; font-size: 20px }
    </style>
</head>
<body>
    <div id="app">
        <nav id="first" class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <strong class="display-4 logo">BYA<span class="text-red">RENT</span> </strong>
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                            <li class="nav-item dropdown">
                                <!--
                                <a id="cartDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Cart
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    @if(session('cart'))
                                        <span class="badge badge-pill badge-danger">{{ count(session('cart')) }}</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">0</span>
                                    @endif
                                </a>
                                -->
                                <a class="nav-link" href="{{ url('cart') }}">
                                    Cart
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    @if(session('cart'))
                                        <span class="badge badge-pill badge-danger">{{ count(session('cart')) }}</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">0</span>
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cartDropdown">
                                    <div class="row total-header-section">
                                        <div class="col-lg-6 col-sm-6 col-6">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            @if(session('cart'))
                                                <span class="badge badge-pill badge-danger">{{ count(session('cart')) }}</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">0</span>
                                            @endif
                                        </div>
                                        <?php $total = 0 ?>
                                        @if(session('cart'))
                                            @foreach(session('cart') as $id => $details)
                                                <?php $total += $details['price'] * $details['quantity'] ?>
                                            @endforeach
                                        @endif
                                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                            <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                                        </div>
                                    </div>
                                    @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                            <div class="row cart-detail">
                                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                    <img src="{{ $details['photo'] }}" />
                                                </div>
                                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                    <p>{{ $details['name'] }}</p>
                                                    <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                                <a href="{{ url('cart') }}" class="btn btn-primary btn-block">View all</a>
                                            </div>
                                        </div>
                                    @else
                                        <div>Le panier est vide.</div>
                                    @endif
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="navbar-laravel">
            <div class="container">
                <nav class="nav d-flex justify-content-between">
                    @guest
                        <a class="p-2 text-muted" href="{{ url('/') }}">HOME</a>
                        <a class="p-2 text-muted" href="{{ url('rent') }}">FOR RENT</a>
                        <a class="p-2 text-muted" href="{{ url('sale') }}">FOR SALE</a>
                        <a class="p-2 text-muted" href="{{ url('contact') }}">CONTACT</a>
                        <a class="p-2 text-muted" href="{{ url('favorite') }}">FAVORITE</a>
                    @else
                        @if(Auth::user()->group_id == 1)
                            <a class="p-2 text-muted" href="{{ url('home') }}">DASHBOARD</a>
                            <a class="p-2 text-muted" href="{{ url('houses') }}">HOUSES</a>
                            <a class="p-2 text-muted" href="{{ url('orders') }}">ORDERS</a>
                            <a class="p-2 text-muted" href="{{ url('users') }}">USERS</a>
                            <a class="p-2 text-muted" href="{{ url('groups') }}">GROUPS</a>
                        @endif
                    @endguest
                </nav>

                @if(session()->get('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
