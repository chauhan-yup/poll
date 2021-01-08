<ul class="navbar-nav ml-auto">
    @if(!Auth::guard('api')->user())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('api.register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ \Auth::guard('api')->user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="javascript:logout('#logout-form')"
                    >
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('api.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endif
</ul>