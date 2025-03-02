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
                        <h4 class="mb-sm-0 font-size-18">User Management</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">User Management</a></li>
                                <li class="breadcrumb-item active">Data User</li>
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

                            <h4 class="card-title mb-4">Data User</h4>

                            <table id="user-table" class="table table-bordered dt-responsive nowrap w-100">
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
                        Tambah User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama User</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                            <div class="invalid-feedback" id="nama-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                            <div class="invalid-feedback" id="username-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <div class="invalid-feedback" id="email-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role">
                                @foreach (App\Enums\RoleEnum::cases() as $role)
                                    <option value="{{ $role->value }}">{{ $role->value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="role-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password">
                            <div class="invalid-feedback" id="password-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Edit User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEdit">
                    <div class="modal-body">
                        <input type="hidden" id="id-edit" name="id">
                        <div class="mb-3">
                            <label for="nama-edit" class="form-label">Nama User</label>
                            <input type="text" class="form-control" id="nama-edit" name="nama">
                            <div class="invalid-feedback" id="nama-edit-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="username-edit" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username-edit" name="username">
                            <div class="invalid-feedback" id="username-edit-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email-edit" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email-edit" name="email">
                            <div class="invalid-feedback" id="email-edit-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="role-edit" class="form-label">Role</label>
                            <select class="form-select" id="role-edit" name="role">
                                @foreach (App\Enums\RoleEnum::cases() as $role)
                                    <option value="{{ $role->value }}">{{ $role->value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password-edit" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password-edit" name="password">
                            <div class="invalid-feedback" id="password-edit-error"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Save</button>
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
            $('#user-table').DataTable({
                ordering: false,
                processing: true,
                lengthChange: false,
                bDestroy: true,
                ajax: {
                    url: "{{ route('admin.user.index') }}",
                    type: "GET",
                    dataType: "JSON",
                },
                buttons: [{
                    text: '<i class="fas fa-plus-circle mr-2"></i> Tambah Data',
                    className: 'btn btn-primary btn-sm btn-tambah me-2',
                    action: function(e, dt, node, config) {
                        $('#modalTambah').modal('show');
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
                    title: 'Nama User',
                    width: '50%',
                    data: 'name',
                    render: function(data, type, row, meta) {
                        return `<span class="fw-bold">${data}</span><br>Email. <span class="text-secondary text-sm">${row.email}</span>`;
                    }
                }, {
                    targets: 2,
                    title: 'Username',
                    width: '20%',
                    data: 'username',
                }, {
                    targets: 3,
                    title: 'Role',
                    width: '20%',
                    data: 'roles',
                    render: function(data, type, row, meta) {
                        return `${row.roles[0].name}`;
                    }
                }, {
                    targets: 4,
                    className: 'text-center',
                    title: 'Aksi',
                    width: '15%',
                    render: function(data, type, row, meta) {
                        return `<button class="btn btn-sm btn-primary btn-edit"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button>`;
                    }
                }],
                initComplete: function() {
                    $('#user-table').DataTable().buttons().container().appendTo(
                        '#user-table_wrapper .col-md-6:eq(0)');
                    $('.btn-tambah').removeClass("btn-secondary");
                }
            });

            //  Tambah User
            $('#formTambah').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.user.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Mohon tunggu',
                            text: 'User sedang dimuat',
                            icon: 'warning'
                        });
                    },
                    success: function(response) {
                        $('#modalTambah').modal('hide');
                        $('#user-table').DataTable().ajax.reload();
                        $('#formTambah')[0].reset();
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'User berhasil ditambahkan',
                            icon: 'success'
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'User gagal ditambahkan',
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

            // Modal Edit Show
            $('#user-table').on('click', '.btn-edit', function() {
                let data = $('#user-table').DataTable().row($(this).parents('tr')).data();
                $('#id-edit').val(data.id);
                $('#nama-edit').val(data.name);
                $('#username-edit').val(data.username);
                $('#email-edit').val(data.email);
                $('#role-edit').val(data.roles[0].name).change();
                $('#password-edit').val('');
                $('#modalEdit').modal('show');
            });

            //  Edit User
            $('#formEdit').submit(function(e) {
                e.preventDefault();

                let link = "{{ route('admin.user.update', ':id') }}";
                link = link.replace(':id', $('#id-edit').val());

                $.ajax({
                    url: link,
                    type: "PUT",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Mohon tunggu',
                            text: 'User sedang dimuat',
                            icon: 'warning'
                        });
                    },
                    success: function(response) {
                        $('#modalEdit').modal('hide');
                        $('#user-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'User berhasil diubah',
                            icon: 'success'
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'User gagal diubah',
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

            //  Delete User
            $('#user-table').on('click', '.btn-delete', function() {
                let data = $('#user-table').DataTable().row($(this).parents('tr')).data();

                let link = "{{ route('admin.user.destroy', ':id') }}";
                link = link.replace(':id', data.id);

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'Data user akan dihapus',
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
                                    title: 'Mohon tunggu',
                                    text: 'User sedang dimuat',
                                    icon: 'warning'
                                });
                            },
                            success: function(response) {
                                $('#user-table').DataTable().ajax.reload();
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'User berhasil dihapus',
                                    icon: 'success'
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'User gagal dihapus',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
