@extends('layouts.landing.main')

@section('content')
    <div class="container py-5">
        <!-- Filter Tabs -->
        <div class="filter-tabs" role="tablist" aria-label="Filter options">
            <button type="button" class="active" aria-pressed="true">All Time</button>
            <a href="{{ route('leaderboard.monthly') }}">
                <button type="button" aria-pressed="false">Monthly</button>
            </a>
        </div>

        <!-- Background text -->
        <h1 class="bg-text" aria-hidden="true">Champions</h1>

        <!-- Top 3 Cards -->
        <div class="top-cards" role="list">
            @foreach ($result->take(3) as $i)
                <!-- 1st -->
                <article class="card-top" role="listitem" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 2 }}00">
                    <div class="rank">
                        {{ $loop->iteration }}<sup>{{ $loop->iteration == 1 ? 'st' : ($loop->iteration == 2 ? 'nd' : ($loop->iteration == 3 ? 'rd' : 'th')) }}</sup>
                    </div>
                    <img src="{{ $loop->iteration == 1 ? asset('landing/img/leaderboard/1.png') : ($loop->iteration == 2 ? asset('landing/img/leaderboard/2.png') : asset('landing/img/leaderboard/3.png')) }}"
                        alt="avatar {{ $loop->iteration }}" class="avatar" />
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
                            <div><i class="fas fa-eye"></i></div>
                        </div>
                        <div>
                            <div>{{ $i->likers_count }}</div>
                            <div><i class="fas fa-thumbs-up"></i></div>
                        </div>
                        <div>
                            <div>{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('D/MM/Y') }}</div>
                            <div><i class="fas fa-calendar-alt"></i></div>
                        </div>
                    </div>
                    <a href="{{ route('detail', $i->id) }}" class="w-100">
                        <button class="profile-btn" type="button">Detail</button>
                    </a>
                </article>
            @endforeach
        </div>

        <div class="card mt-5 border-0">
            <div class="card-body">
                <table class="table table-bordered" id="project-table">
                    <thead>
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Project</th>
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="{{ asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            z-index: 20;
            position: relative;
        }

        .filter-tabs button {
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #475569;
            padding: 0.25rem 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .filter-tabs button.active {
            background: white;
            color: #1f2937;
            border-color: #cbd5e1;
            box-shadow: 0 1px 2px rgb(0 0 0 / 0.05);
        }

        .filter-tabs button:hover:not(.active) {
            background: #f1f5f9;
        }

        h1.bg-text {
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
            h1.bg-text {
                display: block;
            }
        }

        .top-cards {
            display: flex;
            gap: 1.5rem;
            max-width: 72rem;
            margin: 0 auto;
            position: relative;
            z-index: 10;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card-top {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 4px rgb(0 0 0 / 0.1);
            width: 18rem;
            padding: 1.5rem 1.5rem 2rem;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .card-top .rank {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            font-weight: 800;
            font-size: 3rem;
            color: #cbd5e1;
            font-feature-settings: 'ordn' on;
            user-select: none;
        }

        .card-top .rank sup {
            font-weight: 600;
            font-size: 2rem;
            color: #243a55;
        }

        .card-top:nth-child(1) {
            background: linear-gradient(135deg, #eaf7f7 0%, #fef9d7 100%);
        }

        .card-top:nth-child(1) .rank {
            color: #243a55;
        }

        .card-top:nth-child(2) {
            background: linear-gradient(135deg, #f7f0ff 0%, #d7f9f9 100%);
        }

        .card-top:nth-child(2) .rank {
            color: #243a55;
        }

        .card-top:nth-child(3) {
            background: linear-gradient(135deg, #f7f9d7 0%, #f9e7d7 100%);
        }

        .card-top:nth-child(3) .rank {
            color: #243a55;
        }

        .card-top img.avatar {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            margin-bottom: 1rem;
            object-fit: cover;
        }

        .score-badge {
            background: #1e293b;
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 0.375rem;
            padding: 0.25rem 0.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-feature-settings: 'tnum';
            margin-bottom: 1rem;
            justify-content: center;
            width: fit-content;
        }

        .score-badge i {
            font-size: 0.75rem;
        }

        .card-top h3 {
            font-weight: 600;
            font-size: 1.15rem;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            justify-content: center;
            margin-bottom: 0.25rem;
        }

        .card-top h3 svg {
            width: 16px;
            height: 16px;
            stroke: #2563eb;
            stroke-width: 2;
        }

        .card-top p.role {
            font-size: 0.9rem;
            font-weight: 600;
            color: #a3bffa;
            margin-bottom: 1rem;
        }

        .card-top .stats {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-weight: 600;
            font-size: 0.75rem;
            color: #475569;
            text-align: center;
            margin-bottom: 1rem;
        }

        .card-top .stats>div {
            flex: 1;
        }

        .card-top .stats>div>div:first-child {
            color: #1e293b;
            font-weight: 700;
        }

        .card-top .stats>div>div:last-child {
            font-weight: 400;
            font-size: 0.8rem;
            color: #94a3b8;
        }

        .card-top button.profile-btn {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background: white;
            font-size: 0.9rem;
            font-weight: 600;
            color: #475569;
            padding: 0.25rem 0;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .card-top button.profile-btn:hover {
            background: #f1f5f9;
        }

        /* Stats cards below top cards */
        .stats-cards {
            max-width: 72rem;
            margin: 3rem auto 0;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            z-index: 10;
            position: relative;
        }

        .stats-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 4px rgb(0 0 0 / 0.1);
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-width: 16rem;
            max-width: 18rem;
        }

        .stats-card img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .stats-card .text-group {
            font-size: 0.75rem;
            color: #475569;
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
        }

        .stats-card .text-group .label {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-weight: 600;
            color: #475569;
        }

        .stats-card .text-group .label i {
            font-size: 1rem;
            color: inherit;
        }

        .stats-card .text-group .label .subtext {
            font-weight: 400;
            font-size: 0.625rem;
            color: #94a3b8;
        }

        .stats-card .text-group .name {
            font-weight: 600;
            font-size: 0.875rem;
            color: #1e293b;
        }

        .stats-card .score {
            margin-left: auto;
            font-weight: 800;
            font-size: 1.5rem;
            color: #1e293b;
            font-feature-settings: 'tnum';
            flex-shrink: 0;
        }

        .dataTables_filter input {
            border: none;
            border-bottom: 2px solid #ccc;
            font-size: 14px;
            width: 200px;
        }

        .dataTables_filter {
            margin-bottom: 20px;
        }

        div.dataTables_wrapper div.dataTables_filter input:focus {
            box-shadow: 4px -1px 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
            outline: 0;
        }

        #project-table {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 10px !important;
        }
    </style>
@endpush

@section('script')
    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('landing/vendor/moment-js/moment-with-locales.js') }}"></script>
    <script>
        $(document).ready(function() {

            // Init Datatable
            $('#project-table').DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                ordering: false,
                info: false,
                destroy: true,
                language: {
                    emptyTable: "Data tidak ditemukan"
                },
                ajax: {
                    url: "{{ route('leaderboard') }}",
                    type: "GET",
                    data: function(d) {
                        d.table = true;
                    },
                    dataType: "JSON",
                    dataSrc: function(json) {
                        return json.data.slice(3);
                    }
                },
                columns: [{
                        data: 'no',
                        width: '10%',
                        className: 'text-center fw-normal text-muted',
                        render: function(data, type, row, meta) {
                            let rank = meta.row + 4
                            let datas = `<div class='text-secondary'>${rank}</div>`
                            return datas;
                        }
                    },
                    {
                        className: 'text-center fw-normal text-muted',
                        data: 'nama',
                        width: '60%',
                        render: function(data, type, row, meta) {
                            let matakuliah = row.matakuliah.nama_matakuliah
                            let datas = `<div class='text-start text-dark fw-bold'>${data}</div>
                                        <div class='text-start text-secondary'>${matakuliah}</div>`

                            return datas;
                        }
                    },
                    {
                        className: 'text-center fw-normal text-muted',
                        data: 'status',
                        width: '30%',
                        render: function(data, type, row, meta) {
                            let date = moment(row.created_at).locale('id').format('ll')
                            let url = '{{ route('detail', ['id' => ':id']) }}';
                            let link = url.replace(':id', row.id);

                            let datas = `<div class="row g-3 justify-items-center align-items-center" style="font-size:12px">
                                            <div class="col-lg-4">
                                                <div class="score-badge mb-0"><i class="fas fa-heart"></i> ${row.likers_count} Like</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-start text-dark fw-bold">
                                                    <i class="far fa-clock text-black-50 me-2"></i>${date}
                                                </div>
                                                <div class="text-start text-dark fw-bold">
                                                    <i class="far fa-eye text-black-50 me-2"></i>${row.views_count}
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <a href="${link}" class="btn btn-link text-decoration-none" style="font-size:13px">Detail<i class="fas fa-chevron-right ms-2"></i></a>
                                            </div>
                                        </div>`
                            return datas;
                        }
                    }
                ]
            });

            // Tampilkan loading indicator
            $('.top-cards').html(
                '<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');

            $.ajax({
                url: "{{ route('leaderboard') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.meta.code ===
                        200) {
                        // Sesuaikan dengan kode success ResponseFormatter
                        $('.top-cards').html(response.data.html);

                        // Re-init AOS animasi
                        if (typeof AOS !== 'undefined') {
                            AOS.refresh();
                        }
                    } else {
                        showError(response.message);
                    }
                },
                error: function(xhr) {
                    showError(xhr.responseJSON?.message || 'Terjadi kesalahan');
                }
            });

            // Show Error
            function showError(message) {
                $('.top-cards').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> ${message}
                    </div>
                `);
            }

        });
    </script>
@endsection
