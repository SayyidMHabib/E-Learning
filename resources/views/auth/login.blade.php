@extends('auth.layouts.main')

@section('contentAuth')
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-5">

                <div class="my-5">
                    <img class="mx-auto d-block mt-5" src="{{ asset('images/logo-light.png') }}" style="width: 200px;">
                </div>

                <div class="card o-hidden my-3" style="border-radius: 10px;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="px-5 pt-5 pb-3">
                                    <div class="text-center mb-4">
                                        <h4>Welcome to E-Learning</h4>
                                        <h6>Please enter your email and password</h6>
                                    </div>
                                    <form class="form_login" id="form_login">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control w-100" id="email" name="email"
                                                value="" placeholder="Enter your email" aria-describedby="emailHelp"
                                                autocomplete="off" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" class="form-control w-100" id="password" name="password"
                                                placeholder="Enter your password" required>
                                            <span class="eye" style="margin-top: 19px;" onclick="myFunction()">
                                                <i id="hide2" class="fa fa-eye"></i>
                                                <i id="hide1" class="fa fa-eye-slash"></i>
                                            </span>
                                        </div>
                                        <button type="submit" class="btn mt-3 w-100"
                                            style="background-image: linear-gradient(to right, #0758CC, #09227F); border-radius: 8px; color: #FFFFFF;">Login</button>
                                    </form>
                                </div>
                                <div class="text-center">
                                    <p style="font-size: 14px">Belum punya akun? Ayo daftar <a href="register">disini</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center text-light">
                    &copy; Copyright E-Learning
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Select 2 -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script>
        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("hide1");
            var z = document.getElementById("hide2");

            if (x.type === 'password') {
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
                y.style.marginTop = "5px";
                z.style.marginTop = "5px";
            } else {
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
                y.style.marginTop = "5px";
                z.style.marginTop = "5px";
            }
        }

        $("#form_login").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "api/login",
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(res) {
                    if (res.success) {
                        toastr.success(res.message);
                        setTimeout(() => {
                            location.href = 'dashboard';
                        }, 1000);
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error('Error! ' + errorThrown);
                }
            });
        });
    </script>
@endsection
