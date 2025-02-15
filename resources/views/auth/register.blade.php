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
                                        <h6>Please enter your account information</h6>
                                    </div>
                                    <form class="form_register" id="form_register">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control w-100" id="name" name="name"
                                                value="" placeholder="Enter your name" autocomplete="off" required>
                                            <span class="text-danger error-name"></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control w-100" id="email" name="email"
                                                value="" placeholder="Enter your email" aria-describedby="emailHelp"
                                                autocomplete="off" required>
                                            <span class="text-danger error-email"></span>
                                        </div>
                                        <div class="mb-4" style="position: relative;">
                                            <label for="password" class="form-label">Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                aria-describedby="passwordHelpBlock" placeholder="Enter your password">
                                            <span class="eye2" id="eye2" onclick="Password()">
                                                <i id="hidenp2" class="fa fa-eye"></i>
                                                <i id="hidenp1" class="fa fa-eye-slash"></i>
                                            </span>
                                            <span class="text-danger error-password"></span>
                                        </div>

                                        <div class="mb-4" style="position: relative;">
                                            <label for="confirm_password" class="form-label">Confirm Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" id="confirm_password" name="confirm_password"
                                                class="form-control" aria-describedby="passwordHelpBlock"
                                                placeholder="Enter your confirm password">
                                            <span class="eye3" id="eye3" onclick="confirmPassword()">
                                                <i id="hidecnp2" class="fa fa-eye"></i>
                                                <i id="hidecnp1" class="fa fa-eye-slash"></i>
                                            </span>
                                            <span class="text-danger error-confirm_password"></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="level" class="form-label">Level <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2" name="level" id="level" required>
                                                <option value="" disabled selected>Pilih Level User</option>
                                                <option value="1">Dosen</option>
                                                <option value="2">Mahasiswa</option>
                                            </select>
                                            <span class="text-danger error-level"></span>
                                        </div>

                                        <button type="submit" class="btn mt-3 w-100"
                                            style="background-image: linear-gradient(to right, #0758CC, #09227F); border-radius: 8px; color: #FFFFFF;">Registration</button>
                                    </form>
                                </div>
                                <div class="text-center">
                                    <p style="font-size: 14px">Sudah punya akun? <a href="login">Login</a>
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

    <script>
        let eye2 = document.getElementById('eye2');
        let eye3 = document.getElementById('eye3');

        function Password() {
            var x = document.getElementById("password");
            var y = document.getElementById("hidenp1");
            var z = document.getElementById("hidenp2");

            if (x.type === 'password') {
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            } else {
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
            }
        }

        function confirmPassword() {
            var x = document.getElementById("confirm_password");
            var y = document.getElementById("hidecnp1");
            var z = document.getElementById("hidecnp2");

            if (x.type === 'password') {
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            } else {
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
            }
        }

        $('input, select').on('input change', function() {
            let fieldName = $(this).attr('name');
            $('.error-' + fieldName).text(''); // Hapus pesan error untuk field ini
        });


        $("#form_register").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "api/register",
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(res) {
                    if (res.success) {
                        toastr.success(res.message);
                        setTimeout(() => {
                            location.href = 'login';
                        }, 1000);
                    } else {
                        toastr.error(res.message);

                        if (res.data.name) {
                            $('.error-name').text(res.data.name[0]);
                        }
                        if (res.data.email) {
                            $('.error-email').text(res.data.email[0]);
                        }
                        if (res.data.password) {
                            $('.error-password').text(res.data.password[0]);
                        }
                        if (res.data.confirm_password) {
                            $('.error-confirm_password').text(res.data.confirm_password[0]);
                        }
                        if (res.data.level) {
                            $('.error-level').text(res.data.level[0]);
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error('Error! ' + errorThrown);
                }
            });
        });
    </script>
@endsection
