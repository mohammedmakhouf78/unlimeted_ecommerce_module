@extends('admin.master')

@push('title')
    Store Table
@endpush

@push('css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="{{ asset('adminAssets/assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL CUSTOM STYLES -->
@endpush



@section('content')
    <div style="margin:20px">
        <button class="btn btn-primary">
            <a href="{{ route('admin.category.create') }}" style="color:white"> Add Category</a>
        </button>
    </div>
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="table-responsive mb-4 mt-4" style="padding:15px">

                @include('admin.pages.store.filter.filter')


                <table class="table table-bordered table-hover table-condensed mb-4">



                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration	 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>

                                    <a href="{{ route('admin.category.edit', $category->id) }}" title="Edit"
                                        class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="javascript:void(0);" title="Delete"
                                        onclick="if (confirm('Are you sure to delete this category?') ) { document.getElementById('store-delete-{{ $category->id }}').submit(); } else { return false; }"class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <form action="{{ route('admin.category.destroy', $category->id) }}" method="store"
                                        id="store-delete-{{ $category->id }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="4">No Data Found</td>
                            </tr>
                        @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7">
                                <div class="float-right">
                                </div>
                            </th>
                        </tr>
                    </tfoot>




                </table>
            </div>
        </div>
    </div>
@endsection



@push('js')
@endpush
