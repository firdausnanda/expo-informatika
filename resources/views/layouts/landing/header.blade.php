<!--==============================
          Mobile Menu
      ============================== -->
<div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center">
        <div class="mobile-logo">
            <a href="index.html"><img src="{{ asset('landing/img/logo.png') }}" alt="roda" class="logo"></a>
            <button class="vs-menu-toggle">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="vs-header__right justify-content-end pt-4">
            <a href="{{ route('login') }}" class="vs-btn vs-btn--style2">
                Login
            </a>
            <button class="searchBoxTggler" type="button">
                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20.4174 16.6954L17.2213 13.4773C19.3155 10.0703 18.8936 5.54217 15.9593 2.58766C12.5328 -0.862552 6.9769 -0.862552 3.55037 2.58766C0.123835 6.03787 0.123835 11.6322 3.55037 15.0824C6.5354 18.088 11.1341 18.4736 14.5333 16.2469L17.7019 19.4335C18.4521 20.1888 19.6711 20.1888 20.4213 19.4335C21.1675 18.6781 21.1675 17.4507 20.4174 16.6954ZM5.711 12.9029C3.48395 10.6604 3.48395 7.00959 5.711 4.76715C7.93805 2.52471 11.5638 2.52471 13.7909 4.76715C16.018 7.00959 16.018 10.6604 13.7909 12.9029C11.5638 15.1453 7.93805 15.1453 5.711 12.9029Z"
                        fill="#F6F5F5"></path>
                </svg>
            </button>
        </div>
        <div class="vs-mobile-menu">
            <ul>
                <li>
                    <a class="vs-svg-assets" href="#">HOME</a>
                </li>
                <li>
                    <a class="vs-svg-assets" href="#">About</a>
                </li>
                <li>
                    <a href="#">Projects</a>
                </li>
                <li>
                    <a href="#">News</a>
                </li>
                <li>
                    <a class="vs-svg-assets" href="#">contact</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Header Layout1 -->
<header id="header" class="vs-header">
    <div id="sticky-placeholder"></div>
    <div class="vs-sticky-header">
        <div id="navbar-wrap">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-auto col-lg-auto col-md-auto col-auto">
                        <div class="vs-header__logo">
                            <a class="vs-header__logo-link" href="{{ route('index') }}">
                                <img src="{{ asset('landing/img/logo.png') }}" alt="Roda Logo - Gaming HTML5 Template"
                                    loading="lazy" width="185">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-auto col-lg-auto col-md-auto col-auto flex-grow-1 d-none d-lg-block">
                        <nav class="main-menu d-none d-lg-block">
                            <ul>
                                <li>
                                    <a class="{{ request()->routeIs('index') ? 'menu-active' : '' }}"
                                        href="{{ route('index') }}">HOME</a>
                                </li>
                                <li>
                                    <a href="#">About</a>
                                </li>
                                <li>
                                    <a href="#">Projects</a>
                                </li>
                                <li>
                                    <a href="#">News</a>
                                </li>
                                <li>
                                    <a href="contact.html">contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-auto col-lg-auto col-md-auto col-auto">
                        <div class="vs-header__right">
                            <button class="searchBoxTggler d-none d-md-flex">
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.4174 16.6954L17.2213 13.4773C19.3155 10.0703 18.8936 5.54217 15.9593 2.58766C12.5328 -0.862552 6.9769 -0.862552 3.55037 2.58766C0.123835 6.03787 0.123835 11.6322 3.55037 15.0824C6.5354 18.088 11.1341 18.4736 14.5333 16.2469L17.7019 19.4335C18.4521 20.1888 19.6711 20.1888 20.4213 19.4335C21.1675 18.6781 21.1675 17.4507 20.4174 16.6954ZM5.711 12.9029C3.48395 10.6604 3.48395 7.00959 5.711 4.76715C7.93805 2.52471 11.5638 2.52471 13.7909 4.76715C16.018 7.00959 16.018 10.6604 13.7909 12.9029C11.5638 15.1453 7.93805 15.1453 5.711 12.9029Z"
                                        fill="#F6F5F5" />
                                </svg>
                            </button>
                            <a href="{{ route('login') }}" class="vs-btn vs-btn--style2 d-none d-md-flex">
                                Login
                            </a>
                            <button class="vs-menu-toggle d-inline-flex d-lg-none"><i class="fal fa-bars"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header Layout1 End -->
