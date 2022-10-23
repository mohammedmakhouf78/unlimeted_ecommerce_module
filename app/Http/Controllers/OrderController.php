<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\Profile;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    private $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function index()
    {
        return view('admin.pages.buy_order.index', [
            'buy_orders' => Order::where('status', 'buy')->get()
        ]);
    }

    public function createBuyOrderPage()
    {
        $suppliers = $this->supplier::select(['id','name'])->get();
        

        return view('admin.pages.order.createBuyOrderPage',[
            'suppliers' => $suppliers,
        ]);
    }

    public function createBuyOrder(OrderCreateRequest $request)
    {
        $order = Order::find(2);

        DB::transaction(function() use ($request){
            $order = Order::create([
                'orderable_id' => $request->supplier_id,
                'orderable_type' => Supplier::class,
                'total' => $request->order_total,
                'discount' => $request->order_discount,
                'total_after_discount' => $request->order_total_after_discount,
                'paid' => $request->paid,
                'left' => $request->left,
                'total_payed' => $request->paid,
                'status' => 'open',
                'type' => 'buy'
            ]);
    
            $orderDetailsData = [];
            foreach($request->product_detail_id as $index => $product_detail_id)
            {
                $orderDetailsData []= [ 
                    'order_id' => $order->id,
                    'product_details_id' => $product_detail_id,
                    'quantity' => $request->quantity[$index],
                    'price' => $request->buy_price[$index],
                    'total' => $request->total[$index],
                    'discount' => $request->discount[$index],
                    'total_after_discount' => $request->total_after_discount[$index]
                ];

                $productDetail = ProductDetail::find($product_detail_id);

                $productDetail->update([
                    'buy_price' => $request->buy_price[$index],
                    'quantity' => $productDetail->quantity + $request->quantity[$index]
                ]);
            }

            OrderDetail::insert($orderDetailsData);

            if($supplierProfile = $order->orderable->profile)
            {
                $supplierProfile->update([
                    'number_of_orders' => $supplierProfile->number_of_orders + 1,
                    'should_be_paid' => $supplierProfile->should_be_paid + $request->left
                ]);
            }
            else
            {
                Profile::create([
                    'profilable_type' => Supplier::class,
                    'profilable_id' => $request->supplier_id,
                    'number_of_orders' => 1,
                    'number_of_returns' => 0,
                    'should_pay' => 0,
                    'should_be_paid' => $request->left
                ]);
            }
        });

        Alert::success('asdfasdfas');
        return redirect()->back();
    }
}
