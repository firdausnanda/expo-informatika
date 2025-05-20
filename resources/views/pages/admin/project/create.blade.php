@extends('layouts.admin.main')

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

                            <h4 class="card-title mb-4">Tambah Data Project</h4>

                            <form id="formTambah" enctype="multipart/form-data">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama <span class="text-danger">*</span></label>
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                placeholder="Masukkan Nama Project">
                                            <span class="invalid-feedback" id="nama-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kategori">Kategori <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="kategori[]" multiple="multiple"
                                                id="kategori">
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback" id="kategori-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Project"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-2">
                                            <label for="pembuat">Pembuat <span class="text-danger">*</span></label>
                                            <div class="row g-2">
                                                <div class="col-lg-5">
                                                    <select name="pembuat" class="form-select" id="pembuat">
                                                        <option value="" selected disabled>Pilih Mahasiswa</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-1">
                                                    <button class="btn btn-primary" type="button"
                                                        id="tambahPembuat">Tambahkan</button>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table table-bordered" id="tabelPembuat">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Prodi</th>
                                                    <th>Angkatan</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tahun_akademik">Tahun Akademik</label>
                                            <select name="tahun_akademik" id="tahun_akademik" class="form-select">
                                                <option value="" selected disabled>Pilih Tahun Akademik</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="link">Link</label>
                                            <input name="link" id="link" class="form-control"></input>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="gambar">Gambar<span class="text-danger">*</span></label>

                                            <div>
                                                <div class="dropzone" id="dropzone" style="cursor: pointer;">
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple="multiple">
                                                    </div>
                                                    <div class="dz-message needsclick">
                                                        <div class="mb-3 text-center">
                                                            <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                        </div>

                                                        <h4 class="text-center">Drop files here or click to upload.</h4>
                                                    </div>
                                                </div>
                                                <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                    <li class="mt-2" id="dropzone-preview-list">
                                                        <div class="border rounded">
                                                            <div class="d-flex p-2">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <div class="avatar-sm bg-light rounded">
                                                                        <img data-dz-thumbnail
                                                                            class="img-fluid rounded d-block"
                                                                            src="https://img.themesbrand.com/judia/new-document.png"
                                                                            alt="Dropzone-Image">
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="pt-1">
                                                                        <h5 class="fs-md mb-1" data-dz-name>&nbsp;</h5>
                                                                        <p class="fs-sm text-muted mb-0" data-dz-size></p>
                                                                        <strong class="error text-danger"
                                                                            data-dz-errormessage></strong>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-3">
                                                                    <button data-dz-remove
                                                                        class="btn btn-sm btn-danger">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-end">
                                        <a href="{{ route('admin.project.index') }}" class="btn btn-secondary">Kembali</a>
                                        <button type="submit" id="simpan" class="btn btn-primary">Simpan
                                            Data</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/select2.init.js') }}"></script>
    <script src="{{ asset('admin/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/libs/dropzone/dropzone-min.js') }}"></script>
    <script>
        $(document).ready(function() {

            var selectedStudents = [];

            // Init DataTable Tabel Pembuat
            let table = $('#tabelPembuat').DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                destroy: true,
                data: selectedStudents,
                columns: [{
                        data: 'no',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'nama',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'prodi',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'angkatan',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'aksi',
                        render: function(data, type, row, meta) {
                            return '<button type="button" class="btn btn-danger btn-sm btn-hapus">Hapus</button>';
                        }
                    }
                ]
            })

            // Init Select2 Pembuat
            $('#pembuat').select2({
                placeholder: 'Pilih Mahasiswa...',
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('admin.project.getMahasiswaSelect') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            data: params.term
                        };
                    },
                    processResults: function(data) {
                        var formattedData = $.map(data.data, function(item) {
                            return {
                                id: item.id,
                                text: item.nama,
                                nama: item.nama,
                                nim: item.nim,
                                prodi: item.prodi,
                                angkatan: item.angkatan
                            };
                        });
                        return {
                            results: formattedData
                        };
                    }
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
                            'font-size': '14px'
                        }).text(data.nama)
                    );

                    // Baris NIM
                    $container.append(
                        $('<div>').css({
                            'font-size': '12px',
                            'color': '#666'
                        }).text('NIM: ' + data.nim)
                    );

                    return $container;
                },
                escapeMarkup: function(markup) {
                    return markup;
                }
            });

            $('#pembuat').on('select2:select', function(e) {
                // Tambahkan data yang dipilih ke array
                var data = e.params.data;
                selectedStudents.push({
                    id: data.id,
                    nama: data.nama,
                    nim: data.nim,
                    prodi: data.prodi,
                    angkatan: data.angkatan
                });
            });

            // Event Tambah Mahasiswa
            $('#tambahPembuat').on('click', function() {
                // $('#tabelPembuat').DataTable().clear().rows.add(selectedStudents).draw();
                var currentIds = table.rows().data().toArray().map(item => item.id);
                var newStudents = [];
                var dupCount = 0;

                // Filter hanya yang belum ada di tabel
                selectedStudents.forEach(function(student) {
                    if (currentIds.includes(student.id)) {
                        dupCount++;
                    } else {
                        newStudents.push(student);
                    }
                });


                // Tampilkan notifikasi
                if (newStudents.length <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'mahasiswa sudah ada di tabel',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    });
                }

                // Tambahkan yang baru
                if (newStudents.length > 0) {
                    table.rows.add(newStudents).draw();
                }

                // Update selectedStudents hanya dengan yang baru
                selectedStudents = newStudents;

                $('#pembuat').val(null).trigger('change');
            });

            // Event Hapus Mahasiswa
            $('#tabelPembuat').on('click', '.btn-hapus', function() {
                var row = $(this).closest('tr');
                var table = $('#tabelPembuat').DataTable();
                var rowData = table.row(row).data();

                Swal.fire({
                    title: 'Hapus Mahasiswa',
                    text: 'Apakah Anda yakin ingin menghapus mahasiswa ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Animasi fade out sebelum menghapus
                        $(row).fadeOut('fast', function() {
                            table.row(row).remove().draw('page');
                            selectedStudents = selectedStudents.filter(s => s.id !== rowData
                                .id);
                        });
                    }
                });
            });

            // Init Select2 Kategori
            $('#kategori').select2({
                placeholder: 'Pilih Kategori',
                allowClear: true,
            });

            // Init Select2 Tahun Akademik
            $('#tahun_akademik').select2({
                placeholder: 'Pilih Tahun Akademik',
                width: '100%',
                ajax: {
                    url: "{{ route('admin.project.getTahunAkademikSelect') }}",
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.tahun_akademik + ' - ' + item.semester,
                                    tahun_akademik: item.tahun_akademik,
                                    semester: item.semester,
                                    is_active: item.is_active
                                };
                            })
                        };
                    }
                },
                templateResult: function(data) {
                    if (!data.id) return data.text;

                    var $container = $('<div>');
                    $container.append($('<strong>').text(data.tahun_akademik));
                    $container.append($('<div>')
                        .css({
                            'font-size': '0.8em',
                            'color': '#666'
                        })
                        .text('Semester: ' + data.semester));

                    if (data.is_active) {
                        $container.append($('<span>')
                            .css({
                                'float': 'right',
                                'background': '#28a745',
                                'color': 'white',
                                'padding': '2px 5px',
                                'border-radius': '3px',
                                'font-size': '0.7em'
                            })
                            .text('Aktif'));
                    }

                    return $container;
                }
            });

            function getAllStudentsFromTable() {
                let table = $('#tabelPembuat').DataTable();
                let allData = table.rows().data().toArray(); // Konversi ke array

                // Format data untuk FormData
                let students = [];
                allData.forEach(row => {
                    students.push({
                        id: row.id,
                        nama: row.nama,
                        nim: row.nim
                    });
                });

                return students;
            }

            // Init TinyMCE
            tinymce.init({
                selector: "textarea#deskripsi",
                height: 350,
                toolbar: "undo redo | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help",
                content_style: 'body { font-family:"Poppins",sans-serif; font-size:16px }',
                menubar: [
                    'file',
                    'edit',
                    'view',
                    'insert',
                    'format'
                ],
            });

            // Init Dropzone
            Dropzone.autoDiscover = false;

            const dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
            if (dropzonePreviewNode) {

                // Simpan template preview dari parent node
                const previewTemplate = dropzonePreviewNode.parentNode.innerHTML;

                // Hapus elemen preview dari DOM
                dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);

                const myDropzone = new Dropzone(document.getElementById('dropzone'), {
                    url: "{{ route('admin.project.storeGambar') }}",
                    maxFiles: 5,
                    maxFilesize: 5,
                    autoProcessQueue: false,
                    parallelUploads: 5,
                    acceptedFiles: "image/*",
                    addRemoveLinks: true,
                    paramName: "gambar",
                    uploadMultiple: true,
                    previewTemplate: previewTemplate,
                    previewsContainer: "#dropzone-preview",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    init: function() {
                        const form = document.getElementById('formTambah');
                        const submitButton = form.querySelector('button[type="submit"]');

                        submitButton.addEventListener("click", function(e) {
                            e.preventDefault();

                            // Validasi Form
                            if (form.reportValidity()) {

                                let deskripsi = tinymce.get('deskripsi').getContent();

                                const formData = new FormData(form);
                                formData.append('deskripsi', deskripsi);
                                formData.append('mahasiswa_id', JSON.stringify(
                                    getAllStudentsFromTable()));
                                $.ajax({
                                    url: "{{ route('admin.project.store') }}",
                                    type: "POST",
                                    data: formData,
                                    dataType: "JSON",
                                    processData: false,
                                    contentType: false,
                                    beforeSend: function() {
                                        Swal.fire({
                                            title: 'Mohon tunggu',
                                            text: 'Project sedang dimuat',
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            showCancelButton: false,
                                            showConfirmButton: false,
                                            icon: 'warning'

                                        });
                                    },
                                    success: function(response) {
                                        myDropzone.options.params = {
                                            project_id: response.project_id
                                        };
                                        myDropzone.processQueue();
                                    },
                                    error: function(xhr, status,
                                        error) {
                                        Swal.fire({
                                            title: 'Gagal',
                                            text: 'Project gagal ditambahkan',
                                            icon: 'error',
                                            allowOutsideClick: false,
                                            allowEscapeKey: false
                                        });
                                        $.each(xhr.responseJSON.errors, function(
                                            key,
                                            value) {
                                            $('#formTambah').find(`#${key}`)
                                                .addClass('is-invalid');
                                            $('#formTambah').find(`#${key}`)
                                                .next('.invalid-feedback')
                                                .text(
                                                    value);
                                        });
                                    }
                                });
                            }

                            // Ketika semua file berhasil diupload
                            myDropzone.on("complete", function(file, response) {
                                if (this.getUploadingFiles().length === 0 && this
                                    .getQueuedFiles().length === 0) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Data berhasil disimpan',
                                        icon: 'success',
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    }).then(() => {
                                        window.location.href =
                                            "{{ route('admin.project.index') }}";
                                    });
                                }
                            });

                            myDropzone.on("error", function(file, response) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Data gagal disimpan',
                                    icon: 'error',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                });
                            });
                        });

                    }
                })
            }

        });
    </script>
@endpush
