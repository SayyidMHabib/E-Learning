@extends('layouts.main')

@section('content')
    <div class="page-content" style="margin-top: 50px;">

        <div class="page-content-wrapper mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card shadow-sm" onclick="location.href='{{ url('courses') }}'" style="cursor: pointer">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <a class="btn"
                                            style="font-size: 28px;margin: 10px 5px 10px 5px;background-color: #F2F3F7;"><i
                                                class="fas fa-book" style="color: #09227F;"></i></a>
                                    </div>
                                    <div class="col-10">
                                        <a href="" class="text-primary ml-4 mt-1"
                                            style="font-size: 18px;font-weight: bold;">Total Mata Kuliah</a>
                                        <div class="text-dark ml-4" style="font-size: 28px;font-weight: bold;">
                                            {{ $count_courses }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <a class="btn"
                                            style="font-size: 28px;margin: 10px 5px 10px 5px;background-color: #F2F3F7;"><i
                                                class="fas fa-user-tie" style="color: #09227F;"></i></a>
                                    </div>
                                    <div class="col-10">
                                        <a href="" class="text-primary ml-4 mt-1"
                                            style="font-size: 18px;font-weight: bold;">Total Dosen</a>
                                        <div class="text-dark ml-4" style="font-size: 28px;font-weight: bold;">
                                            {{ $count_lecturers }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <a class="btn"
                                            style="font-size: 28px;margin: 10px 5px 10px 5px;background-color: #F2F3F7;"><i
                                                class="fas fa-user-graduate" style="color: #09227F;"></i></a>
                                    </div>
                                    <div class="col-10">
                                        <a href="" class="text-primary ml-4 mt-1"
                                            style="font-size: 18px;font-weight: bold;">Total Mahasiswa</a>
                                        <div class="text-dark ml-4" style="font-size: 28px;font-weight: bold;">
                                            {{ $count_students }}
                                        </div>
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
@endsection
