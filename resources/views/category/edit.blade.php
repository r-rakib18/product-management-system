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
                        <li class="breadcrumb-item active" aria-current="page">Category Edit - {{ $category->name }}</li>
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
                        <form id="" method="POST" action="{{ route('category.update', $category->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-4 {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <input type="text" name="name" id="name" placeholder="Category Name" value="{{ $category->name }}" class="form-control">
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-4 {{ $errors->has('description') ? ' has-error' : '' }}">
                                        <textarea name="description" id="description" placeholder="Category Description" value="" class="form-control" rows="2" cols="3">{{ $category->description }}</textarea>
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status<span class="text-danger">*</span></label>
                                    <div class="col-sm-4 {{ $errors->has('status') ? ' has-error' : '' }}">
                                        <select class="select2" name="status" id="status">
                                            <option value="" disabled selected>Select Status</option>
                                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('status') }}</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary px-4">Update Category</button>
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
