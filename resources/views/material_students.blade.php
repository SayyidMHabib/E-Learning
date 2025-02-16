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
                                <small>Berikut adalah data materi kuliah yang anda pilih di dalam sistem.</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table-materialstudents"
                                width="100%" cellspacing="0">
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>

    <script>
        function drawTable() {
            if ($.fn.DataTable.isDataTable('#table-materialstudents')) {
                $('#table-materialstudents').DataTable().clear().destroy();
            }
            $('#table-materialstudents').DataTable({
                paging: true,
                searching: true,
                info: true,
                responsive: true,
                ajax: {
                    url: 'api/materialstudents',
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
                                    <a href="javascript:void(0)" onclick="unduh_materi(${row.courses.id})" type="button" class="btn btn-sm btn-primary" title="Unduh Materi">
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
