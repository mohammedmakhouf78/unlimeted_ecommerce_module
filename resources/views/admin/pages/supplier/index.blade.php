@extends('admin.master')

@push('title')
    Supplier Table
@endpush

@push('css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="{{ asset('adminAssets/assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL CUSTOM STYLES -->
@endpush



@section('content')
    <div style="margin:20px">
        <button class="btn btn-primary">
            <a href="{{ route('admin.supplier.create') }}" style="color:white"> Add Supplier</a>
        </button>
    </div>
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="table-responsive mb-4 mt-4" style="padding:15px">

                @include('admin.pages.supplier.filter.filter')


                <table class="table table-bordered table-hover table-condensed mb-4">



                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                            <tr>
                                <td>{{ $loop->iteration	 }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>

                                    <a href="{{ route('admin.supplier.edit', $supplier->id) }}" title="Edit"
                                        class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="javascript:void(0);" title="Delete"
                                        onclick="if (confirm('Are you sure to delete this supplier?') ) { document.getElementById('supplier-delete-{{ $supplier->id }}').submit(); } else { return false; }"class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <form action="{{ route('admin.supplier.destroy', $supplier->id) }}" method="store"
                                        id="supplier-delete-{{ $supplier->id }}" style="display: none;">
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
                                    {!! $suppliers->appends(request()->input())->links() !!}
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
