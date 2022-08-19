<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>PMS</title>
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet"/>
    <script src="assets/js/pace.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="assets/css/icons.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="assets/css/app.css" />
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
                        <div class="col-md-4 col-lg-4 col-xl-4 "></div>
                        <div class="col-md-4 col-lg-4 col-xl-4 ">
                            <div class="card mb-0 shadow-none bg-transparent w-100  rounded-0">
                                <div class="card-body p-md-5">
                                    <h4 class=""><strong>Product Management System</strong></h4>
                                    <p>Log in to your account using Phone number or Email</p>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group mt-4">
                                            <label for="phone">Phone Number or Email</label>
                                            <input type="text" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="Enter email or phone "/>
                                            <small class="text-danger">{{ $errors->first('email') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password"/>
                                            <small class="text-danger">{{ $errors->first('password') }}</small>

                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="remember_me" class="custom-control-input" id="remember-me" checked>
                                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block mt-3"><i class='bx bxs-lock mr-1'></i>Login</button>
                                    </form>

                                    <div class="text-center mt-4">
                                        <p class="mb-0">Dont' have an account yet? <a href="{{route('register')}}">Create an account</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 "></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</body>
</html>
