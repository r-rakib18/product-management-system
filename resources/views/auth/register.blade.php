<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>PMS</title>
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet"/>
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <!-- Icons CSS -->
    <link rel="stylesheet" href="assets/css/icons.css"/>
    <!-- App CSS -->
    <link rel="stylesheet" href="assets/css/app.css"/>
</head>

<body>
<!-- wrapper -->
<div class="wrapper">
    <div class="flash-message my-2">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
            @endif
        @endforeach
    </div>
    <div class="section-authentication">
        <div class="container-fluid">
            <div class="card mb-0">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <div class="col-md-4"></div>
                        <div class="col-12 col-lg-5 col-xl-4 d-flex align-items-stretch">
                            <div class="card mb-0 shadow-none bg-transparent w-100rounded-0">
                                <div class="card-body p-md-5">
                                    <h4 class=""><strong>Product Management System</strong></h4>
                                    <p>Register - (Manager)</p>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="full-name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   placeholder="Name" value="{{old('name')}}"/>
                                            <small class="text-danger">{{ $errors->first('name') }}</small>
                                        </div>
                                        <div class="form-group mt-4">
                                            <label for="user-email">Email</label>
                                            <input type="text" class="form-control" name="email" id="email"
                                                   placeholder="email@example.com" value="{{ old('email') }}"/>
                                            <small class="text-danger">{{ $errors->first('email') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="user-phone">Phone</label>
                                            <input type="text" maxlength="14" minlength="" name="phone"
                                                   id="phone" class="form-control" placeholder="Phone Number"
                                                   value="{{old('phone')}}"/>
                                            <small class="text-danger">{{ $errors->first('phone') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input class="form-control border-right-0" name="password"
                                                       type="password" id="password" value="{{old('password')}}">
                                            </div>
                                            <small class="text-danger">{{ $errors->first('password') }}</small>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block mt-4"><i
                                                    class='bx bxs-lock mr-1'></i>Register
                                        </button>
                                    </form>
                                    <div class="text-center mt-4">
                                        <p class="mb-0">Already have an account? <a href="{{route('login')}}">Login</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end wrapper -->

<!-- JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<!--select-2-->

<!--Password show & hide js -->

</body>

</html>
