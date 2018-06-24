<header class="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse mr-auto">
                <a class="navbar-brand" href="{{ route('home') }}">
                    Laravel.test
                </a>
            </div>
            <div class="collapse navbar-collapse ml-auto justify-content-end">
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @role('root')
                                    <a class="dropdown-item" href="{{ route('auth.switchUser') }}">
                                        Switch User
                                    </a>
                                @endrole
                                <a id="logout-link" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>
