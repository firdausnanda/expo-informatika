@extends('layouts.admin.main')

@push('style')
    <link href="{{ asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Mata Kuliah</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Mata Kuliah</a></li>
                                <li class="breadcrumb-item active">Data Mata Kuliah</li>
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
                            <h4 class="card-title mb-4">Data Mata Kuliah</h4>
                            <table id="table-mata-kuliah" class="table table-bordered dt-responsive nowrap w-100">
                            </table>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modal-tambah" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Tambah Mata Kuliah
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="kode_matakuliah">Kode Mata Kuliah</label>
                            <input type="text"
                                class="form-control {{ $errors->has('kode_matakuliah') ? 'is-invalid' : '' }}"
                                id="kode_matakuliah" name="kode_matakuliah" required>
                            <span class="text-danger" id="kode_matakuliah_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_matakuliah">Nama Mata Kuliah</label>
                            <input type="text"
                                class="form-control {{ $errors->has('nama_matakuliah') ? 'is-invalid' : '' }}"
                                id="nama_matakuliah" name="nama_matakuliah" required>
                            <span class="text-danger" id="nama_matakuliah_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="sks">SKS</label>
                            <input type="number" class="form-control {{ $errors->has('sks') ? 'is-invalid' : '' }}"
                                id="sks" name="sks" min="1" max="6" required>
                            <span class="text-danger" id="sks_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="semester">Semester</label>
                            <input type="number" class="form-control {{ $errors->has('semester') ? 'is-invalid' : '' }}"
                                id="semester" name="semester" min="1" max="14" required>
                            <span class="text-danger" id="semester_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}" id="deskripsi" name="deskripsi"
                                rows="3"></textarea>
                            <span class="text-danger" id="deskripsi_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                                    checked>
                                <label class="form-check-label" for="status">Aktif</label>
                                <span class="text-danger" id="status_error"></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modal-edit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalEditId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditId">Edit Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit">
                        @csrf
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group mb-3">
                            <label for="edit_kode_matakuliah">Kode Mata Kuliah</label>
                            <input type="text" class="form-control" id="edit_kode_matakuliah" name="kode_matakuliah"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="edit_nama_matakuliah">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="edit_nama_matakuliah" name="nama_matakuliah"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="edit_sks">SKS</label>
                            <input type="number" class="form-control" id="edit_sks" name="sks" min="1"
                                max="6" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="edit_semester">Semester</label>
                            <input type="number" class="form-control" id="edit_semester" name="semester"
                                min="1" max="14" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="edit_deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit_status" name="status"
                                    value="1">
                                <label class="form-check-label" for="edit_status">Aktif</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
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
            $('#table-mata-kuliah').DataTable({
                ordering: false,
                processing: true,
                lengthChange: false,
                bDestroy: true,
                ajax: {
                    url: "{{ route('admin.mata-kuliah.index') }}",
                    type: "GET",
                    dataType: "JSON",
                },
                buttons: [{
                    text: '<i class="fas fa-plus-circle mr-2"></i> Tambah Data',
                    className: 'btn btn-primary btn-sm btn-tambah me-2',
                    action: function(e, dt, node, config) {
                        $('#modal-tambah').modal('show');
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
                    title: 'Mata Kuliah',
                    width: '65%',
                    data: 'nama_matakuliah',
                    render: function(data, type, row, meta) {
                        return `<span class="fw-bold">${data}</span>
                        <br>
                        <span class="text-muted">Kode Matkul. ${row.kode_matakuliah} (${row.sks} SKS)</span>
                        `;
                    }
                }, {
                    targets: 2,
                    title: 'Status',
                    width: '15%',
                    data: 'status',
                    className: 'text-start',
                    render: function(data, type, row, meta) {
                        let badge
                        switch (data) {
                            case true:
                                badge = 'bg-success';
                                break;
                            case false:
                                badge = 'bg-danger';
                                break;
                            default:
                                badge = 'bg-secondary';
                                break;
                        }
                        return `<span class="badge ${badge}">${data ? 'Aktif' : 'Tidak Aktif'}</span>`;
                    }
                }, {
                    targets: 3,
                    className: 'text-center',
                    title: 'Aksi',
                    width: '15%',
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<button class="btn btn-sm btn-primary btn-edit"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button>`;
                    }
                }],
                initComplete: function() {
                    $('#table-mata-kuliah').DataTable().buttons().container().appendTo(
                        '#table-mata-kuliah_wrapper .col-md-6:eq(0)');
                    $('.btn-tambah').removeClass("btn-secondary");
                }
            });

            // Format tanggal   
            function formatTimestamp(timestamp) {

                return date.toLocaleDateString('id-ID', options);
            }

            // Detail
            $('#table-mata-kuliah').on('click', '.btn-detail', function() {
                let data = $('#table-mata-kuliah').DataTable().row($(this).parents('tr')).data();
                $('#detail').val(JSON.stringify(data.properties, null, 2));
                $('#modal-detail').modal('show');
            });

            // Handle Form Submit
            $('#form-tambah').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.mata-kuliah.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire('Sukses!', response.meta.message, 'success');
                        $('#modal-tambah').modal('hide');
                        $('#table-mata-kuliah').DataTable().ajax.reload();
                        $('#form-tambah')[0].reset();
                    },
                    error: function(xhr) {
                        $.each(xhr.responseJSON.data, function(index, value) {
                            $('#' + index + '_error').text(value);
                        });
                    }
                });
            });

            // Handle Edit Button Click
            $('#table-mata-kuliah').on('click', '.btn-edit', function() {
                let data = $('#table-mata-kuliah').DataTable().row($(this).parents('tr')).data();
                $('#edit_id').val(data.id);
                $('#edit_kode_matakuliah').val(data.kode_matakuliah);
                $('#edit_nama_matakuliah').val(data.nama_matakuliah);
                $('#edit_sks').val(data.sks);
                $('#edit_semester').val(data.semester);
                $('#edit_deskripsi').val(data.deskripsi);
                $('#edit_status').prop('checked', data.status);
                $('#modal-edit').modal('show');
            });

            // Handle Edit Form Submit
            $('#form-edit').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit_id').val();
                $.ajax({
                    url: `{{ route('admin.mata-kuliah.index') }}/${id}`,
                    type: "PUT",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire('Sukses!', response.meta.message, 'success');
                        $('#modal-edit').modal('hide');
                        $('#table-mata-kuliah').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', xhr.responseJSON.message, 'error');
                    }
                });
            });

            // Handle Delete Button Click
            $(document).on('click', '.btn-delete', function() {
                const id = $(this).data('id');
                if (!id) {
                    Swal.fire('Error!', 'ID tidak valid', 'error');
                    return;
                }
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ route('admin.mata-kuliah.index') }}/${id}`,
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire('Sukses!', response.meta.message, 'success');
                                $('#table-mata-kuliah').DataTable().ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', xhr.responseJSON.message, 'error');
                            }
                        });
                    }
                });
            });

        });
    </script>
@endpush
