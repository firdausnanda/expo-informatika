@extends('layouts.admin.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card bg-primary-subtle">
                        <div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-3">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>Admin Dashboard</p>

                                        <ul class="ps-3 mb-0">
                                            <li class="py-1">{{ $project }} Project</li>
                                            <li class="py-1">{{ $user }} User</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('admin/images/profile-img.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                            <span
                                                class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                                <i class="bx bx-copy-alt"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Project</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4>{{ number_format($projectweek) }} <i
                                                class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                        <div class="d-flex">
                                            <span class="badge badge-soft-success font-size-12"> + {{ $projectprecentage }}%
                                            </span>
                                            <span class="ms-2 text-truncate">From previous period</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                            <span
                                                class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                                <i class="bx bx-like"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Project Rated</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4>{{ number_format($projectliked) }} <i
                                                class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                        <div class="d-flex">
                                            <span class="badge badge-soft-success font-size-12"> +
                                                {{ $projectratedprecentage }}% </span>
                                            <span class="ms-2 text-truncate">From previous period</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                            <span
                                                class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                                <i class="bx bx-purchase-tag-alt"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">User</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4>{{ $user }} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>

                                        <div class="d-flex">
                                            <span class="badge badge-soft-warning font-size-12"> {{ $userprecentage }}%
                                            </span>
                                            <span class="ms-2 text-truncate">From previous period</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Project</h4>

                            <canvas id="lineChart" height="100"></canvas>


                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/libs/chart.js/chart.umd.js') }}"></script>
    <script>
        $(document).ready(function() {
            new Chart(document.getElementById('lineChart'), {
                type: 'line',
                data: {
                    labels: @json($chartData->pluck('label')),
                    datasets: [{
                        label: 'Jumlah Project',
                        data: @json($chartData->pluck('count')),
                        backgroundColor: '#4e73df'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Project'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        }
                    }
                }
            });

        });
    </script>
@endpush
