@extends('admin.master')

@push('title')
Order By Table
@endpush

@push('css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="{{ asset('adminAssets/assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL CUSTOM STYLES -->
@endpush



@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="table-responsive mb-4 mt-4" style="padding:15px">



                <table class="table table-bordered table-hover table-condensed mb-4">



                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($buy_orders as $buy_order)
                            <tr>
                                <td>{{ $loop->iteration	 }}</td>
                                <td>{{ $store->total }}</td>
                                <td>{{ $store->status }}</td>
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
                                    {!! $stores->appends(request()->input())->links() !!}
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
