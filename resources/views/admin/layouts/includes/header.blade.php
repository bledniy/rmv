<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            @include('admin.layouts.partials.breadcrumb-admin')
        </div>
        <button class="navbar-toggler d-none" type="button" data-toggle="collapse" aria-controls="navigation-index"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    @include('admin.layouts.includes.langlist')
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.index') }}">
                        <i class="material-icons">dashboard</i>
                        <p class="d-lg-none d-md-block">Stats</p>
                    </a>
                </li>
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown"--}}
{{--                       aria-haspopup="true" aria-expanded="false">--}}
{{--                        <i class="material-icons">notifications</i>--}}
{{--                        <span class="notification">0</span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                        <a class="dropdown-item" href="#">Mike John responded to your email</a>--}}
{{--                    </div>--}}
{{--                </li>--}}
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                       title="{{ Auth::guard('admin')->user()->email }}"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            Account
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">{{ __('modules.users.profile.title') }}</a>
{{--                        <a class="dropdown-item" href="#">Settings</a>--}}
                        <div class="dropdown-divider"></div>
                        <div class="text-center">
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-primary">
                                    <b>{{ __('Logout') }}</b>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
