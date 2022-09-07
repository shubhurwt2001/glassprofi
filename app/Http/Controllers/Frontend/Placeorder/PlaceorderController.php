<?php

namespace App\Http\Controllers\Frontend\Placeorder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Validator;



use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use stdClass;

class PlaceorderController extends Controller
{


    public function success(Request $request)
    {
        if (!$request->transactionid) {
            return abort(404);
        }
        $order = Order::where('order_id', $request->transactionid)->first();

        if (!$order) {
            return abort(404);
        }




        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://testapi.multisafepay.com/v1/json/orders/' . $request->transactionid . '?api_key=' . env('MULTISAFEPAY_SECRET'), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
        $payment = json_decode($response->getBody());

        if ($payment->success == false) {
            return abort(404);
        } else {
            if ($payment->data->status == "completed") {
                $order->payment_status = 1;
                $order->order_status = 1;
                $order->save();
                if (Auth::check()) {
                    Cart::where('user_id', Auth::user()->id)->delete();
                }
                session()->forget('delivery_date');
                session()->forget('cart');
                session()->forget('checkout_details');

                return redirect('order/' . $request->transactionid);
            } elseif ($payment->data->status == "declined") {
                OrderDetail::where('order_id', $order->id)->delete();
                Order::where('id', $order->id)->delete();
                $msg = 'Payment Declined';
                return view('errors.payment', compact('msg'));
            } elseif ($payment->data->status == "expired") {
                OrderDetail::where('order_id', $order->id)->delete();
                Order::where('id', $order->id)->delete();
                $msg = 'Payment Link Expired';
                return view('errors.payment', compact('msg'));
            } else {
                return abort(404);
            }
        }
    }

    public function error(Request $request)
    {
        if (!$request->transactionid) {
            return abort(404);
        }
        $order = Order::where('order_id', $request->transactionid)->first();

        if (!$order) {
            return abort(404);
        }

        OrderDetail::where('order_id', $order->id)->delete();
        Order::where('id', $order->id)->delete();
        $msg = 'Payment Declined';
        return view('errors.payment', compact('msg'));
    }
}
