@extends('layouts.landing.main')

@section('content')
    <div class="container py-5">
        <!-- Background text -->
        <h1 class="bg-text" aria-hidden="true">Contact</h1>

        <div class="row g-4">
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="contact-info" data-aos="fade-right">
                    <h2 class="mb-4">Get in Touch</h2>
                    <p class="text-muted mb-4">Feel free to contact us for any questions or inquiries. We'll get back to you
                        as soon as possible.</p>

                    <div class="social-medias mb-4">
                        <a class="social-media" href="https://www.threads.com/@informatikasoepraoen" target="_blank"><i
                                class="bi bi-threads"></i></a>
                        <a class="social-media" href="https://www.tiktok.com/@informatikasoepraoen" target="_blank"><i
                                class="bi bi-tiktok"></i></a>
                        <a class="social-media" href="https://www.instagram.com/informatikasoepraoen" target="_blank"><i
                                class="bi bi-instagram"></i></a>
                        <a class="social-media" href="https://id.linkedin.com/in/informatika-itsk-soepraoen-879436286"
                            target="_blank"><i class="bi bi-linkedin"></i></a>
                        <a class="social-media" href="https://www.youtube.com/@InformatikaSoepraoen" target="_blank"><i
                                class="bi bi-youtube"></i></a>
                    </div>

                    <div class="info-item mb-4">
                        <div class="icon-wrapper">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h5>Email Us</h5>
                            <p class="mb-0">informatika@itsk-soepraoen.ac.id</p>
                        </div>
                    </div>

                    <div class="info-item mt-4">
                        <div class="icon-wrapper">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <p class="mb-0">Jl. Majapahit No.1 Kiduldalem
                                Klojen, Kota Malang</p>
                        </div>
                    </div>

                    <div class="mt-3">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.1959009289744!2d112.632874!3d-7.978693300000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6290031cb0253%3A0x759b8a3f310bdde5!2sKampus%203%20Institut%20Teknologi%20Sains%20dan%20Kesehatan%20(ITSK)%20dr.%20Soepraoen!5e0!3m2!1sid!2sid!4v1766369597039!5m2!1sid!2sid"
                            width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" class="w-100"></iframe>
                    </div>

                    <div class="info-item mt-5">
                        <div class="icon-wrapper">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <p class="mb-0">Jl. S. Supriadi No. 22 Sukun Kec. Sukun Kota Malang</p>
                        </div>
                    </div>

                    <div class="mt-3">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d493.8898609639926!2d112.6187658!3d-7.986657!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ccfc982d91%3A0x3c8c9717aac59aa8!2sProgram%20Studi%20Sarjana%20Informatika%20ITSK%20RS%20dr%20Soepraoen!5e0!3m2!1sid!2sid!4v1766369637957!5m2!1sid!2sid"
                            width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" class="w-100"></iframe>
                    </div>


                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-form" data-aos="fade-left">
                    <h2 class="mb-4">Send us a Message</h2>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Your Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Your Email <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="subject" class="form-label">Subject <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                        id="subject" name="subject">
                                    @error('subject')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message" class="form-label">Message <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5"></textarea>
                                    @error('message')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-outline-secondary">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .bg-text {
            font-weight: 800;
            font-size: 6rem;
            color: #d1d5db;
            opacity: 0.2;
            user-select: none;
            position: absolute;
            top: 110px;
            left: 50%;
            transform: translateX(-50%);
            pointer-events: none;
            font-feature-settings: 'liga' off;
            display: none;
            white-space: nowrap;
            z-index: 0;
        }

        @media (min-width: 576px) {
            .bg-text {
                display: block;
            }
        }

        .contact-info {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 1px 4px rgb(0 0 0 / 0.1);
            height: 100%;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .icon-wrapper {
            width: 40px;
            height: 40px;
            background: #f8fafc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            flex-shrink: 0;
        }

        .info-content h5 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
            color: #1e293b;
        }

        .info-content p {
            color: #64748b;
            font-size: 0.9rem;
        }

        .social-medias {
            display: flex;
            gap: .5rem;
            justify-content: center;
        }

        .social-media {
            width: 36px;
            height: 36px;
            background: #f8fafc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .social-media:hover {
            background: #2563eb;
            color: white;
        }

        .contact-form {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 1px 4px rgb(0 0 0 / 0.1);
        }

        .form-label {
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn-primary {
            background: #2563eb;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .map-section {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 1px 4px rgb(0 0 0 / 0.1);
        }
    </style>
@endpush
