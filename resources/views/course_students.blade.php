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
                                <h4 class="mt-2" id="subtitle">Data Mata Kuliah</h4>
                                <small>Berikut adalah data mata kuliah yang anda pilih di dalam sistem.</small>
                            </div>
                            <div class="col-lg-6" id="btn_create">
                                <a class="btn float-right" href="javascript:void(0)" onclick="add_course()"
                                    style="background: var(--main-bg-primary); color: #FFFFFF;border-radius: 8px;"><i
                                        class="fas fa-plus mr-2"></i> Tambah Mata Kuliah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table-course_students"
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
    <div class="modal fade" id="addCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Courses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_add_cource" enctype="multipart/form-data">
                    <div class="modal-body form">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="table-daftar_courses"
                                        width="100%" cellspacing="0">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" style="border: 1px solid #DADCE0; border-radius: 8px;"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn"
                            style="background: var(--main-bg-primary);color: white;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function drawTable() {
            if ($.fn.DataTable.isDataTable('#table-course_students')) {
                $('#table-course_students').DataTable().clear().destroy();
            }
            $('#table-course_students').DataTable({
                paging: true,
                searching: true,
                info: true,
                responsive: true,
                ajax: {
                    url: 'api/course_students',
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
                        "title": "Nama Mata Kuliah",
                        "data": "name"
                    },
                    {
                        "title": "Deskripsi",
                        "data": "description"
                    },
                    {
                        "title": "Dosen",
                        "data": "lecturer.name"
                    },
                    {
                        "title": "Aksi",
                        "data": null,
                        "width": "15%",
                        "class": "text-center",
                        "render": function(data, type, row) {
                            return `
                                    <a href="javascript:void(0)" onclick="edit_course(${row.id})" type="button" class="btn btn-sm btn-primary" title="Tugas">
                                        <i class="fas fa-file"></i>
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

        $("#form_add_cource").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'api/add_course_students',
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
                            $('#addCourse').modal('hide');
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

        function add_course(id) {
            event.preventDefault();
            $.ajax({
                type: "GET",
                url: "api/add_course_students",
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('tkn') }}',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    $('#addCourse').modal('show');

                    if ($.fn.DataTable.isDataTable('#table-daftar_courses')) {
                        $('#table-daftar_courses').DataTable().clear().destroy();
                    }
                    $('#table-daftar_courses').DataTable({
                        paging: true,
                        searching: true,
                        info: true,
                        responsive: true,
                        data: data,
                        "columns": [{
                                "title": "No",
                                "data": null,
                                "width": "5%",
                                "class": "text-center"
                            },
                            {
                                "title": "Nama Mata Kuliah",
                                "data": "name"
                            },
                            {
                                "title": "Deskripsi",
                                "data": "description"
                            },
                            {
                                "title": "Dosen",
                                "data": "lecturer.name"
                            },
                            {
                                "title": "Aksi",
                                "data": null,
                                "width": "3%",
                                "class": "text-center",
                                "render": function(data, type, row) {
                                    return `
                                        <div class='form-check'>
                                            <input class='form-check-input' type='checkbox' id='course_id' name='course_id[]' value='${row.id}'>
                                        </div>
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

        $(document).ready(function() {
            drawTable();
        });
    </script>
@endsection
