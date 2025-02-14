@extends('layouts.main')

@section('content')
    <div class="main-content">

        <div class="page-content" style="margin-top: 50px;">

            <div class="page-content-wrapper mt-3">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <a class="btn"
                                                style="font-size: 28px;margin: 10px 5px 10px 5px;background-color: #F2F3F7;"><i
                                                    class="fas fa-book" style="color: #09227F;"></i></a>
                                        </div>
                                        <div class="col-10">
                                            <a href="" class="text-primary ml-4 mt-1"
                                                style="font-size: 18px;font-weight: bold;">Total Article</a>
                                            <div class="text-dark ml-4" style="font-size: 28px;font-weight: bold;">
                                                10</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <a class="btn"
                                                style="font-size: 28px;margin: 10px 5px 10px 5px;background-color: #F2F3F7;"><i
                                                    class="fas fa-atom" style="color: #09227F;"></i></a>
                                        </div>
                                        <div class="col-10">
                                            <a href="" class="text-primary ml-4 mt-1"
                                                style="font-size: 18px;font-weight: bold;">Total Event</a>
                                            <div class="text-dark ml-4" style="font-size: 28px;font-weight: bold;">
                                                20</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <a class="btn"
                                                style="font-size: 28px;margin: 10px 5px 10px 5px;background-color: #F2F3F7;"><i
                                                    class="fas fa-user" style="color: #09227F;"></i></a>
                                        </div>
                                        <div class="col-10">
                                            <a href="" class="text-primary ml-4 mt-1"
                                                style="font-size: 18px;font-weight: bold;">Admin</a>
                                            <div class="text-dark ml-4" style="font-size: 28px;font-weight: bold;">
                                                30</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <a class="btn"
                                                style="font-size: 28px;margin: 10px 5px 10px 5px;background-color: #F2F3F7;"><i
                                                    class="fas fa-edit" style="color: #09227F;"></i></a>
                                        </div>
                                        <div class="col-10">
                                            <a href="" class="text-primary ml-4 mt-1"
                                                style="font-size: 18px;font-weight: bold;">Author</a>
                                            <div class="text-dark ml-4" style="font-size: 28px;font-weight: bold;">
                                                40</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->


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
@endsection
