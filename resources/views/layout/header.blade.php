<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" class="logo-img" alt="">
                <h1><a href="/" style="margin-left: 70px;">{{ trans('layout.header_title') }}</a></h1>
            </div>
        </div>
        <div class="col-md-offset-5 col-md-3">
            <div class="navbar navbar-inverse" role="banner">
                <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                    <ul class="nav navbar-nav">
                        @if (Auth::user())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <b class="caret"></b></a>
                                <ul class="dropdown-menu animated fadeInUp">
                                    <li>
                                        <a href="{{ action('Auth\AuthController@logout') }}">
                                            <i class="fa fa-user" aria-hidden="true"></i> {{ trans('user.profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ action('Auth\AuthController@logout') }}">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> {{ trans('user.logout') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="{{ action('Auth\AuthController@showLoginForm') }}">{{ trans('user.login') }}</a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ action('Auth\AuthController@showRegistrationForm') }}">{{ trans('user.register') }}</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
