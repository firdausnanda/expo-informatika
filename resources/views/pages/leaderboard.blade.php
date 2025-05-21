@extends('layouts.landing.main')

@section('content')
<section class="section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="section-title">Leaderboard Project</h2>
                <p class="text-muted">Daftar project dengan jumlah like terbanyak</p>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
            @forelse ($projects as $project)
                <div class="col d-flex">
                    <div class="card shadow-sm flex-fill">
                        <div class="card-img-top overflow-hidden" style="height: 210px;">
                            <img src="{{ $project->gambar != null && count($project->gambar) > 0 ? $project->gambar[0]->url : asset('landing/img/no-image.jpg') }}"
                                class="w-100 h-100 object-fit-cover p-2" alt="{{ $project->nama }}">
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate" title="{{ $project->nama }}">{{ $project->nama }}</h5>
                            <div class="card-text mb-2 flex-grow-1">
                                <p class="text-muted line-clamp-3">{{ $project->deskripsi }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">
                                    <i class="bi bi-hand-thumbs-up-fill"></i> {{ $project->likes_count }} Likes
                                </span>
                                <a href="{{ route('detail', $project->id) }}"
                                    class="btn btn-sm btn-link text-decoration-none">
                                    Detail <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Belum ada project yang di-like
                    </div>
                </div>
            @endforelse
        </div>

        <div class="row mt-4">
            <div class="col-12">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</section>
@endsection 