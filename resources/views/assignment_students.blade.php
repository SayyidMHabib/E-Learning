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
                                <small>Berikut adalah data tugas mata kuliah yang anda pilih di dalam sistem.</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table-assignment_students"
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
    <div class="modal fade" id="kumpulSubmission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Tugas Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_submission" enctype="multipart/form-data">
                    <div class="modal-body form">
                        <div class="row">
                            <input type="hidden" name="assignment_id" id="sbt_assignment_id">
                            <div class="col-lg-12 mb-3">
                                <label for="sbt_file_path" class="form-label">File Tugas</label>
                                <input class="form-control" type="file" id="sbt_file_path" name="file_path" required>
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
                                <table class="table table-bordered table-hover table-striped" id="table-submission_students"
                                    width="100%" cellspacing="0">
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
            if ($.fn.DataTable.isDataTable('#table-assignment_students')) {
                $('#table-assignment_students').DataTable().clear().destroy();
            }
            $('#table-assignment_students').DataTable({
                paging: true,
                searching: true,
                info: true,
                responsive: true,
                ajax: {
                    url: 'api/assignment_students',
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
                                var deadline = moment(data);
                                var today = moment();
                                var isLate = deadline.isBefore(today, 'day');

                                return "<p style='font-weight: bold; " + (isLate ? "color: white;" : "") +
                                    "'>" + moment(data).format('ll') + "</p>";
                            } else {
                                return '-';
                            }
                        },
                        createdCell: function(td, cellData, rowData, row, col) {
                            var deadline = moment(rowData.deadline);
                            var today = moment();
                            var isLate = deadline.isBefore(today, 'day');

                            if (isLate) {
                                $(td).css('background-color', '#d80032');
                                $(td).css('color', 'white');
                            }
                        }
                    },
                    {
                        "title": "Aksi",
                        "data": null,
                        "width": "15%",
                        "class": "text-center",
                        "render": function(data, type, row) {
                            if (row.submissions && row.submissions.length > 0) {
                                return `<span class="badge bg-success">Sudah Submit</span>`;
                            } else {
                                return `
                                    <a href="javascript:void(0)" onclick="submission(${row.id})" type="button" class="btn btn-sm btn-primary" title="Kumpul Tugas">
                                        <i class="fas fa-file-upload"></i>
                                    </a>
                                    `;
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

        function submission(id) {
            $('#sbt_assignment_id').val(id);
            $('#kumpulSubmission').modal('show');
        }

        $("#form_submission").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'api/submission_students',
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

        $(document).ready(function() {
            drawTable();
        });
    </script>
@endsection
