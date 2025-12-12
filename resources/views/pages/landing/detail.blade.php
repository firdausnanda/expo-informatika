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
                                    "loop": {{ count($project->gambar) >= 3 ? 'true' : 'false' }},
                                    "speed": 600,
                                    "autoplay": {
                                        "delay": 5000
                                    },
                                    "slidesPerView": 1,
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
                                    <div class="swiper-slide"
                                        style="background-image: url('{{ Storage::url($g->gambar) }}');">
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
                                <div class="col-lg-8">
                                    <h2 class="title my-0">{{ $project->nama }}</h2>
                                </div>
                                <div class="col-lg-4 d-flex justify-content-end">
                                    @if ($liked == false)
                                        <button class="btn btn-sm btn-outline-secondary rounded-pill btn-like"
                                            data-project-id="{{ $project->id }}">
                                            <span class="like-text">
                                                <i class="bi bi-hand-thumbs-up"></i> Like
                                            </span>
                                            <span class="spinner-border spinner-border-sm ms-2 d-none"
                                                role="status"></span>
                                        </button>
                                    @else
                                        <button class="btn btn-sm btn-danger rounded-pill btn-like"
                                            data-project-id="{{ $project->id }}">
                                            <span class="like-text">
                                                <i class="bi bi-hand-thumbs-up-fill"></i> Liked
                                            </span>
                                            <span class="spinner-border spinner-border-sm ms-2 d-none"
                                                role="status"></span>
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

                let btn = $(this);
                let projectId = btn.data('project-id');

                let text = btn.find('.like-text');
                let spinner = btn.find('.spinner-border');

                // disable tombol + tampilkan spinner
                btn.prop('disabled', true);
                spinner.removeClass('d-none');
                text.addClass('opacity-50').text('Memproses...');

                @if (Auth::check())

                    $.ajax({
                        url: "{{ route('user.like') }}",
                        type: "POST",
                        data: {
                            id: $(this).data('project-id'),
                        },
                        success: function(response) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1800,
                                timerProgressBar: true,
                                padding: '10px 16px',
                                customClass: {
                                    popup: 'custom-toast',
                                    title: 'custom-toast-title',
                                    icon: 'custom-toast-icon',
                                    timerProgressBar: 'custom-progress-bar'
                                }
                            });

                            Toast.fire({
                                icon: 'success',
                                title: response.data.liked ? 'Berhasil Like!' :
                                    'Berhasil Un-Like!'
                            });


                            // UPDATE BUTTON (gunakan struktur tombol yang aman)
                            let button = $('button[data-project-id="' + response.data.project
                                .id + '"]');
                            let text = button.find('.like-text');
                            let spinner = button.find('.spinner-border');

                            // Sembunyikan spinner & aktifkan tombol kembali
                            spinner.addClass('d-none');
                            button.prop('disabled', false);
                            text.removeClass('opacity-50');

                            // PERBARUI UI SESUAI STATUS
                            if (response.data.liked) {
                                button.removeClass('btn-outline-secondary').addClass(
                                    'btn-danger');
                                text.html('<i class="bi bi-hand-thumbs-up-fill"></i> Liked');
                                button.attr('data-liked', 'true');
                            } else {
                                button.removeClass('btn-danger').addClass(
                                    'btn-outline-secondary');
                                text.html('<i class="bi bi-hand-thumbs-up"></i> Like');
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
