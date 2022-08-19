@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="page-content">

        <div>
            <h4>Hi, {{ Auth::user()->name }}</h4>
            <h4>You are login as {{ ucfirst(session('user_role')) }}</h4>
            <h4>Welcome to Dashboard</h4>
        </div>
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6>Total Category</h6>
                                <h4 class="font-weight-bold mb-0">{{ $total_category }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6>Total Product</h6>
                                <h4 class="font-weight-bold mb-0">{{ $total_product }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6>Total User</h6>
                                <h4 class="font-weight-bold mb-0">{{ $total_user }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6>Total Admin</h6>
                                <h4 class="font-weight-bold mb-0">{{ $total_admin }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection