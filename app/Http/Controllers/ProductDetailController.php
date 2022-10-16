<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductDetailRequest;
use App\Http\Requests\UpdateProductDetailRequest;
use App\Models\ProductDetail;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ProductDetail $productDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductDetail $productDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductDetailRequest  $request
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductDetailRequest $request, ProductDetail $productDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDetail $productDetail)
    {
        //
    }
    public function getProductDetail(ProductDetail $productDetail)
    {
        return response()->json([
            'status' => 200,
            'productDetail' => $productDetail
        ]);
    }

    public function getProductDetails()
    {
        $productDetails = ProductDetail::with([
            'product:id,name,category_id',
            'product.category:id,name',
            'unit:id,name',
            'store:id,name'
            ])
            ->whereHas('product',function($productQuery){
                return $productQuery->where('is_published',true);
            })
            ->get();

        return response()->json([
            'status' => 200,
            'productDetails' => $productDetails
        ]);
    }
}
