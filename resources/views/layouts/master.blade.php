<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.header')

    @include('layouts.partials.styles')
</head>

<body>
<!-- wrapper -->
<div class="wrapper">
    <!--header-->

    @include('layouts.partials.top_bar')

    <!--end header-->

    <!--page-wrapper-->
    <div class="page-wrapper">
        <!--sidebar-wrapper-->

        @include('layouts.partials.sidebar')

        <!--end sidebar-wrapper-->

        <!--page-content-wrapper-->
        <div class="page-content-wrapper">

            @include('layouts.partials.error_message')

            @yield('content')

        </div>
        <!--end page-content-wrapper-->
    </div>
    <!--end page-wrapper-->
    <!--start overlay-->
    <div class="overlay toggle-btn-mobile"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <!--footer -->
    @include('layouts.partials.footer')
    <!-- end footer -->
</div>
<!-- end wrapper -->

    <!--start switcher-->

    <!--end switcher-->

    @include('layouts.partials.scripts')

</body>

</html>