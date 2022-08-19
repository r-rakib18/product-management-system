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
                        <li class="breadcrumb-item active" aria-current="page">Manage Category</li>
                    </ol>
                </nav>
            </div>

            @if(has_role('category_create',$permission))
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="{{ route('category.create') }}" class="btn btn-success"><i class="lni lni-plus"></i>
                            Add Category</a>
                    </div>
                </div>
            @endif
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
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr id="row_id_{{$category->id}}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    @if($category->status == 1)
                                        <span class="badge badge-pill badge-primary">Active</span>
                                    @elseif($category->status == 0)
                                        <span class="badge badge-pill badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if(has_role('category_edit'))
                                        <a class="btn btn-primary btn-sm"
                                           href="{{ route('category.edit', $category->id)  }}"><i
                                                    class="fas fa-edit"></i></a>
                                    @endif

                                    @if(has_role('$category_delete'))
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm delete"
                                           data-id="{{ $category->id }}"><i
                                                    class="fas fa-trash"></i></a>
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
                "progressBar": true,
                "positionClass": "toast-top-right"
            };

            $('body').on('click', '.delete', function (e) {

                if (confirm("Delete Category?") == true) {
                    var id = $(this).data('id');
                    console.log(id);
                    // ajax
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('/category') }}" + '/' + id,
                        data: {id: id},
                        dataType: 'json',
                        success: function (data) {
                            $("#row_id_" + id).remove();
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

