@extends('layouts.landing.main')

@section('content')
    <section id="culture-category" class="culture-category section">

        @forelse ($structuredData as $k => $i)
            <!-- Section Title -->
            <div class="container section-title mb-4" data-aos="fade-up">
                <div class="section-title-container d-flex align-items-center justify-content-between">
                    {{-- <h2>Announcement : ISO #1 2025</h2> --}}
                    <h2>Announcement : #{{ $k + 1 }} {{ $i['year'] }}</h2>
                </div>
            </div><!-- End Section Title -->

            @foreach ($i['matakuliahs'] as $j => $m)
                <div class="container mb-4" data-aos="fade-up" data-aos-delay="100">

                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="text-secondary">
                                Matakuliah :
                                <span class="fw-bold text-dark">
                                    {{ $m['nama'] }}
                                </span>
                            </h5>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                            <button class="btn btn-link text-decoration-none">Selengkapnya >></button>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        @foreach ($m['projects'] as $p)
                            <div class="col d-flex">
                                <div class="card shadow-sm flex-fill">
                                    <div class="card-img-top overflow-hidden" style="height: 210px;">
                                        <img src="{{ $p['gambar'] != null ? $p['gambar'][0]['url'] : asset('landing/img/no-image.jpg') }}"
                                            class="w-100 h-100 object-fit-cover p-2" alt="{{ $p['nama'] }}">
                                    </div>

                                    <!-- Body card dengan flexbox -->
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-truncate" title="{{ $p['nama'] }}">{{ $p['nama'] }}
                                        </h5>
                                        <div class="card-text mb-2 flex-grow-1">
                                            <p class="text-muted line-clamp-3">{{ $p['deskripsi'] }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button class="btn btn-sm btn-outline-danger rounded-pill btn-like"
                                                data-project-id="{{ $p['id'] }}">
                                                <i class="bi bi-hand-thumbs-up"></i> Like
                                            </button>
                                            <a href="#" class="btn btn-sm btn-link text-decoration-none">
                                                Detail <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endforeach

        @empty

            <!-- Section Title -->
            <div class="container section-title mb-4" data-aos="fade-up">
                <div class="section-title-container d-flex align-items-center justify-content-between">
                    <h2>Announcement : -</h2>
                </div>
            </div>

            <div class="container mb-4" style="height: 300px;" data-aos="fade-up" data-aos-delay="100">
                <h5 class="text-secondary">
                    No Data
                </h5>
            </div>
        @endforelse

    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-like').click(function() {
                @if (Auth::check())
                    Swal.fire({
                        title: 'Anda menyukai proyek ini?',
                        text: 'Data anda akan disimpan',
                        icon: 'question',
                        confirmButtonText: '<i class="bi bi-hand-thumbs-up"></i> Suka',
                        confirmButtonColor: '#dc3545',
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
                                    $(this).html('<i class="bi bi-hand-thumbs-up-fill"></i> Loading...');
                                },
                                success: function(response) {
                                    console.log(response);
                                    console.log($(this));
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
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
