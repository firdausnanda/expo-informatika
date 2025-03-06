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
                                        <button type="submit" id="simpan" class="btn btn-primary">Simpan Data</button>
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
@endpush

@push('scripts')
    <script src="{{ asset('admin/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/select2.init.js') }}"></script>
    <script src="{{ asset('admin/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/libs/dropzone/dropzone-min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // Init Select2
            $('.select2').select2({
                placeholder: 'Pilih Kategori',
                allowClear: true
            });

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

                                $.ajax({
                                    url: "{{ route('admin.project.store') }}",
                                    type: "POST",
                                    data: formData,
                                    dataType: "JSON",
                                    processData: false,
                                    contentType: false,
                                    beforeSend: function() {
                                        Swal.showLoading();
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
                                            icon: 'error'
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
                                        icon: 'success'
                                    });
                                }
                            });

                            myDropzone.on("error", function(file, response) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Data gagal disimpan',
                                    icon: 'error'
                                });
                            });
                        });

                    }
                })
            }

        });
    </script>
@endpush
