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
                                <small>Berikut adalah data mata kuliah yang ada di dalam sistem.</small>
                            </div>
                            <div class="col-lg-6" id="btn_create">
                                <button class="btn float-right" data-toggle="modal" data-target="#addCourse"
                                    style="background: var(--main-bg-primary); color: #FFFFFF;border-radius: 8px;"><i
                                        class="fas fa-plus mr-2"></i> Tambah Mata Kuliah</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table-courses" width="100%"
                                cellspacing="0">
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_create_cource" enctype="multipart/form-data">
                    <div class="modal-body form">
                        <div class="row">
                            <input type="hidden" name="id" id="crs_id">
                            <div class="col-lg-12 mb-3">
                                <label for="crs_name" class="form-label">Nama Mata Kuliah <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="crs_name" name="name"
                                    placeholder="Inputkan Nama Mata Kuliah" autocomplete="off" required>
                                <span class="text-danger error-name"></span>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="crs_description" class="form-label">Deskripsi <small>(optional)</small></label>
                                <textarea name="description" id="crs_description" placeholder="Inputkan Deskripsi" class="form-control"></textarea>
                                <span class="text-danger error-description"></span>
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
            if ($.fn.DataTable.isDataTable('#table-courses')) {
                $('#table-courses').DataTable().clear().destroy();
            }
            $('#table-courses').DataTable({
                paging: true,
                searching: true,
                info: true,
                responsive: true,
                ajax: {
                    url: 'api/courses',
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
                        "data": null
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
                        "render": function(data, type, row) {
                            if (row.lecturer_id == {{ session('id') }}) {
                                return `
                                        <a href="javascript:void(0)" onclick="edit_course(${row.id})" type="button" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="delete_course(${row.id})" type="button" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        `;
                            } else {
                                return '';
                            }
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

        $("#form_create_cource").submit(function(e) {
            e.preventDefault();

            let id = $('#crs_id').val();
            let ajax_type = 'POST';
            let ajax_url = 'api/courses';
            let formData = new FormData(this);

            if (id) {
                ajax_url = 'api/courses/' + id;
            }

            $.ajax({
                type: ajax_type,
                url: ajax_url,
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('tkn') }}',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
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

        function edit_course(id) {
            event.preventDefault();
            $.ajax({
                type: "GET",
                url: "api/courses/" + id,
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('tkn') }}',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    $("#crs_id").val(data.id);
                    $("#crs_name").val(data.name);
                    $("#crs_description").val(data.description);

                    $('#addCourse').modal('show');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function delete_course(id) {
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
                        url: 'api/courses/' + id,
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

        $(document).ready(function() {
            drawTable();
        });
    </script>
@endsection
