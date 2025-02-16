@extends('layouts.main')

@section('content')
    <div class="page-content" style="margin-top: 50px;">

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card mb-5 mt-5">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="mt-2" id="subtitle">Data Materi Kuliah</h4>
                                <small>Berikut adalah data materi kuliah yang ada di dalam sistem.</small>
                            </div>
                            <div class="col-lg-6" id="btn_create">
                                <button class="btn float-right" data-toggle="modal" data-target="#addMateri"
                                    style="background: var(--main-bg-primary); color: #FFFFFF;border-radius: 8px;"><i
                                        class="fas fa-file-upload mr-2"></i> Tambah Materi Kuliah</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table-materials"
                                width="100%" cellspacing="0">
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>

    {{-- modal add course --}}
    <div class="modal fade" id="addMateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Materi Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_create_materi" enctype="multipart/form-data">
                    <div class="modal-body form">
                        <div class="row">
                            <input type="hidden" name="id" id="mtr_id">
                            <div class="col-lg-12 mb-3">
                                <label for="mtr_course_id" class="form-label">Mata Kuliah <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" name="course_id" id="mtr_course_id"
                                    style="width: 100% !important;" required>
                                    <option value="" disabled selected>Pilih Mata Kuliah</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-course_id"></span>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="mtr_title" class="form-label">Judul Materi Kuliah <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="mtr_title" name="title"
                                    placeholder="Inputkan Nama Mata Kuliah" autocomplete="off" required>
                                <span class="text-danger error-title"></span>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="mtr_file_path" class="form-label">File Materi</label>
                                <input class="form-control" type="file" id="mtr_file_path" name="file_path" required>
                                <span class="text-danger error-file_path"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" style="border: 1px solid #DADCE0; border-radius: 8px;"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn"
                            style="background: var(--main-bg-primary);color: white;">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function drawTable() {
            if ($.fn.DataTable.isDataTable('#table-materials')) {
                $('#table-materials').DataTable().clear().destroy();
            }
            $('#table-materials').DataTable({
                paging: true,
                searching: true,
                info: true,
                responsive: true,
                ajax: {
                    url: 'api/materials',
                    type: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + '{{ session('tkn') }}',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataSrc: '',
                    data: function(d) {},
                },
                "columns": [{
                        "title": "No",
                        "data": null,
                        "width": "5%",
                        "class": "text-center"
                    },
                    {
                        "title": "Mata Kuliah",
                        "data": "courses.name"
                    },
                    {
                        "title": "Judul Materi Kuliah",
                        "data": "title"
                    },
                    {
                        "title": "Tanggal",
                        "data": "created_at",
                        "class": "text-center",
                        "render": function(data, type, row, meta) {
                            if (data) {
                                return moment(data).format('ll')
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        "title": "Aksi",
                        "data": null,
                        "width": "15%",
                        "class": "text-center",
                        "render": function(data, type, row) {
                            return `
                                    <a href="javascript:void(0)" onclick="delete_materi(${row.id})" type="button" class="btn btn-sm btn-danger" title="Hapus Data">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="unduh_materi(${row.id})" type="button" class="btn btn-sm btn-primary" title="Unduh Materi">
                                        <i class="fas fa-file-download"></i>
                                    </a>
                                    `;
                        }
                    }
                ],
                "columnDefs": [{
                    "targets": 0,
                    "searchable": false,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                }]
            });
        }

        $("#form_create_materi").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'api/materials',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('tkn') }}',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(res) {
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            $('#addMateri').modal('hide');
                            drawTable();
                        });
                    } else {
                        toastr.error(res.message);

                        if (res.data.name) {
                            $('.error-name').text(res.data.name[0]);
                        }
                        if (res.data.description) {
                            $('.error-description').text(res.data.description[0]);
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error('Error! ' + errorThrown);
                }
            });
        });

        function delete_materi(id) {
            Swal.fire({
                title: 'Yakin hapus data ini?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus data!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'api/materials/' + id,
                        type: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + '{{ session('tkn') }}',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                text: res.message,
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(() => {
                                drawTable();
                            });
                        }
                    });
                }
            });
        }

        function unduh_materi(id) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "api/materials/" + id + "/download",
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('tkn') }}',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    var fileParameter = encodeURIComponent(data.file);
                    window.location.href = 'api/unduh?file=' + fileParameter;
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        $(document).ready(function() {
            drawTable();
        });
    </script>
@endsection
