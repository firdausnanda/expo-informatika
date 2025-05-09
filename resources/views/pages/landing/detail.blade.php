@extends('layouts.landing.main')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $project->matakuliah->nama_matakuliah }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current">{{ $project->matakuliah->nama_matakuliah }}</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-5">

                <section id="slider" class="slider section dark-background">

                    <div class="container" data-aos="fade-up" data-aos-delay="100">

                        <div class="swiper init-swiper">

                            <script type="application/json" class="swiper-config">
                                {
                                    "loop": true,
                                    "speed": 600,
                                    "autoplay": {
                                        "delay": 5000
                                    },
                                    "slidesPerView": "auto",
                                    "centeredSlides": true,
                                    "pagination": {
                                        "el": ".swiper-pagination",
                                        "type": "bullets",
                                        "clickable": true
                                    },
                                    "navigation": {
                                        "nextEl": ".swiper-button-next",
                                        "prevEl": ".swiper-button-prev"
                                    }
                                }
                            </script>
                            <div class="swiper-wrapper">
                                @forelse ($project->gambar as $g)
                                    <div class="swiper-slide" style="background-image: url('{{ $g->gambar }}');">
                                    </div>

                                @empty
                                    <div class="swiper-slide"
                                        style="background-image: url('{{ asset('landing/img/no-image.jpg') }}');">
                                    </div>
                                @endforelse
                            </div>

                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>

                            <div class="swiper-pagination"></div>
                        </div>

                    </div>

                </section>
            </div>

            <div class="col-lg-7">

                <section id="blog-details" class="blog-details section">
                    <div class="container">

                        <article class="article">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h2 class="title my-0">{{ $project->nama }}</h2>
                                </div>
                                <div class="col-lg-2 d-flex justify-content-end">
                                    @if ($liked == false)
                                        <button class="btn btn-sm btn-outline-secondary rounded-pill btn-like"
                                            data-project-id="{{ $project->id }}">
                                            <i class="bi bi-hand-thumbs-up"></i> Like
                                        </button>
                                    @else
                                        <button class="btn btn-sm btn-danger rounded-pill btn-like"
                                            data-project-id="{{ $project->id }}">
                                            <i class="bi bi-hand-thumbs-up-fill"></i> Liked
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                            href="#">{{ $project->mahasiswa[0]->nama }}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href="#"><time>{{ Carbon\Carbon::parse($project->created_at)->format('d F Y') }}</time></a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-hand-thumbs-up"></i> <a
                                            href="#">{{ $project->likers->count() }} Likes</a></li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content mb-4">

                                <h3>Deskripsi</h3>

                                <p>
                                    {!! $project->deskripsi !!}
                                </p>

                                <h3>Team</h3>

                                <ul>
                                    @foreach ($project->mahasiswa as $m)
                                        <li>{{ $m->nama }}</li>
                                    @endforeach
                                </ul>

                                <h3>Link</h3>

                                <a href="{{ $project->link }}" target="_blank">
                                    <i class="bi bi-link"></i> {{ $project->link }}
                                </a>

                            </div><!-- End post content -->

                            <div class="meta-bottom">
                                <i class="bi bi-folder"></i>
                                <ul class="cats">
                                    <li><a href="#">{{ $project->matakuliah->nama_matakuliah }}</a></li>
                                </ul>

                                <i class="bi bi-tags"></i>
                                <ul class="tags">
                                    @foreach ($project->kategori as $k)
                                        <li><a href="#">{{ $k->nama }}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- End meta bottom -->

                        </article>

                    </div>
                </section><!-- /Blog Details Section -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-like').click(function() {
                @if (Auth::check())

                    let textTitle = $(this).text() == 'Like' ? 'Anda menyukai proyek ini?' :
                        'Anda tidak menyukai proyek ini?';
                    let textConfirmButtonText = $(this).text() == 'Like' ?
                        '<i class="bi bi-hand-thumbs-up"></i> Suka' :
                        '<i class="bi bi-hand-thumbs-down"></i> Tidak Suka';
                    let textConfirmButtonColor = $(this).text() == 'Like' ? '#dc3545' : '#dc3545';

                    Swal.fire({
                        title: textTitle,
                        text: 'Data anda akan disimpan',
                        icon: 'question',
                        confirmButtonText: textConfirmButtonText,
                        confirmButtonColor: textConfirmButtonColor,
                        showCancelButton: true,
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('user.like') }}",
                                type: "POST",
                                data: {
                                    id: $(this).data('project-id'),
                                },
                                beforeSend: function() {
                                    $(this).html(
                                        '<i class="bi bi-hand-thumbs-up-fill"></i> Loading...'
                                    );
                                },
                                success: function(response) {
                                    if (response.data.liked) {
                                        var button = $(
                                            'button[data-project-id="' +
                                            response
                                            .data.project.id + '"]');
                                        button.html(
                                            '<i class="bi bi-hand-thumbs-up-fill"></i> Liked'
                                        );
                                        button.removeClass(
                                                'btn-outline-secondary')
                                            .addClass(
                                                'btn-danger');
                                        button.attr('data-liked', 'true');
                                    } else {
                                        var button = $(
                                            'button[data-project-id="' +
                                            response
                                            .data.project.id + '"]');
                                        button.html(
                                            '<i class="bi bi-hand-thumbs-up"></i> Like'
                                        );
                                        button.removeClass(
                                                'btn-danger')
                                            .addClass(
                                                'btn-outline-secondary');
                                        button.attr('data-liked', 'false');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire({
                                        title: 'Oops...!',
                                        text: 'Proyek gagal disukai',
                                        icon: 'error',
                                    });
                                }
                            });
                        }
                    });
                @else
                    Swal.fire({
                        title: 'Oops...!',
                        text: 'Login terlebih dulu untuk melakukan like',
                        icon: 'error',
                        confirmButtonText: '<i class="bi bi-box-arrow-right me-2"></i>Login Sekarang',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('login') }}";
                        }
                    });
                    return false;
                @endif
            });
        });
    </script>
@endsection
