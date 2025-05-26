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
                <p class="text-muted mb-4">Feel free to contact us for any questions or inquiries. We'll get back to you as soon as possible.</p>
                
                <div class="info-item mb-4">
                    <div class="icon-wrapper">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-content">
                        <h5>Our Location</h5>
                        <p class="mb-0">123 University Street, City, Country</p>
                    </div>
                </div>

                <div class="info-item mb-4">
                    <div class="icon-wrapper">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h5>Email Us</h5>
                        <p class="mb-0">contact@example.com</p>
                    </div>
                </div>

                <div class="info-item mb-4">
                    <div class="icon-wrapper">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="info-content">
                        <h5>Call Us</h5>
                        <p class="mb-0">+1 234 567 890</p>
                    </div>
                </div>

                <div class="social-links mt-4">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-8">
            <div class="contact-form" data-aos="fade-left">
                <h2 class="mb-4">Send us a Message</h2>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="map-section mt-5" data-aos="fade-up">
        <div class="ratio ratio-21x9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.60912427769!2d106.70271195773596!3d-6.229386895477475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta!5e0!3m2!1sen!2sid!4v1647881234567!5m2!1sen!2sid" 
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>
@endsection

@push('styles')
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

    .social-links {
        display: flex;
        gap: 1rem;
    }

    .social-link {
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

    .social-link:hover {
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