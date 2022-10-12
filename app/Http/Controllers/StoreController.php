<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\StoreStoreRequest;
use App\Http\Requests\Store\StoreUpdateRequest;
use App\Models\Store;
use RealRashid\SweetAlert\Facades\Alert;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $name     = (isset(\request()->name) && \request()->name != '') ? \request()->name : null;
        $type     = (isset(\request()->type) && \request()->type != '') ? \request()->type : null;
        $order_by = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';


        $data = Store::query();
        // $data = new Store;
        if($name != null){
            $data = $data->where('name', 'LIKE', "%" . $name . "%");
        }
        if($type != null){
            $data = $data->where('type', $type);
        }
        $data = $data->orderBy('id',$order_by);
        $data = $data->paginate($limit_by);
        
        return view('admin.pages.store.index',[
            'stores' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.store.create',[
            'types' => Store::TYPE
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
        Store::create([
            'name'  =>  $request->name,
            'type'  =>  $request->type
        ]);

        Alert::success('Stores', 'Store Updated Successfully');
        return redirect(route('admin.store.index'));    }

    /**
     * Display the specified resource.
     *
     * @param  int  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        return view('admin.pages.store.edit',[
            'store' => $store,
            'types' => Store::TYPE
        ]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRequest $request, Store $store)
    {
        $store->update([
            'name'  =>  $request->name,
            'type'  =>  $request->type
        ]);

        Alert::success('Stores', 'Store Updated Successfully');
        return redirect(route('admin.store.index'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();

        Alert::success('Stores', 'Store Deleted Successfully');
        return redirect()->back();  
    }
}
