@extends('layouts.landing.main')

@section('content')
    <div class="container py-5">
        <!-- Background text -->
        <h1 class="bg-text" aria-hidden="true">About Us</h1>

        <!-- Hero Section -->
        <div class="row align-items-center mb-5" data-aos="fade-up">
            <div class="col-lg-6">
                <h2 class="display-4 fw-bold mb-4">Where Code Meets Creativity</h2>
                <p class="lead text-muted mb-4">A Showcase of Academic Excellence in Informatics ITSK Soepraoen.</p>
                <div class="d-flex gap-3">
                    <div class="stat-item">
                        <h3 class="fw-bold text-primary mb-0">{{ $student }}</h3>
                        <p class="text-muted mb-0">Active Students</p>
                    </div>
                    <div class="stat-item">
                        <h3 class="fw-bold text-primary mb-0">{{ $project }}</h3>
                        <p class="text-muted mb-0">Projects</p>
                    </div>
                    <div class="stat-item">
                        <h3 class="fw-bold text-primary mb-0">97%</h3>
                        <p class="text-muted mb-0">Satisfaction</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('landing/img/hero-2.png') }}" alt="Students collaborating"
                    class="img-fluid rounded-3 shadow">
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="row g-4 mb-5">
            <div class="col-md-6" data-aos="fade-right">
                <div class="mission-card">
                    <div class="icon-wrapper mb-4">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="mb-3">Our Mission</h3>
                    <p class="text-muted">Menjadi platform terdepan dalam mendokumentasikan, memamerkan, dan menginspirasi
                        pengembangan solusi teknologi berbasis pembelajaran akademik, serta memperkuat identitas kompetensi
                        mahasiswa informatika melalui karya nyata yang berdampak.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <div class="vision-card">
                    <div class="icon-wrapper mb-4">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="mb-3">Our Vision</h3>
                    <p class="text-muted">Memotivasi mahasiswa untuk menghasilkan karya berkualitas tinggi dengan standar
                        industri, melalui apresiasi publik, umpan balik terbuka, dan pengakuan institusional.</p>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        {{-- <div class="team-section mb-5">
        <h2 class="text-center mb-5" data-aos="fade-up">Meet Our Team</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="team-card">
                    <img src="{{ asset('landing/images/team-1.jpg') }}" alt="Team Member" class="team-img">
                    <div class="team-info">
                        <h4 class="mb-1">John Doe</h4>
                        <p class="text-muted mb-3">Founder & CEO</p>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="team-card">
                    <img src="{{ asset('landing/images/team-2.jpg') }}" alt="Team Member" class="team-img">
                    <div class="team-info">
                        <h4 class="mb-1">Jane Smith</h4>
                        <p class="text-muted mb-3">Head of Education</p>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="team-card">
                    <img src="{{ asset('landing/images/team-3.jpg') }}" alt="Team Member" class="team-img">
                    <div class="team-info">
                        <h4 class="mb-1">Mike Johnson</h4>
                        <p class="text-muted mb-3">Technical Lead</p>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div> --}}

        <!-- Values Section -->
        <div class="values-section">
            <h2 class="text-center mb-5" data-aos="fade-up">Our Core Values</h2>
            <div class="row g-4">
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="value-card">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h4>Show Off</h4>
                        <p class="text-muted mb-0">Mendokumentasikan dan Memamerkan</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="value-card">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Collaboration</h4>
                        <p class="text-muted mb-0">Memperkuat Kolaborasi dan Relevansi</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="value-card">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h4>Creativity</h4>
                        <p class="text-muted mb-0">Mendorong Budaya Berkarya</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="value-card">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-map-pin"></i>
                        </div>
                        <h4>Good Trace</h4>
                        <p class="text-muted mb-0">Membangun Jejak Digital Kompetensi</p>
                    </div>
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

        .stat-item {
            padding: 1rem;
            background: #f8fafc;
            border-radius: 0.5rem;
            text-align: center;
            min-width: 120px;
        }

        .mission-card,
        .vision-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 1px 4px rgb(0 0 0 / 0.1);
            height: 100%;
        }

        .icon-wrapper {
            width: 48px;
            height: 48px;
            background: #f8fafc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            font-size: 1.25rem;
        }

        .team-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 1px 4px rgb(0 0 0 / 0.1);
            transition: transform 0.2s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
        }

        .team-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .team-info {
            padding: 1.5rem;
            text-align: center;
        }

        .social-links {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .social-link {
            width: 32px;
            height: 32px;
            background: #f8fafc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .social-link:hover {
            background: #2563eb;
            color: white;
        }

        .value-card {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 1px 4px rgb(0 0 0 / 0.1);
            text-align: center;
            height: 100%;
            transition: transform 0.2s ease;
        }

        .value-card:hover {
            transform: translateY(-5px);
        }

        .value-card h4 {
            margin-bottom: 0.5rem;
            color: #1e293b;
        }

        .value-card p {
            font-size: 0.9rem;
        }
    </style>
@endpush
