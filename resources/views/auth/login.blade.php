@extends('layouts.landing.main')

@section('content')
    <section class="space space-extra-bottom" data-bg-src="{{ asset('landing/img/contact/ct-bg.png') }}">
        <div class="container mt-5">
            <div class="row gx-60 align-items-center">
                <div class="col-lg-5 mx-auto">
                    <div class="comming-content text-center">

                        <div class="row justify-content-center">

                            <div class="title-style title-style--style2 mb-0">
                                <span class="title-style__small justify-content-center wow animate__fadeInUp"
                                    data-wow-delay="0.6s">
                                    <svg width="79" height="6" viewBox="0 0 79 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 0L0 3.2L4 6H38L39.5 3.4L41.5 6H75L78.5 3.2L75 0H41.5L39.5 2.2L38 0H4Z"
                                            fill="#A6D719">
                                        </path>
                                    </svg>
                                    Welcome
                                    <svg width="79" height="6" viewBox="0 0 79 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 0L0 3.2L4 6H38L39.5 3.4L41.5 6H75L78.5 3.2L75 0H41.5L39.5 2.2L38 0H4Z"
                                            fill="#A6D719">
                                        </path>
                                    </svg>
                                </span>
                                <h2 class="title-style__big wow animate__fadeInUp" data-wow-delay="0.8s">
                                    Login
                                </h2>
                            </div>

                            <form action="{{ route('login') }}" method="post"
                                class="form-style2 pt-30 wow animate__fadeInUp" data-wow-delay="0.95s">
                                @csrf
                                <div class="row gx-2 g-2 justify-content-center">
                                    <div class="col-md-12 form-group">
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                            name="email" id="email" value="{{ old('email') }}" placeholder="Email *"
                                            required autocomplete="off">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                                            name="password" id="password"
                                            placeholder="Password *" required autocomplete="off">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center justify-content-start">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}"
                                                class="vs-btn--style2 wow animate__fadeInUp float-end"
                                                data-wow-delay="0.95s">Forgot
                                                Password?</a>
                                        @endif
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <input class="form-check-input wow animate__fadeInUp me-2" type="checkbox"
                                            name="remember" id="remember" checked data-wow-delay="0.95s"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label wow animate__fadeInUp" for="remember"
                                            data-wow-delay="0.95s">Remember me</label>
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <button type="submit" class="vs-btn vs-btn-square wow animate__fadeInUp w-100"
                                            data-wow-delay="0.45s">Login</button>
                                    </div>
                                </div>
                            </form>

                            <div class="row justify-content-center mt-3 px-0">
                                <div class="col-12">
                                    <a href="#" class="vs-btn vs-btn-outline wow animate__fadeInUp w-100"
                                        data-wow-delay="0.95s">
                                        <i class="fa-brands fa-google me-2"></i>Login with Google
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
