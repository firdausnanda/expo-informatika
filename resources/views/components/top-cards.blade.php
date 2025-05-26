<div class="top-cards" role="list">
    @forelse ($result->take(3) as $i)
        <article class="card-top" role="listitem" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 2 }}00">
            <div class="rank">
                {{ $loop->iteration }}<sup>{{ $loop->iteration == 1 ? 'st' : ($loop->iteration == 2 ? 'nd' : ($loop->iteration == 3 ? 'rd' : 'th')) }}</sup>
            </div>
            <img src="https://storage.googleapis.com/a1aa/image/b42174d2-c232-4d8d-3b70-1d145844d4dc.jpg"
                alt="Avatar of Roger Korsgaard with green face and spiky hair" class="avatar" />
            <div class="score-badge"><i class="fas fa-heart"></i> {{ $i->likers_count }} Like</div>
            <h3>
                {{ Str::limit($i->nama, 20) }}
                <svg fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                    viewBox="0 0 16 16" width="16" height="16">
                    <circle cx="8" cy="8" r="7" stroke="#2563EB" stroke-width="2"></circle>
                    <path d="M5.5 8.5l2 2 4-4" stroke="#2563EB" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"></path>
                </svg>
            </h3>
            <p class="role">{{ Str::limit($i->matakuliah->nama_matakuliah, 20) }}</p>
            <div class="stats" aria-label="Alerts, Trades, Average Gain">
                <div>
                    <div>{{ $i->views_count }}</div>
                    <div>View</div>
                </div>
                <div>
                    <div>{{ $i->likers_count }}</div>
                    <div>Like</div>
                </div>
                <div>
                    <div>{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('D MMMM Y') }}</div>
                    <div>Created At</div>
                </div>
            </div>
            <a href="{{ route('detail', $i->id) }}" class="w-100">
                <button class="profile-btn" type="button">Detail</button>
            </a>
        </article>
    @empty
        <div class="col-12 text-center py-4">
            <i class="fas fa-box-open fa-3x text-muted"></i>
            <p class="mt-3">Tidak ada data ditemukan</p>
        </div>
    @endforelse
</div>
