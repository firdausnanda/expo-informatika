<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <a href="{{ route('index') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <h1 class="sitename">Informatic Show Off</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('index') }}" class="active">Home</a></li>
                <li><a href="{{ route('leaderboard') }}">Leaderboard</a></li>
                <li><a href="{{ route('history') }}">History</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                @auth
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn btn-outline-danger btn-sm rounded-pill px-3 ms-2 text-decoration-none">
                                <i class="bi bi-box-arrow-left me-2"></i>
                                <span class="d-none d-md-inline">Logout</span>
                            </button>
                        </form>
                    </li>
                @else
                    <li>
                        <form action="{{ route('login') }}" method="GET">
                            @csrf
                            <button type="submit"
                                class="btn btn-outline-primary btn-sm rounded-pill px-3 ms-2 text-decoration-none">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                <span class="d-none d-md-inline">Login</span>
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>
