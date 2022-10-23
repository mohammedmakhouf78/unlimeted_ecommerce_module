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
            
        </div>
    </div>
@endsection



@push('js')
@endpush
