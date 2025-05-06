<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ env('APP_NAME') ?? 'Techno Expo' }}</title>
    <meta name="author" content="Firdaus Nanda">
    <meta name="description" content="Techno Expo">
    <meta name="keywords" content="Techno Expo">
    <meta name="robots" content="INDEX,FOLLOW">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="{{ asset('landing/img/favicons/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('landing/img/favicons/favicon-32x32.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('landing/img/favicons/favicon-32x32.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!--==============================
            Google Fonts
          ============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Unbounded:wght@200..900&display=swap"
        rel="stylesheet">
    <!--==============================
              All CSS File
          ============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('landing/css/fontawesome.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('landing/css/magnific-popup.min.css') }}">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('landing/css/slick.min.css') }}">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="{{ asset('landing/css/animate.min.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
</head>

<body id="body" class="vs-page">

    <!--==============================
          Preloader
          ==============================-->
    <div class="preloader">
        <div class="preloader-inner">
            <img src="{{ asset('landing/img/logo.png') }}" alt="logo">
            <span class="loader"></span>
        </div>
    </div>
    <!-- ==============================
              Popup Search Box
          ============================== -->
    <div class="popup-search-box">
        <button class="searchClose"><i class="fal fa-times"></i></button>
        <form action="#">
            <input id="search-field" type="text" class="border-theme" placeholder="What are you looking for">
            <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    </div>

    @include('layouts.landing.header')

    <main class="vs-page__main">
        <!-- Main Layouts -->
        <div class="vs-page__main--layouts">
            @yield('content')
        </div>
        <!-- Main Layouts End -->

        @include('layouts.landing.footer')
    </main>

    <button class="back-to-top" id="backToTop" aria-label="Back to Top">
        <span class="progress-circle">
            <svg viewBox="0 0 100 100">
                <circle class="bg" cx="50" cy="50" r="40"></circle>
                <circle class="progress" cx="50" cy="50" r="40"></circle>
            </svg>
            <span class="progress-percentage" id="progressPercentage">0%</span>
        </span>
    </button>

    <!-- Jquery -->
    <script src="{{ asset('landing/js/vendor/jquery-7.1.1.slim.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('landing/js/slick.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
    <!-- WOW.js Animation -->
    <script src="{{ asset('landing/js/wow.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('landing/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Image Loaded -->
    <script src="{{ asset('landing/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Isotope Filter -->
    <script src="{{ asset('landing/js/isotope.pkgd.min.js') }}"></script>
    <!-- Gsap -->
    <script src="{{ asset('landing/js/gsap.min.js') }}"></script>
    <!-- ScrollTrigger -->
    <script src="{{ asset('landing/js/ScrollTrigger.min.js') }}"></script>
    <!-- Gsap ScrollTo Plugin -->
    <script src="{{ asset('landing/js/gsap-scroll-to-plugin.js') }}"></script>
    <!-- Lenis Scroll -->
    <script src="{{ asset('landing/js/lenis.min.js') }}"></script>
    <!-- Split Text -->
    <script src="{{ asset('landing/js/SplitText.js') }}"></script>
    <!-- Marquee -->
    <script src="{{ asset('landing/js/marquee.js') }}"></script>
    <!-- Main Js File -->
    <script src="{{ asset('landing/js/main.js') }}"></script>
</body>

</html>
