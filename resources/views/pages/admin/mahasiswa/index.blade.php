@extends('layouts.admin.main')

@push('style')
    <link href="{{ asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Mahasiswa</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Mahasiswa</a></li>
                                <li class="breadcrumb-item active">Data Mahasiswa</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-4">Data Mahasiswa</h4>

                            <table id="mahasiswa-table" class="table table-bordered dt-responsive nowrap w-100">
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Tambah Mahasiswa
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                            <div class="invalid-feedback" id="nama-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim">
                            <div class="invalid-feedback" id="nim-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Prodi</label>
                            <select class="form-select" id="prodi" name="prodi">
                                @foreach (App\Enums\ProdiEnum::cases() as $prodi)
                                    <option value="{{ $prodi->value }}">{{ $prodi->value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="prodi-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="text" class="form-control" id="angkatan" name="angkatan">
                            <div class="invalid-feedback" id="angkatan-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" id="btnSave" class="btn btn-primary">
                            <span class="text-save">Save</span>

                            <span class="loading d-none">
                                <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                Loading...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="modalImport" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Import Mahasiswa
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formImport" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <button class="btn btn-primary btn-sm" type="button" id="downloadTemplate">
                                <i class="fas fa-file-excel me-2"></i>Download Template
                            </button>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" id="btnImport" class="btn btn-primary">
                            <span class="text-save">Save</span>

                            <span class="loading d-none">
                                <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                Loading...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Edit Mahasiswa
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEdit">
                    <div class="modal-body">
                        <input type="hidden" id="id-edit" name="id">
                        <div class="mb-3">
                            <label for="nama-edit" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama-edit" name="nama">
                            <div class="invalid-feedback" id="nama-edit-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="nim-edit" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim-edit" name="nim">
                            <div class="invalid-feedback" id="nim-edit-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="prodi-edit" class="form-label">Prodi</label>
                            <select class="form-select" id="prodi-edit" name="prodi">
                                @foreach (App\Enums\ProdiEnum::cases() as $prodi)
                                    <option value="{{ $prodi->value }}">{{ $prodi->value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="angkatan-edit" class="form-label">Angkatan</label>
                            <input type="text" class="form-control" id="angkatan-edit" name="angkatan">
                            <div class="invalid-feedback" id="angkatan-edit-error"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" id="btnEdit" class="btn btn-primary">
                                <span class="text-save">Save</span>

                                <span class="loading d-none">
                                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                    Loading...
                                </span>
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            //  Init Datatable
            $('#mahasiswa-table').DataTable({
                ordering: false,
                processing: true,
                lengthChange: false,
                bDestroy: true,
                ajax: {
                    url: "{{ route('admin.mahasiswa.index') }}",
                    type: "GET",
                    dataType: "JSON",
                },
                buttons: [{
                    text: '<i class="fas fa-plus-circle mr-2"></i> Tambah Data',
                    className: 'btn btn-primary btn-sm btn-tambah me-2',
                    action: function(e, dt, node, config) {
                        $('#modalTambah').modal('show');
                    }
                }, {
                    text: '<i class="fas fa-file-excel mr-2"></i> Import Data',
                    className: 'btn btn-success btn-sm me-2',
                    action: function(e, dt, node, config) {
                        $('#modalImport').modal('show');
                    }
                }],
                columns: [{
                    targets: 0,
                    title: 'No',
                    className: 'text-center',
                    width: '5%',
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                }, {
                    targets: 1,
                    title: 'Nama Mahasiswa',
                    width: '50%',
                    data: 'nama',
                    render: function(data, type, row, meta) {
                        return `<span class="fw-bold">${data}</span><br>NIM. <span class="text-secondary text-sm">${row.nim}</span>`;
                    }
                }, {
                    targets: 2,
                    title: 'Prodi',
                    width: '20%',
                    data: 'prodi',
                    render: function(data, type, row, meta) {
                        let angkatan = row.angkatan ? row.angkatan : '-';
                        return `${data} <br> <span class="text-secondary text-sm">${angkatan}</span>`;
                    }
                }, {
                    targets: 3,
                    className: 'text-center',
                    title: 'Aksi',
                    width: '15%',
                    render: function(data, type, row, meta) {
                        return `<button class="btn btn-sm btn-primary btn-edit"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button>`;
                    }
                }],
                initComplete: function() {
                    $('#mahasiswa-table').DataTable().buttons().container().appendTo(
                        '#mahasiswa-table_wrapper .col-md-6:eq(0)');
                    $('.btn-tambah').removeClass("btn-secondary");
                    $('.btn-import').removeClass("btn-secondary");
                }
            });

            //  Tambah Kategori
            $('#formTambah').submit(function(e) {
                e.preventDefault();

                let btn = $('#btnSave');
                let form = $(this);

                // Aktifkan loading
                btn.prop('disabled', true);
                btn.find('.text-save').addClass('d-none');
                btn.find('.loading').removeClass('d-none');

                $.ajax({
                    url: "{{ route('admin.mahasiswa.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(response) {

                        // Reset button
                        btn.prop('disabled', false);
                        btn.find('.text-save').removeClass('d-none');
                        btn.find('.loading').addClass('d-none');

                        $('#modalTambah').modal('hide');
                        $('#mahasiswa-table').DataTable().ajax.reload();
                        $('#formTambah')[0].reset();
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Mahasiswa berhasil ditambahkan',
                            icon: 'success'
                        });
                    },
                    error: function(xhr, status, error) {

                        // Reset button
                        btn.prop('disabled', false);
                        btn.find('.text-save').removeClass('d-none');
                        btn.find('.loading').addClass('d-none');

                        Swal.fire({
                            title: 'Gagal',
                            text: 'Mahasiswa gagal ditambahkan',
                            icon: 'error'
                        });
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#formTambah').find(`#${key}`).addClass('is-invalid');
                            $('#formTambah').find(`#${key}`).next('.invalid-feedback')
                                .text(value);
                        });
                    }
                });
            });

            // Reset Form Invalid
            $('#modalTambah').on('show.bs.modal', function() {
                $('#formTambah')[0].reset();
                $('.is-invalid').removeClass('is-invalid');
            });

            // Modal Edit Show
            $('#mahasiswa-table').on('click', '.btn-edit', function() {
                let data = $('#mahasiswa-table').DataTable().row($(this).parents('tr')).data();
                $('#id-edit').val(data.id);
                $('#nama-edit').val(data.nama);
                $('#nim-edit').val(data.nim);
                $('#prodi-edit').val(data.prodi);
                $('#angkatan-edit').val(data.angkatan);
                $('#modalEdit').modal('show');
            });

            //  Edit Kategori
            $('#formEdit').submit(function(e) {
                e.preventDefault();

                let btn = $('#btnEdit');
                let form = $(this);

                // Aktifkan loading
                btn.prop('disabled', true);
                btn.find('.text-save').addClass('d-none');
                btn.find('.loading').removeClass('d-none');

                let link = "{{ route('admin.mahasiswa.update', ':id') }}";
                link = link.replace(':id', $('#id-edit').val());

                $.ajax({
                    url: link,
                    type: "PUT",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(response) {

                        // Reset button
                        btn.prop('disabled', false);
                        btn.find('.text-save').removeClass('d-none');
                        btn.find('.loading').addClass('d-none');

                        $('#modalEdit').modal('hide');
                        $('#mahasiswa-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Mahasiswa berhasil diubah',
                            icon: 'success'
                        });
                    },
                    error: function(xhr, status, error) {

                        // Reset button
                        btn.prop('disabled', false);
                        btn.find('.text-save').removeClass('d-none');
                        btn.find('.loading').addClass('d-none');

                        Swal.fire({
                            title: 'Gagal',
                            text: 'Mahasiswa gagal diubah',
                            icon: 'error'
                        });
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#formEdit').find(`#${key}-edit`).addClass('is-invalid');
                            $('#formEdit').find(`#${key}-edit`).next(
                                    '.invalid-feedback')
                                .text(value);
                        });
                    }
                });
            });

            //  Delete Mahasiswa
            $('#mahasiswa-table').on('click', '.btn-delete', function() {
                let data = $('#mahasiswa-table').DataTable().row($(this).parents('tr')).data();

                let link = "{{ route('admin.mahasiswa.destroy', ':id') }}";
                link = link.replace(':id', data.id);

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'Data mahasiswa akan dihapus',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: link,
                            type: "DELETE",
                            data: {
                                id: data.id
                            },
                            dataType: "JSON",
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Mohon tunggu...',
                                    text: 'Mahasiswa sedang dimuat',
                                    icon: 'warning',
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                            },
                            success: function(response) {
                                $('#mahasiswa-table').DataTable().ajax.reload();
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Mahasiswa berhasil dihapus',
                                    icon: 'success'
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Mahasiswa gagal dihapus',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });

            // Import Mahasiswa
            $('#formImport').submit(function(e) {
                e.preventDefault();

                let btn = $('#btnImport');
                let form = $(this);

                // Aktifkan loading
                btn.prop('disabled', true);
                btn.find('.text-save').addClass('d-none');
                btn.find('.loading').removeClass('d-none');

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.mahasiswa.import') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "JSON",
                    success: function(response) {

                        // Reset button
                        btn.prop('disabled', false);
                        btn.find('.text-save').removeClass('d-none');
                        btn.find('.loading').addClass('d-none');

                        $('#modalImport').modal('hide');
                        $('#mahasiswa-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Berhasil',
                            icon: 'success',
                            text: 'Mahasiswa berhasil diimport',
                        });
                    },
                    error: function(xhr, status, error) {

                        // Reset button
                        btn.prop('disabled', false);
                        btn.find('.text-save').removeClass('d-none');
                        btn.find('.loading').addClass('d-none');

                        Swal.fire({
                            title: 'Gagal',
                            icon: 'error',
                            text: xhr.responseJSON.errors[0][0],
                        });
                    }
                });
            });

            // Download Template
            $('#downloadTemplate').click(function() {
                window.open("{{ asset('template/template_mahasiswa.xlsx') }}", '_blank');
            });

        });
    </script>
@endpush
