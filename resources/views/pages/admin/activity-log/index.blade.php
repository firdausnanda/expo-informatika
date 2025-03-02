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
                        <h4 class="mb-sm-0 font-size-18">Activity Log</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Activity Log</a></li>
                                <li class="breadcrumb-item active">Data Activity Log</li>
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

                            <h4 class="card-title mb-4">Data Activity Log</h4>

                            <table id="activity-log-table" class="table table-bordered dt-responsive nowrap w-100">
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalDetail" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Detail Activity Log
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea id="detail" class="form-control" cols="30" rows="30"></textarea>
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
            $('#activity-log-table').DataTable({
                ordering: false,
                processing: true,
                lengthChange: false,
                bDestroy: true,
                ajax: {
                    url: "{{ route('admin.activity-log.index') }}",
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
                    title: 'Waktu',
                    width: '15%',
                    data: 'created_at',
                    render: function(data, type, row, meta) {
                        let waktu = formatTimestamp(data);
                        return `<span class="fw-bold">${waktu}</span>`;
                    }
                }, {
                    targets: 2,
                    title: 'User',
                    width: '15%',
                    data: 'causer_id',
                    render: function(data, type, row, meta) {
                        let causer = row.causer ? row.causer.name : '-';
                        let causer_type = row.causer_type ? row.causer_type : '-';
                        return `<span class="fw-bold">${causer}</span><br><span class="text-secondary text-sm">${causer_type}</span>`;
                    }
                }, {
                    targets: 3,
                    title: 'Event',
                    width: '5%',
                    data: 'event',
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        let badge
                        switch (data) {
                            case 'created':
                                badge = 'bg-primary';
                                break;
                            case 'updated':
                                badge = 'bg-warning';
                                break;
                            case 'deleted':
                                badge = 'bg-danger';
                                break;

                            default:
                                badge = 'bg-secondary';
                                break;
                        }
                        return `<span class="badge ${badge}">${data}</span>`;
                    }
                }, {
                    targets: 4,
                    className: 'text-center',
                    title: 'Deskripsi',
                    width: '15%',
                    data: 'description',
                    render: function(data, type, row, meta) {
                        return data;
                    }
                }, {
                    targets: 5,
                    className: 'text-center',
                    title: 'Aksi',
                    width: '15%',
                    data: 'action',
                    render: function(data, type, row, meta) {
                        return `<button class="btn btn-sm btn-info btn-detail"><i class="fas fa-question-circle"></i></button>`;
                    }
                }],
                initComplete: function() {
                    $('#user-table').DataTable().buttons().container().appendTo(
                        '#user-table_wrapper .col-md-6:eq(0)');
                    $('.btn-tambah').removeClass("btn-secondary");
                }
            });

            // Format tanggal
            function formatTimestamp(timestamp) {
                const date = new Date(timestamp);
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                return date.toLocaleDateString('id-ID', options);
            }

            // Detail
            $('#activity-log-table').on('click', '.btn-detail', function() {
                let data = $('#activity-log-table').DataTable().row($(this).parents('tr')).data();
                $('#detail').val(JSON.stringify(data.properties, null, 2));
                $('#modalDetail').modal('show');
            });

        });
    </script>
@endpush
