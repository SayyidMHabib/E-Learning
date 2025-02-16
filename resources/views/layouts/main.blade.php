<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <title>{{ $title }} | E-Learning</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- datepicker -->
    <link href="{{ asset('libs/air-datepicker/css/datepicker.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- jvectormap -->
    <link href="{{ asset('libs/jqvmap/jqvmap.min.css') }}" rel="stylesheet" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Selectize -->
    <link href="{{ asset('libs/selectize/css/selectize.css') }}" rel="stylesheet" type="text/css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css">
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <!-- Summernote css -->
    <link href="{{ asset('libs/summernote/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />

    <!-- Import Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

    <style>
        :root {
            --main-bg-gradient: linear-gradient(#0758CC, #09227F);
            --main-bg-gradient-right: linear-gradient(to right, #0758CC, #09227F);
            --main-bg-primary: #09227F;
        }

        table.dataTable thead tr {
            background-image: var(--main-bg-gradient);
            color: white;
        }

        body {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        .mm-active .active {
            color: #FFFFFF !important;
            background-image: var(--main-bg-gradient);
        }


        .bootstrap-tagsinput {
            width: 100%;
            border-radius: 3px;
        }

        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white;
            background-color: var(--main-bg-primary);
            padding: 3px;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
        }

        select2-selection__rendered {
            line-height: 34px !important;
        }

        .select2-container .select2-selection--single {
            height: 35px !important;
        }

        .select2-selection__arrow {
            height: 34px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 32px;
        }

        thead th {
            text-align: center;
        }
    </style>

</head>

<body data-topbar="colored">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar" style="background-image: var(--main-bg-gradient-right);">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('images/logo-sm-dark.png') }}" alt="" width="25px">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('images/logo-dark.png') }}" alt="" width="100px">
                            </span>
                        </a>

                        <a href="" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('images/logo-sm-light.png') }}" alt="" width="25px">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('images/logo-light.png') }}" alt="" width="100px">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="mdi mdi-backburger"></i>
                    </button>

                    <a class="btn d-inline text-white" style="border-color: white;margin: 20px 5px 20px 5px;"><i
                            class="fa fa-home"></i></a>
                    <h4 class="text-white d-inline" style="margin: 27px 5px 20px 5px;">{{ $title }}</h4>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ml-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-sm-inline-block mr-2">{{ session('name') }}
                                ({{ session('level') == 1 ? 'Dosen' : 'Mahasiswa' }})</span>

                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('images/users/user.jpg') }}" alt="Header Avatar">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item" href="#" id="btn_logout">
                                <i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Logout
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li class="{{ $active == 'dashboard' ? 'mm-active' : '' }}">
                            <a href="{{ url('/dashboard') }}"
                                class="waves-effect menu-link {{ $active == 'dashboard' ? 'active' : '' }}">
                                <div class="d-inline-block icons-sm mr-1"><i class="fa fa-home"></i></div>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        @if (session('level') == 1)
                            <li class="{{ $active == 'courses' ? 'mm-active' : '' }}">
                                <a href="{{ url('/courses') }}"
                                    class="waves-effect menu-link {{ $active == 'courses' ? 'active' : '' }}">
                                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-list-ul"></i></div>
                                    <span>Mata Kuliah</span>
                                </a>
                            </li>

                            <li class="{{ $active == 'materials' ? 'mm-active' : '' }}">
                                <a href="{{ url('/materials') }}"
                                    class="waves-effect menu-link {{ $active == 'materials' ? 'active' : '' }}">
                                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-file-invoice"></i>
                                    </div>
                                    <span>Materi Kuliah</span>
                                </a>
                            </li>
                        @elseif (session('level') == 2)
                            <li class="{{ $active == 'course_students' ? 'mm-active' : '' }}">
                                <a href="{{ url('/course_students') }}"
                                    class="waves-effect menu-link {{ $active == 'course_students' ? 'active' : '' }}">
                                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-list-ul"></i></div>
                                    <span>Mata Kuliah</span>
                                </a>
                            </li>
                        @endif


                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div id="content">
                @yield('content')

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <strong>E-Learning</strong> &copy; <?= date('Y') ?> . All Right Reserved
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"
        integrity="sha512-L7jgg7T9UbYc7hXogUKssqe1B5MsgrcviNxsRbO53dDSiw/JxuA/4kVQvEORmZJ6Re3fVF3byN5TT7czo9Rdug=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>

    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

    <!-- datepicker -->
    <script src="{{ asset('libs/air-datepicker/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('libs/air-datepicker/js/i18n/datepicker.en.js') }}"></script>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- apexcharts -->
    <!-- <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script> -->

    <script src="{{ asset('libs/jquery-knob/jquery.knob.min.js') }}"></script>

    <!-- Jq vector map -->
    <script src="{{ asset('libs/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('libs/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <script src="{{ asset('js/pages/dashboard.init.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Spectrum colorpicker -->
    <script src="{{ asset('libs/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Selectize -->
    <script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- Form Advanced init -->
    <script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>

    <!-- Summernote js -->
    <script src="{{ asset('libs/summernote/summernote-bs4.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('js/pages/summernote.init.js') }}"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>

    <script>
        moment.locale('id');
        $(document).ready(function() {
            $('.select2').select2();
            $(".alert-message").delay(2500).slideUp('slow');
        });

        $('input, select, textarea').on('input change', function() {
            let fieldName = $(this).attr('name');
            $('.error-' + fieldName).text('');
        });

        $("#btn_logout").on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin keluar dari aplikasi?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes !!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "api/logout",
                        processData: false,
                        contentType: false,
                        headers: {
                            'Authorization': 'Bearer ' + '{{ session('tkn') }}',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function(res) {
                            location.href = 'login';
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            toastr.error('Error! ' + errorThrown);
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
