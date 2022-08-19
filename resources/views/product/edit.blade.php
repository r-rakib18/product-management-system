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
                        <li class="breadcrumb-item active" aria-current="page">Product Edit - {{ $product->name }}</li>
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
                        <form id="" method="post" action="{{ route('product.update', $product->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="name" id="name" placeholder="Product Name" value="{{ $product->name }}" class="form-control">
                                        <small class="text-danger" id="name_error">{{ $errors->first('name') }}</small>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Category<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="select2" name="category_id" id="category_id">
                                            <option value="" disabled selected>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="category_error">{{ $errors->first('category_id') }}</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Price<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="number" name="price" min="0" id="price" placeholder="Product Price" value="{{ $product->price }}" class="form-control">
                                        <small class="text-danger" id="price_error">{{ $errors->first('price') }}</small>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Quantity<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="number" name="quantity" id="quantity" min="0" placeholder="Product Quantity" value="{{ $product->quantity }}" class="form-control">
                                        <small class="text-danger" id="quantity_error">{{ $errors->first('quantity') }}</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Barcode<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="barcode" id="barcode" placeholder="Product Barcode" id="barcode" value="{{ $product->barcode }}" class="form-control">
                                        <small class="text-danger" id="barcode_error">{{ $errors->first('barcode') }}</small>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Status<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="select2" name="status" id="status">
                                            <option value="" disabled selected>Select Status</option>
                                            <option value="1" {{ $product->status == 1 ? 'selected' : ''}}>Active</option>
                                            <option value="0" {{ $product->status == 0 ? 'selected' : ''}}>Inactive</option>
                                        </select>
                                        <small class="text-danger" id="status_error">{{ $errors->first('status') }}</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-4">
                                        <textarea name="description" id="description" placeholder="Product Description" value="" class="form-control" rows="2" cols="3">{{ $product->description }}</textarea>
                                        <small class="text-danger" id="description_error">{{ $errors->first('description') }}</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary px-4">Update Product</button>
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

        $('.select2').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

    </script>
@endsection
