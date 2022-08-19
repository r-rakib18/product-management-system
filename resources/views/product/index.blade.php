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
                        <li class="breadcrumb-item active" aria-current="page">Manage Product</li>
                    </ol>
                </nav>
            </div>

            <div class="ml-auto">
                @if(has_role('product_create',$permission))
                <div class="btn-group">
                    <a href="{{ route('product.create') }}" class="btn btn-success"><i class="lni lni-plus"></i> Add Product</a>
                </div>
                @endif
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Barcode</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr id="row_id_{{ $product->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->barcode }}</td>
                                    <td>
                                        @if($product->status == 1)
                                            <span class="badge badge-pill badge-primary">Active</span>
                                        @elseif($product->status == 0)
                                            <span class="badge badge-pill badge-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        @if(has_role('product_edit',$permission))
                                            <a class="btn btn-primary btn-sm" href="{{ route('product.edit', $product->id)  }}"><i
                                                    class="fas fa-edit"></i></a>
                                        @endif
                                        @if(has_role('product_delete',$permission))
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="{{ $product->id }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </form>
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

            $('body').on('click', '.delete', function (e) {

                if (confirm("Delete Product?") == true) {
                    var id = $(this).data('id');
                    console.log(id);
                    // ajax
                    $.ajax({
                        type:"DELETE",
                        url: "{{ url('/product') }}"+'/'+id,
                        data: { id: id },
                        dataType: 'json',
                        success: function(data){
                            $("#row_id_" + id).remove();
                            console.log("#row_"+data.id);
                            toastr.error(data.success);
                        },
                        error: function (data) {
                            toastr.error('Something Went Wong. Please try again!!');
                        }
                    });
                }
            });
        });
    </script>
@endsection

