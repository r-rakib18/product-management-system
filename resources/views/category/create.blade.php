@extends('layouts.master')

@section('title')
    Category
@endsection

@section('content')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">Category</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javaScript:void(0);"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Category Create</li>
                    </ol>
                </nav>
            </div>

            <div class="ml-auto">
                @if(has_role('category_view',$permission))
                <div class="btn-group">
                    <a href="{{ route('category.index') }}" class="btn btn-primary"><i class=""></i>
                        Category List</a>
                </div>
                @endif
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form id="storeCategory">
                            @csrf
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="name" id="name" placeholder="Category Name" value="{{ old('name') }}" class="form-control">
                                        <small class="text-danger" id="name_error"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-4">
                                        <textarea name="description" id="description" placeholder="Category Description" value="{{ old('description') }}" class="form-control" rows="2" cols="3"></textarea>
                                        <small class="text-danger" id="description_error"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="select2" name="status" id="status">
                                            <option value="default" disabled selected>Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <small class="text-danger" id="status_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary px-4">Save Category</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

    </div>
@endsection

@section('script')
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "progressBar" : true,
                "positionClass": "toast-top-right"
            };
            
            function clearError() {
                $('#name_error').text('');
                $('#description_error').text('');
                $('#status_error').text('');
            }

            $('#storeCategory').submit(function (e) {
                e.preventDefault();
                let formdata = $(this).serialize();

                $.ajax({
                    url: '/category',
                    data: formdata,
                    type: 'POST',
                    success: function (data) {
                        clearError();
                        $('#name').val(''),
                        $('#description').val(''),
                        $('#status').val('default').trigger('change'),
                        toastr.success(data.success);
                    },
                    error: function (error) {
                        $('#name_error').text(error.responseJSON.errors.name);
                        $('#description_error').text(error.responseJSON.errors.description);
                        $('#status_error').text(error.responseJSON.errors.status);
                        toastr.error('Something Went Wong. Please try again!!');
                    }
                })
            })
        });


        $('.select2').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

    </script>
@endsection
