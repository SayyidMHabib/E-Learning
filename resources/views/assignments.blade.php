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
                                <h4 class="mt-2" id="subtitle">Data Tugas Mata Kuliah</h4>
                                <small>Berikut adalah data tugas mata kuliah yang ada di dalam sistem.</small>
                            </div>
                            <div class="col-lg-6" id="btn_create">
                                <button class="btn float-right" data-toggle="modal" data-target="#addAssignment"
                                    style="background: var(--main-bg-primary); color: #FFFFFF;border-radius: 8px;"><i
                                        class="fas fa-file-upload mr-2"></i> Tambah Tugas</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table-assignments"
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
    <div class="modal fade" id="addAssignment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Tugas Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_create_assignment" enctype="multipart/form-data">
                    <div class="modal-body form">
                        <div class="row">
                            <input type="hidden" name="id" id="asg_id">
                            <div class="col-lg-12 mb-3">
                                <label for="asg_course_id" class="form-label">Mata Kuliah <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" name="course_id" id="asg_course_id"
                                    style="width: 100% !important;" required>
                                    <option value="" disabled selected>Pilih Mata Kuliah</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-course_id"></span>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="asg_title" class="form-label">Judul Tugas <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="asg_title" name="title"
                                    placeholder="Inputkan Nama Tugas Mata Kuliah" autocomplete="off" required>
                                <span class="text-danger error-title"></span>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="asg_description" class="form-label">Deskripsi <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="asg_description" placeholder="Inputkan Deskripsi" class="form-control"></textarea>
                                <span class="text-danger error-description"></span>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="asg_deadline" class="form-label">Deadline Tugas <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control date" id="asg_deadline" name="deadline"
                                    placeholder="Inputkan Deadline Tugas" required>
                                <span class="text-danger error-deadline"></span>
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

    {{-- modal submission students --}}
    <div class="modal fade" id="submissionStudents" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Tugas Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="my-4" id="subtitle">Tugas : <span id="name_assignment"></span></h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped"
                                    id="table-submission_students" width="100%" cellspacing="0">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="border: 1px solid #DADCE0; border-radius: 8px;"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function drawTable() {
            if ($.fn.DataTable.isDataTable('#table-assignments')) {
                $('#table-assignments').DataTable().clear().destroy();
            }
            $('#table-assignments').DataTable({
                paging: true,
                searching: true,
                info: true,
                responsive: true,
                ajax: {
                    url: 'api/assignments',
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
                        "title": "Judul",
                        "data": "title"
                    },
                    {
                        "title": "Deskripsi",
                        "data": "description"
                    },
                    {
                        "title": "Deadline",
                        "data": "deadline",
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
                                    <a href="javascript:void(0)" onclick="delete_assignment(${row.id})" type="button" class="btn btn-sm btn-danger" title="Hapus Data">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="assignment_student(${row.id})" type="button" class="btn btn-sm btn-primary" title="Tugas Mahasiswa">
                                        <i class="fas fa-user-graduate"></i>
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

        $("#form_create_assignment").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'api/assignments',
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
                            location.reload();
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

        function delete_assignment(id) {
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
                        url: 'api/assignments/' + id,
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

        function assignment_student(id) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "api/assignments/" + id + "/submissions",
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('tkn') }}',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    $('#name_assignment').text(data.title);
                    $('#submissionStudents').modal('show');

                    if ($.fn.DataTable.isDataTable('#table-submission_students')) {
                        $('#table-submission_students').DataTable().clear().destroy();
                    }
                    $('#table-submission_students').DataTable({
                        paging: true,
                        searching: true,
                        info: true,
                        responsive: true,
                        data: data.submissions,
                        "columns": [{
                                "title": "No",
                                "data": null
                            },
                            {
                                "title": "Nama Mahasiswa",
                                "data": "student.name"
                            },
                            {
                                "title": "Aksi",
                                "data": null,
                                "render": function(data, type, row) {
                                    return `
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
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function unduh_materi(id) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "api/submissions/" + id + "/download",
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
