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
                        <h4 class="mb-sm-0 font-size-18">Contact Us</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contact Us</a></li>
                                <li class="breadcrumb-item active">Data Contact Us</li>
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

                            <h4 class="card-title mb-4">Data Contact Us</h4>

                            <table id="contact-us-table" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Subjek</th>
                                        <th>Tanggal Pengiriman</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>

    <!-- Modal Body -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Detail
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-secondary" for="name">Nama</label>
                                <input type="text" class="form-control-plaintext fw-bold text-dark bg-light rounded px-2"
                                    id="name" name="name" placeholder="Nama" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-secondary" for="email">Email</label>
                                <input type="text" class="form-control-plaintext fw-bold text-dark bg-light rounded px-2"
                                    id="email" name="email" placeholder="Email" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-secondary" for="subject">Subjek</label>
                                <input type="text" class="form-control-plaintext fw-bold text-dark bg-light rounded px-2"
                                    id="subject" name="subject" placeholder="Subjek" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-secondary" for="created_at">Tanggal Pengiriman</label>
                                <input type="text" class="form-control-plaintext fw-bold text-dark bg-light rounded px-2"
                                    id="created_at" name="created_at" placeholder="Tanggal Pengiriman" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-secondary" for="message">Pesan</label>
                                <textarea class="form-control-plaintext fw-bold text-dark bg-light rounded px-2" id="message" name="message"
                                    placeholder="Pesan" rows="5" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
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
    <script src="{{ asset('landing/vendor/moment-js/moment-with-locales.js') }}"></script>
    <script>
        $(document).ready(function() {

            //  Init Datatable
            let table = $('#contact-us-table').DataTable({
                ordering: false,
                processing: true,
                lengthChange: false,
                ajax: {
                    url: "{{ route('admin.contact-us.index') }}",
                    type: "GET",
                    dataType: "JSON",
                },
                buttons: [],
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
                    title: 'Subjek',
                    width: '45%',
                    data: 'subject',
                    render: function(data, type, row, meta) {
                        return `<span class="fw-bold">${data}</span><br><span class="text-secondary text-sm">${row.message}</span>`;
                    }
                }, {
                    targets: 2,
                    title: 'Nama',
                    width: '30%',
                    data: 'name',
                    render: function(data, type, row, meta) {
                        return `<span class="fw-bold">${data}</span><br><span class="text-secondary text-sm">${row.email}</span>`;
                    }
                }, {
                    targets: 3,
                    title: 'Tanggal Pengiriman',
                    width: '10%',
                    data: 'created_at',
                    render: function(data, type, row, meta) {
                        return moment(data).format('DD MMMM YYYY, HH:mm');
                    }
                }, {
                    targets: 4,
                    title: 'Status',
                    width: '10%',
                    data: 'views_count',
                    render: function(data, type, row, meta) {
                        if (data > 0) {
                            return `<span class="badge bg-success">Sudah Dibaca</span>`;
                        } else {
                            return `<span class="badge bg-danger">Belum Dibaca</span>`;
                        }
                    }
                }, {
                    targets: 5,
                    className: 'text-center',
                    width: '10%',
                    render: function(data, type, row, meta) {
                        return `<button class="btn btn-sm btn-primary btn-detail"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-danger btn-hapus"><i class="fas fa-trash"></i></button>`;
                    }
                }],
                initComplete: function() {
                    $('#contact-us-table').DataTable().buttons().container().appendTo(
                        '#contact-us-table_wrapper .col-md-6:eq(0)');
                }
            });

            //  Detail Contact Us
            $('#contact-us-table').on('click', '.btn-detail', function() {
                let data = $('#contact-us-table').DataTable().row($(this).parents('tr')).data();
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#subject').val(data.subject);
                $('#message').val(data.message);
                $('#created_at').val(moment(data.created_at).format('DD MMMM YYYY, HH:mm'));

                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.contact-us.view', ['id' => ':id']) }}".replace(':id', data
                        .id),
                    dataType: "JSON",
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Loading...',
                            text: 'Please wait while we are processing your request',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            showCancelButton: false,
                        });
                    },
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            title: 'Data has been loaded',
                            icon: 'success',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            showCancelButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Data has been loaded',
                        });
                    }
                });

                $('#modalId').modal('show');
            });

            //  Hapus Contact Us
            $('#contact-us-table').on('click', '.btn-hapus', function() {
                let data = $('#contact-us-table').DataTable().row($(this).parents('tr')).data();

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'Data akan dihapus',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('admin.contact-us.destroy', ['contact_u' => ':id']) }}".replace(
                                ':id', data
                                .id),
                            dataType: "JSON",
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Loading...',
                                    text: 'Please wait while we are processing your request',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                });
                            },
                            success: function(response) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    title: 'Data has been deleted',
                                    icon: 'success',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                });
        
                                table.ajax.reload()
                            },
                            error: function(response) {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Data has been deleted',
                                });
                            }
                        });                        
                    }
                });

            });

            //  Reload Datatable
            $('#modalId').on('hidden.bs.modal', function() {
                table.ajax.reload();
            });
        });
    </script>
@endpush
