@extends('layouts.master')

@section('title')
    Product
@endsection

@section('content')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">Product</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javaScript:void(0);"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Product Create</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
                @if(has_role('product_view',$permission))
                <div class="btn-group">
                    <a href="{{ route('product.index') }}" class="btn btn-primary"><i class=""></i>
                        Product List</a>
                </div>
                @endif
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form id="storeProduct">
                            @csrf
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="name" id="name" placeholder="Product Name" value="{{ old('name') }}" class="form-control">
                                        <small class="text-danger" id="name_error"></small>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Category<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="select2" name="category_id" id="category_id">
                                            <option value="default" disabled selected>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="category_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Price<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="number" name="price" min="0" id="price" placeholder="Product Price" value="{{ old('price') }}" class="form-control">
                                        <small class="text-danger" id="price_error"></small>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Quantity<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="number" name="quantity" id="quantity" min="0" placeholder="Product Quantity" value="{{ old('quantity') }}" class="form-control">
                                        <small class="text-danger" id="quantity_error"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Barcode<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="barcode" id="barcode" placeholder="Product Barcode" id="barcode" value="{{ old('barcode') }}" class="form-control">
                                        <small class="text-danger" id="barcode_error"></small>
                                    </div>
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
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-4">
                                        <textarea name="description" id="description" placeholder="Product Description" value="{{ old('description') }}" class="form-control" rows="2" cols="3"></textarea>
                                        <small class="text-danger" id="description_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary px-4">Save Product</button>
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
                $('#category_error').text('');
                $('#price_error').text('');
                $('#quantity_error').text('');
                $('#barcode_error').text('');
                $('#status_error').text('');
                $('#description_error').text('');

            }

            $('#storeProduct').submit(function (e) {
                e.preventDefault();
                let formdata = $(this).serialize();

                console.log(formdata)

                $.ajax({
                    url: '/product',
                    data: formdata,
                    type: 'POST',
                    success: function (data) {
                        $('#name').val('');
                        $('#category_id').val('default').trigger('change');
                        $('#price').val('');
                        $('#quantity').val('');
                        $('#barcode').val('');
                        $('#description').val('');
                        $("#status").val('default').trigger('change'),
                        clearError();
                        toastr.success(data.success)
                    },
                    error: function (error) {
                        $('#name_error').text(error.responseJSON.errors.name);
                        $('#category_error').text(error.responseJSON.errors.category_id);
                        $('#price_error').text(error.responseJSON.errors.price);
                        $('#quantity_error').text(error.responseJSON.errors.quantity);
                        $('#barcode_error').text(error.responseJSON.errors.barcode);
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
