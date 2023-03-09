<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cashflow | Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gray-300">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="px-5 pt-5">
                                    <span class="text-gray-900 text-lg font-weight-bold text-monospace">LOGIN</span>
                                </div>
                                <div class="px-5 pt-4">
                                    <div class="text-left mb-4">
                                        <h1 class="h5 text-gray">Silahkan masuk untuk melanjutkan</h1>
                                    </div>
                                    <form class="user" action="{{route('post-login')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control form-control-lg @error('username') is-invalid @enderror" value="{{old('username')}}" style="border-radius: 2rem" autocomplete="off">
                                            @error('username')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" style="border-radius: 2rem">
                                            @error('password')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                              <div class="form-check">
                                                <input type="checkbox" id="remember" class="form-check-input" name="remember">
                                                <label for="remember" class="form-check-label">
                                                  Ingat saya
                                                </label>
                                              </div>
                                            </div>
                                            <div class="col-4">
                                              <button type="submit" class="btn btn-success btn-block">Masuk</button>
                                            </div>
                                          </div>
                                    </form>
                                    <div class="text-center mt-5 mb-4 text-monospace">
                                        <hr>
                                        <p>Sistem Informasi kas</p>
                                        <h1 class="h5 text-gray-900 mb-1 font-weight-bold"> {{ App\Instansi::first()->nama }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>
    @include('sweetalert::alert')

</body>

</html>
