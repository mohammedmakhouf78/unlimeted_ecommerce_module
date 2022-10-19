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
                <form method="POST" action="{{ route('admin.order.createBuyOrder') }}">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <label for="">Supplier</label>
                            <select name="supplier_id" id="supplier_id" class="form-control">
                                <option value="">Choose Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="">Total</label>
                            <input type="number" step=".01" name="order_total" id="order_total" readonly
                                class="form-control text-black">
                        </div>
                        <div class="col">
                            <label for="">Discount</label>
                            <input type="number" name="order_discount" id="order_discount" class="form-control">
                        </div>
                    </div>


                    <div class="row mb-5">
                        <div class="col">
                            <label for="">Total After Discount</label>
                            <input type="number" name="order_total_after_discount" id="order_total_after_discount" readonly
                                class="form-control text-black">
                        </div>
                        <div class="col">
                            <label for="">Paid</label>
                            <input type="number" name="paid" id="paid" class="form-control">
                        </div>
                        <div class="col">
                            <label for="">Left</label>
                            <input type="number" name="left" id="left" readonly class="form-control text-black">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <a class="btn btn-success" id="addOrderItem">+</a>
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

                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        let count = 1;
        $.ajax({
            url: "/admin/productDetail/getProductDetails",
            success: function(response) {},
            error: function(res) {
                console.log(res);
            }
        }).then(function(res) {
            $('#addOrderItem').on('click', function() {
                $('table tbody').append(`
                    <tr>
                        <td>
                            <select name="product_detail_id[]" class="form-control product_detail_id" id="showProductDetails${count}">
                                <option value="">Choose Product ...</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control quantity" name="quantity[]" id="quantity">
                        </td>
                        <td>
                            <input type="text" name="buy_price[]" class="form-control buy_price" id="buy_price">
                        </td>
                        <td>
                            <input type="text" name="total[]" class="form-control total" id="total">
                        </td>
                        <td>
                            <input type="text" name="discount[]" class="form-control discount" id="discount">
                        </td>
                        <td>
                            <input type="text" name="total_after_discount[]" class="form-control total_after_discount" id="total_after_discount">
                        </td>
                    </tr>
                `)
                res.productDetails.forEach(productDetail => {
                    $(`#showProductDetails${count}`).append(`
                        <option value="${productDetail.id}">${productDetail.product.name} - ${productDetail.store.name} - ${productDetail.unit.name}</option>
                    `)
                });

                $('.product_detail_id').on('change', function() {
                    $.ajax({
                        url: "/admin/productDetail/getProductDetail/" + this.value,
                        success: (response) => {
                            let productDetail = response.productDetail
                            $(this).parent().parent().find('#buy_price').val(
                                productDetail.buy_price)
                            $(this).parent().parent().find('#discount').val(
                                productDetail.discount)
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    })
                })

                $('.quantity').on('input', function() {
                    let quantity = $(this).val()
                    let buy_price = $(this).parent().parent().find('#buy_price').val()
                    let discount = $(this).parent().parent().find('#discount').val()
                    let total = $(this).parent().parent().find('#total').val(quantity * buy_price)
                    let total_after_discount = $(this).parent().parent().find(
                        '#total_after_discount').val((quantity * buy_price) - discount)

                    calculateOrderTotal()
                    calculateOrderTotalAfterDiscount()
                    calculateLeft()

                })

                $('.buy_price').on('input', function() {
                    let buy_price = $(this).val()
                    let quantity = $(this).parent().parent().find('#quantity').val()
                    let discount = $(this).parent().parent().find('#discount').val()
                    let total = $(this).parent().parent().find('#total').val(quantity * buy_price)
                    let total_after_discount = $(this).parent().parent().find(
                        '#total_after_discount').val((quantity * buy_price) - discount)

                    calculateOrderTotal()
                    calculateOrderTotalAfterDiscount()
                    calculateLeft()

                })

                $('.discount').on('input', function() {
                    let discount = $(this).val()
                    let quantity = $(this).parent().parent().find('#quantity').val()
                    let buy_price = $(this).parent().parent().find('#buy_price').val()
                    let total_after_discount = $(this).parent().parent().find(
                        '#total_after_discount').val((quantity * buy_price) - discount)
                })


                count++

                calculateOrderTotalAfterDiscount()
                calculateLeft()

            })

        })


        function calculateOrderTotal() {
            let sum = 0;
            $('.total').each(function(index, element) {
                sum += parseFloat(element.value) ? parseFloat(element.value) : 0
            })
            $('#order_total').val(sum.toFixed(2))
        }

        function calculateOrderTotalAfterDiscount() {
            let order_total = $('#order_total').val()
            let order_discount_input = $('#order_discount') ;
            console.log(order_discount_input.val());
            if(parseFloat(order_discount_input.val()) >= order_total){
                order_discount_input.val(order_total)
            }

            order_total = parseFloat(order_total) ? parseFloat(order_total) : 0
            order_discount = parseFloat(order_discount_input.val()) ? parseFloat(order_discount_input.val()) : 0

            $('#order_total_after_discount').val(parseFloat(order_total - order_discount))




        }


        function calculateLeft() {
            let order_total_after_discount = $('#order_total_after_discount').val()
            let paid = $('#paid').val()

            order_total_after_discount = parseFloat(order_total_after_discount) ? parseFloat(order_total_after_discount) : 0
            paid = parseFloat(paid) ? parseFloat(paid) : 0

            $('#left').val(order_total_after_discount - paid)
        }

        $('#order_total').on('change', function() {
            calculateOrderTotalAfterDiscount()
            calculateLeft()
        })


        $('#order_discount').on('input', function() {
            calculateOrderTotalAfterDiscount()
            calculateLeft()
        })

        $('#paid').on('input', function() {
            calculateLeft()
        })
    </script>
@endpush
