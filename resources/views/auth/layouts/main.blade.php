<!doctype html>
<html lang="en">

<head>
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

        body {
            background-image: var(--main-bg-gradient-right);
            font-family: 'Poppins';
            font-style: normal;
            font-weight: normal;
            font-size: 16px;
            line-height: 26px;
            color: #3E3E3E;
        }

        .eye {
            position: absolute;
            top: 235px;
            right: 75px;
        }

        .eye2 {
            position: absolute;
            right: 10px;
            top: 54px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .eye3 {
            position: absolute;
            right: 10px;
            top: 54px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        #hide1 {
            display: none;
        }

        #hidenp1 {
            display: none;
        }

        #hidecnp1 {
            display: none;
        }

        p {
            font-size: 12px;
            color: #E01A21;
        }
    </style>

</head>

<body data-topbar="colored">

    <!-- Begin page -->
    <div id="layout-wrapper">

        @yield('contentAuth')

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
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

    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $(".alert-message").delay(2500).slideUp('slow');
        });
    </script>

</body>

</html>
