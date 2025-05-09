@extends('layouts.landing.main')

@section('content')
    <section>
        <div class="container">
            <h3 class="text-center mb-5">Login</h3>
            <div class="row justify-content-center">
                <div class="col-5">
                    <form action="{{ route('login') }}" method="post" class="form-style2 pt-30 wow animate__fadeInUp"
                        data-wow-delay="0.95s">
                        @csrf
                        <div class="row gx-2 g-2 row-gap-2 justify-content-center">
                            <div class="col-md-12 form-group">
                                <input class="form-control rounded-pill @error('email') is-invalid @enderror" type="email"
                                    name="email" id="email" value="{{ old('email') }}" placeholder="Email *" required
                                    autocomplete="off">
                                @error('email')
                                    <span class="invalid-feedback text-start" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input class="form-control rounded-pill @error('password') is-invalid @enderror"
                                    type="password" name="password" id="password" placeholder="Password *" required
                                    autocomplete="off">
                                @error('password')
                                    <span class="invalid-feedback text-start" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-start">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="vs-btn--style2 wow animate__fadeInUp float-end" data-wow-delay="0.95s">Forgot
                                        Password?</a>
                                @endif
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <input class="form-check-input wow animate__fadeInUp me-2" type="checkbox" name="remember"
                                    id="remember" checked data-wow-delay="0.95s" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label wow animate__fadeInUp" for="remember"
                                    data-wow-delay="0.95s">Remember me</label>
                            </div>
                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                            <div class="col-12">
                                <a href="{{ route('google.login') }}"
                                    class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-google"></i>
                                    Login with Google
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection
