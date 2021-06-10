<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @section('title', 'Register')
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('js/select.dataTables.min.css') }}"> --}}
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css.map') }}">
        <!-- endinject -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    @section('css')

    @endsection

</head>

<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                            <div class="brand-logo">
                                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
                            </div>

                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>

                            <form class="pt-3" method="post" action="{{ route('register') }}">

                                @csrf

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Username" name="name">
                                    <span class="alert-danger">{{ $errors->first('name') }}</span>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" placeholder="Email" name="email">
                                    <span class="alert-danger">{{ $errors->first('email')}}</span>
                                </div>
                                
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" name="password">
                                    <span class="alert-danger">{{ $errors->first('password')}}</span>
                                </div>
                                
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" placeholder="Confirm Password" name="password_confirmation">
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            I agree to all Terms & Conditions
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary mr-2 w-100">SIGN UP</button>
                                </div>

                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="{{ URL::to('/login')}}" class="text-primary">Login</a>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- End custom js for this page-->

    @section('js')

    @endsection

</body>

</html>
