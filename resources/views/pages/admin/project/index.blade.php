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
                        <h4 class="mb-sm-0 font-size-18">Project</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Project</a></li>
                                <li class="breadcrumb-item active">Data Project</li>
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

                            <h4 class="card-title mb-4">Data Project</h4>

                            <table id="project-table" class="table table-bordered dt-responsive nowrap w-100">
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

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
            $('#project-table').DataTable({
                ordering: false,
                processing: true,
                lengthChange: false,
                bDestroy: true,
                ajax: {
                    url: "{{ route('admin.project.index') }}",
                    type: "GET",
                    dataType: "JSON",
                },
                buttons: [{
                    text: '<i class="fas fa-plus-circle mr-2"></i> Tambah Data',
                    className: 'btn btn-primary btn-sm btn-tambah me-2',
                    action: function(e, dt, node, config) {
                        window.location.href = "{{ route('admin.project.create') }}";
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
                    title: 'Nama Project',
                    width: '50%',
                    data: 'nama',
                    render: function(data, type, row, meta) {
                        let kategori = '';
                        $.each(row.kategori, function(index, value) {
                            if (index === row.kategori.length - 1) {
                                kategori += value.nama;
                            } else {
                                kategori += value.nama + ', ';
                            }
                        });
                        return `<span class="fw-bold">${data}</span><br>Kategori. <span class="text-secondary text-sm">${kategori}</span>`;
                    }
                }, {
                    targets: 2,
                    title: 'Deskripsi',
                    width: '20%',
                    data: 'deskripsi',
                }, {
                    targets: 3,
                    title: 'Status',
                    width: '20%',
                    data: 'status',
                    render: function(data, type, row, meta) {
                        return data ? 'Aktif' : 'Tidak Aktif';
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
                    $('#project-table').DataTable().buttons().container().appendTo(
                        '#project-table_wrapper .col-md-6:eq(0)');
                    $('.btn-tambah').removeClass("btn-secondary");
                }
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
