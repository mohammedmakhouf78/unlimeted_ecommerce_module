@extends('admin.master')

@push('title')
    Create Buy Order
@endpush


@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="margin-bottom:24px;">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Create Buy Order<span class="badge badge-success"></span></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST" action="{{route('admin.order.createBuyOrder')}}">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <select name="supplier_id" id="supplier_id" class="form-control">
                                <option value="">Choose Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" name="total" id="total" class="form-control">
                        </div>
                        <div class="col">
                            <input type="number" name="discount" id="discount" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col">
                            <input type="number" name="total_after_discount" id="total_after_discount" class="form-control">
                        </div>
                        <div class="col">
                            <input type="number" name="paid" id="paid" class="form-control">
                        </div>
                        <div class="col">
                            <input type="number" name="left" id="left" class="form-control">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Buy Price</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Total After Discount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="supplier_id" class="form-control supplier_id">
                                            <option value="">Choose Supplier</option>
                                            @foreach ($productDetails as $productDetail)
                                                <option value="{{$productDetail->id}}">
                                                    {{$productDetail->product->name ?? ''}} -
                                                    {{$productDetail->store->name ?? ''}} -
                                                    {{$productDetail->unit->name ?? ''}} -
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control quantity" name="quantity">
                                    </td>
                                    <td>100</td>
                                    <td>300</td>
                                    <td>15</td>
                                    <td>285</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
