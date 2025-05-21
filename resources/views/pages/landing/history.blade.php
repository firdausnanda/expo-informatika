@extends('layouts.landing.main')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('admin/libs/flatpickr/dist/flatpickr.min.css') }}">
    <link href="{{ asset('admin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('content')
    <div class="container p-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Advanced Search</h2>
                <form action="{{ route('history.search') }}" method="get">
                    @csrf
                    <div class="mb-3 icon-input">
                        <label for="searchKeywords" class="form-label">Kata Kunci Pencarian Proyek</label>
                        <div class="input-group rounded-pill">
                            <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" name="search"
                                class="form-control border-start-0 rounded-end-pill @error('search') is-invalid @enderror"
                                placeholder="Search...">
                        </div>
                        @error('search')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="matkulSelect" class="form-label">Mata Kuliah</label>
                        <select class="form-select" name="matkul" id="matkulSelect" aria-label="matkul select">
                            <option value="" selected>Semua Mata Kuliah</option>
                        </select>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6 icon-input">
                            <label for="startDate" class="form-label">Tanggal Awal</label>
                            <div class="input-group">
                                <input type="text" name="startDate" id="startDate" class="form-control"
                                    placeholder="Tanggal Awal">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6 icon-input">
                            <label for="endDate" class="form-label">Tanggal Akhir</label>
                            <div class="input-group">
                                <input type="text" name="endDate" id="endDate" class="form-control"
                                    placeholder="Tanggal Akhir">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/libs/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('admin/libs/flatpickr/dist/l10n/id.js') }}"></script>
    <script src="{{ asset('admin/libs/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize flatpickr
            $("#startDate").flatpickr({
                dateFormat: "d F Y",
                todayHighlight: true,
                autoclose: true,
                format: "d M, Y",
                locale: "id",
            });

            $("#endDate").flatpickr({
                dateFormat: "d F Y",
                todayHighlight: true,
                autoclose: true,
                format: "d M, Y",
                locale: "id",
            });

            // Initialize select2
            $("#matkulSelect").select2({
                placeholder: "Pilih Mata Kuliah",
                allowClear: true,
                theme: "bootstrap-5",
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('history') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        const items = data.data || data;

                        // Transformasi data ke format Select2
                        const results = items.map(function(item) {
                            return {
                                id: item.id,
                                text: item.nama_matakuliah,
                                nama: item.nama_matakuliah,
                                kode: item.kode_matakuliah
                            };
                        });

                        return {
                            results: results
                        };
                    },
                    cache: true
                },
                templateResult: function(data) {
                    if (!data.id) return data.text;

                    // Container utama
                    var $container = $('<div>').css({
                        'padding': '5px',
                        'line-height': '1.4'
                    });

                    // Baris nama
                    $container.append(
                        $('<div>').css({
                            'font-weight': '600',
                            'font-size': '16px'
                        }).text(data.nama)
                    );

                    // Baris NIM
                    $container.append(
                        $('<div>').css({
                            'font-size': '14px',
                            'color': '#666'
                        }).text('Kode Matakuliah: ' + data.kode)
                    );

                    return $container;
                },
                escapeMarkup: function(markup) {
                    return markup;
                }
            });
        });
    </script>
@endsection
