<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function index(){
        $data['user_orders'] = Order::all();
       return view('backend.order.order_index', $data);
    }

    public function order_details(Request $request, $order_id){
        $order_id = base64_decode($order_id);
        $data['order_detail'] =  OrderDetail::where('orders_id', '=', $order_id)->get();
        return view('backend.order.order_details', $data);
    }
}
