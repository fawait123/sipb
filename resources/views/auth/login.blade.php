<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/logo_sipb.png') }}" type="image/png" />
    <!--plugins-->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/notifications/css/lobibox.min.css" />
    <link href="{{ asset('assets') }}/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets') }}/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('assets') }}/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/app.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/dark-theme.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/semi-dark.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/header-colors.css" />
    <title>Kecamatan Maospati - Login</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="{{ asset('assets/logo_sipb.png') }}" width="120" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign in</h3>
                                        <p>Don't have an account yet? <a href="authentication-signup.html">Sign up
                                                here</a>
                                        </p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="col-12">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" placeholder="Username" name="username">
                                                @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Enter
                                                    Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror border-end-0"
                                                        id="inputChoosePassword" placeholder="Enter Password"> <a
                                                        href="javascript:;" class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" name="remember" type="checkbox"
                                                        id="flexSwitchCheckChecked" checked>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckChecked">Remember Me</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end"> <a
                                                    href="authentication-forgot-password.html">Forgot Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bxs-lock-open"></i>Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--notification js -->
    <script src="{{ asset('assets') }}/plugins/notifications/js/lobibox.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/notifications/js/notifications.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/notifications/js/notification-custom-script.js"></script>
    <!--app JS-->
    <script src="{{ asset('assets') }}/js/app.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    @if ($message = Session::get('error'))
        <script>
            info_noti("{{ $message }}")
        </script>
    @endif
</body>

</html>
