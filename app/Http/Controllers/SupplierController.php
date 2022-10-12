<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;

class SupplierController extends Controller
{
    public function index()
    {
        $name     = (isset(\request()->name) && \request()->name != '') ? \request()->name : null;
        $email     = (isset(\request()->email) && \request()->email != '') ? \request()->email : null;
        $address     = (isset(\request()->address) && \request()->address != '') ? \request()->address : null;
        $phone     = (isset(\request()->phone) && \request()->phone != '') ? \request()->phone : null;
        $order_by = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';


        $data = Supplier::query();
        if($name != null){
        $data = $data->where('name', 'LIKE', "%" . $name . "%");
        }
        if($email != null){
        $data = $data->where('email', $email);
        }
        if($address != null){
        $data = $data->where('address', $address);
        }
        if($phone != null){
        $data = $data->where('phone', $phone);
        }

        $data = $data->orderBy('id',$order_by);
        $data = $data->paginate($limit_by);

        return view('admin.pages.supplier.index',[
            'suppliers' => $data
        ]);

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
     * @param  \App\Http\Requests\StoreSupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
