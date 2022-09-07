<?php

namespace App\Http\Controllers\Frontend\Login;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class Logincontroller extends Controller
{
    public function index()
    {
        return view('frontend.login.userlogin');
    }

    public function signin(Request $request)
    {

        if ($request->checkout == 1) {
            if (!$request->email) {
                return response()->json(['msg' => 'Email field is required.'], 500);
            }
            if (!$request->password) {
                return response()->json(['msg' => 'Password field is required.'], 500);
            }
        } else {
            $credentials = $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $email = $request->input('email');
            $useredetail = User::where(['email' => $email])->first();

            if ($request->checkout == 1) {

                $carts  = session()->get('cart');
                foreach ($carts as $cart) {
                    $new = new Cart();
                    $new->product_id = $cart->product_id;
                    $new->pro_cart_qty = $cart->quantity;
                    $new->user_id = $useredetail->id;
                    $new->extra_details = json_encode($cart->extra_details);
                    $new->save();
                }
                return response()->json(['msg' => 'Login successfull'], 200);
            } else {
                return redirect('/');
            }
        } else {
            $request->session()->flash('loginerror', 'Please enter valid Login Details');
            if ($request->checkout == 1) {
                return response()->json(['msg' => 'Please enter valid Login Details'], 500);
            } else {
                return redirect('/login');
            }
        }
    }

    public function signout()
    {
        //Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
