@extends('layouts.landing.main')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="mb-0"><i class="fas fa-trophy me-2"></i>Leaderboard</h2>
                            <div class="d-flex gap-2">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="filterDropdown"
                                        data-bs-toggle="dropdown">
                                        <i class="fas fa-filter me-1"></i> Filter Periode
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item filter-period" href="#" data-period="week">Minggu
                                                Ini</a></li>
                                        <li><a class="dropdown-item filter-period" href="#" data-period="month">Bulan
                                                Ini</a></li>
                                        <li><a class="dropdown-item filter-period" href="#" data-period="all">Semua
                                                Waktu</a></li>
                                    </ul>
                                </div>
                                <button id="exportExcel" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-excel me-1"></i> Excel
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="leaderboardTable" class="table table-hover align-middle mb-0 w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50px" class="text-center">Rank</th>
                                        <th>Nama</th>
                                        <th class="text-center">Fakultas</th>
                                        <th class="text-center">Poin</th>
                                        <th class="text-center">Progress</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan diisi oleh DataTables -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Badge Pencapaian -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="mb-3"><i class="fas fa-award text-warning me-2"></i>Pencapaian</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3">
                                <i class="fas fa-medal me-1"></i> Top 1
                            </span>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary py-2 px-3">
                                <i class="fas fa-medal me-1"></i> Top 3
                            </span>
                            <span class="badge bg-success bg-opacity-10 text-success py-2 px-3">
                                <i class="fas fa-arrow-up me-1"></i> Naik Peringkat
                            </span>
                            <span class="badge bg-danger bg-opacity-10 text-danger py-2 px-3">
                                <i class="fas fa-fire me-1"></i> Streak Mingguan
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <style>
        .card {
            border: none;
            overflow: hidden;
        }

        .card-header {
            border-bottom: none;
        }

        #leaderboardTable th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .progress {
            border-radius: 10px;
        }

        .badge.rounded-circle {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 5px;
            border: 1px solid #dee2e6;
            padding: 5px 10px;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
    </style>
@endpush

@section('script')
    <!-- DataTables & Extensions -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $('#leaderboardTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('leaderboard') }}',
                    data: function(d) {
                        d.period = $('#filterDropdown').data('period') || 'all';
                    }
                },
                columns: [{
                        data: 'rank',
                        className: 'text-center',
                        render: function(data, type, row) {
                            let badgeClass = 'bg-light text-dark';
                            if (data == 1) badgeClass = 'bg-warning text-dark';
                            if (data == 2) badgeClass = 'bg-secondary text-white';
                            if (data == 3) badgeClass = 'bg-danger text-white';

                            return `<div class="badge ${badgeClass} rounded-circle p-2">${data}</div>`;
                        }
                    },
                    {
                        data: 'name',
                        render: function(data, type, row) {
                            return `
                        <div class="d-flex align-items-center">
                            <img src="${row.photo || 'https://via.placeholder.com/40'}" 
                                 class="rounded-circle me-3" width="40" height="40">
                            <div>
                                <h6 class="mb-0">${data}</h6>
                                <small class="text-muted">${row.department || ''}</small>
                            </div>
                        </div>
                    `;
                        }
                    },
                    {
                        data: 'faculty',
                        className: 'text-center'
                    },
                    {
                        data: 'points',
                        className: 'text-center fw-bold'
                    },
                    {
                        data: 'progress',
                        className: 'text-center',
                        render: function(data, type, row) {
                            let progressClass = 'bg-primary';
                            if (row.rank == 1) progressClass = 'bg-warning';
                            if (row.rank == 2) progressClass = 'bg-secondary';
                            if (row.rank == 3) progressClass = 'bg-danger';

                            return `
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar ${progressClass}" 
                                 role="progressbar" style="width: ${data}%"></div>
                        </div>
                    `;
                        }
                    },
                    {
                        data: 'id',
                        className: 'text-center',
                        render: function(data) {
                            return `<button class="btn btn-sm btn-outline-primary view-profile" data-id="${data}">
                                <i class="fas fa-user"></i> Profil
                            </button>`;
                        }
                    }
                ],
                dom: '<"row"<"col-md-6"l><"col-md-6"f>>rtip',
                buttons: [{
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Export Excel',
                    className: 'btn btn-success btn-sm'
                }],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari peserta...",
                    lengthMenu: "Tampilkan _MENU_ peserta per halaman",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ peserta",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 peserta",
                    infoFiltered: "(disaring dari _MAX_ total peserta)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                responsive: true
            });

            // Filter periode
            $('.filter-period').on('click', function(e) {
                e.preventDefault();
                const period = $(this).data('period');
                $('#filterDropdown').data('period', period).text($(this).text());
                table.ajax.reload();
            });

            // Tombol export Excel
            $('#exportExcel').on('click', function() {
                table.button('.buttons-excel').trigger();
            });

            // Tombol lihat profil
            $(document).on('click', '.view-profile', function() {
                const userId = $(this).data('id');
                // Implementasi lihat profil
                console.log('Lihat profil user ID:', userId);
                // window.location.href = '/profile/' + userId;
            });
        });
    </script>
@endsection
