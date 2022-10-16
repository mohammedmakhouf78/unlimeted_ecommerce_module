<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

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

    public function createBuyOrder(Request $request)
    {
        dd($request);
    }
}
