<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\Country;
use App\Models\Backend\Navbar;
use App\Models\Backend\ProductAttributeImage;
use App\Models\Backend\ShippingCharge;
use App\Models\Backend\ProductList;
use App\Models\MeasureQuote;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use stdClass;
use Illuminate\Support\Str;
//use Session;

class CartController extends Controller
{
    public function add__cart(Request $request)
    {

        if (Auth::guard('web')->check()) {

            if ($request->edit) {
                $model = Cart::where('id', $request->edit)->first();
            } else {
                $model = new Cart;
                $model->pro_cart_qty = 1;
            }
            $userId = Auth::id();

            $model->product_id = $request->cartist_id;
            $model->user_id = $userId;
            // $model->user_type = "Reg";
            $model->extra_details = $request->finalData ? json_encode($request->finalData) : null;
            $model->save();
            //$data['wishlist_count'] = Wishlist::where("user_id", "=", auth()->id())->count();
            $data['cart_count'] = Cart::where("user_id", "=", auth()->id())->count();
            $data = json_encode($data);
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $data,
            ]);
            // }
        } else {
            $id = $request->cartist_id;
            $cart = session()->get('cart', []);

            if ($request->edit) {
                foreach ($cart as $c) {
                    if ($c->id == $request->edit) {
                        $c->extra_details =  $request->finalData;
                    }
                }
            } else {
                $item = new stdClass();
                $item->id = uniqid();
                $item->product_id = $id;
                $item->user_type = "Non-Reg";
                $item->extra_details =  $request->finalData;
                $item->quantity = 1;

                array_push($cart, $item);
                session()->put('cart', $cart);
            }


            $data['cart_count'] = count(session()->get('cart'));
            $data = json_encode($data);
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $data,
            ]);
        }
    }


    public function user_cart()
    {
        if (Auth::guard('web')->check()) {
            $user_id = Auth::guard('web')->id();
            $data['cart_list_count'] = Cart::where('user_id', '=', $user_id)->get()->count();

            $carts = DB::table('carts')
                ->join('product_lists', 'product_lists.id', '=', 'carts.product_id')
                ->where('carts.user_id', '=', $user_id)
                ->select('carts.id as cartId', 'carts.extra_details', 'carts.pro_cart_qty as quantity', 'product_lists.id as prodID', 'product_lists.navbars_id', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.slug', 'product_lists.delivery_time', 'product_lists.pro_shipping_charge')
                ->get();


            foreach ($carts as $cart) {
                // dd($cart);
                // $cart->quantity = $cart->pro_cart_qty;
                $cart->value = 0;
                if ($cart->extra_details) {
                    $cart->extra_details = json_decode($cart->extra_details);
                    $attributes = [];
                    foreach ($cart->extra_details as $extra) {
                        // dd($extra);
                        foreach ($extra->attributes as $attribute) {
                            $attribute->image_details = null;
                            if ($attribute->image != null) {
                                $attr = new stdClass();
                                $attr->image = $attribute->image;
                                $attr->unit = $attribute->unit;
                                $attr->dimensions = $attribute->dimensions;
                                $attributes[] = $attr;

                                $attribute->image_details = ProductAttributeImage::where('id', $attribute->image)->first();

                                $sides = new stdClass();
                                $sides->a = 0;
                                $sides->b = 0;
                                $sides->c = 0;
                                $sides->d = 0;
                                $sides->tarif =  $attribute->image_details->attr_price_from;
                                $sides->divider = $attribute->unit == "mm" ? 1000 : 100;

                                foreach ($attribute->dimensions as $dimension) {
                                    if ($dimension->side == "a") {
                                        $sides->a = $dimension->value;
                                    }
                                    if ($dimension->side == "b") {
                                        $sides->b = $dimension->value;
                                    }
                                    if ($dimension->side == "c") {
                                        $sides->c = $dimension->value;
                                    }
                                    if ($dimension->side == "d") {
                                        $sides->d = $dimension->value;
                                    }
                                }
                                $attribute->image_details->total_price = $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                                $cart->value = $cart->value + $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                            } else {
                                $attribute->dimensions = [];
                            }
                        }
                    }
                }
            }


            $data['product_cart_list'] = $carts;
            $data['country'] = Country::get();
            $arr = $data['product_cart_list'];

            // dd();
            // array($arr);
            $data['delivery'] = 0;
            foreach ($carts as  $cart) {
                if ($data['delivery'] < $cart->delivery_time) {
                    $data['delivery'] = $cart->delivery_time;
                }
            }

            if (count($data['product_cart_list']) > 0) {

                $pro = $data['product_cart_list'][count($data['product_cart_list']) - 1];

                $pro->child = Navbar::where('id', $pro->navbars_id)->first();
                $pro->parent = Navbar::where('id', $pro->child->parent_category_id)->first();
            }

            return view('frontend.cart.cart_new', $data);
        } else {
            if (session()->has('cart')) {
                $data['cart_list_count'] = count(session()->get('cart'));
                $data['product_cart_list'] = [];
                $carts = session()->get('cart');
                foreach ($carts as $cart) {
                    // dd($attribute);

                    $product = DB::table('product_lists')
                        ->where('id', '=', $cart->product_id)
                        ->select('product_lists.id as prodID', 'product_lists.navbars_id', 'product_lists.name', 'product_lists.slug', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time', 'product_lists.pro_shipping_charge')
                        ->first();
                    if ($cart->extra_details) {

                        $product->value = 0;
                        // dd($count);

                        // $productIn = DB::table('product_lists')
                        //     ->where('id', '=', $cart->product_id)
                        //     ->select('product_lists.id as prodID','product_lists.navbars_id', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time','product_lists.pro_shipping_charge')
                        //     ->first();
                        $attributes = [];
                        foreach ($cart->extra_details as &$extra) {
                            foreach ($extra['attributes'] as &$attribute) {
                                $attribute = (array)$attribute;
                                $attribute['image_details'] = null;
                                if ($attribute['image'] != null) {
                                    $attr = new stdClass();
                                    $attr->image = $attribute['image'];
                                    $attr->unit = $attribute['unit'];
                                    $attr->dimensions = $attribute['dimensions'];
                                    // $attr->image_details = 
                                    $attributes[] = $attr;
                                    $attribute['image_details'] = ProductAttributeImage::where('id', $attribute['image'])->first();

                                    $sides = new stdClass();
                                    $sides->a = 0;
                                    $sides->b = 0;
                                    $sides->c = 0;
                                    $sides->d = 0;
                                    $sides->tarif =  $attribute['image_details']->attr_price_from;
                                    $sides->divider = $attribute['unit'] == "mm" ? 1000 : 100;

                                    foreach ($attribute['dimensions'] as $dimension) {
                                        if ($dimension['side'] == "a") {
                                            $sides->a = $dimension['value'];
                                        }
                                        if ($dimension['side'] == "b") {
                                            $sides->b = $dimension['value'];
                                        }
                                        if ($dimension['side'] == "c") {
                                            $sides->c = $dimension['value'];
                                        }
                                        if ($dimension['side'] == "d") {
                                            $sides->d = $dimension['value'];
                                        }
                                    }

                                    // dd($count);
                                    $attribute['image_details']->total_price =  $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                                    // $dimension['value'] = ;
                                    $product->value = $product->value + $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                                } else {
                                    $attribute['dimensions'] = [];
                                }
                            }
                        }
                    } else {
                        $product = DB::table('product_lists')
                            ->where('id', '=', $cart->product_id)
                            ->select('product_lists.id as prodID', 'product_lists.navbars_id', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time', 'product_lists.slug', 'product_lists.pro_shipping_charge')
                            ->first();
                    }
                    $product->extra_details = $cart->extra_details;
                    $product->quantity = $cart->quantity;
                    $product->uniqID = $cart->id;
                    $data['product_cart_list'][] = $product;
                }
            } else {
                $data['cart_list_count'] = "0";
                $data['product_cart_list'] = [];
            }


            $data['delivery'] = 0;
            foreach ($data['product_cart_list'] as  $cart) {
                if ($data['delivery'] < $cart->delivery_time) {
                    $data['delivery'] = $cart->delivery_time;
                }
            }

            if (count($data['product_cart_list']) > 0) {

                $pro = $data['product_cart_list'][count($data['product_cart_list']) - 1];

                $pro->child = Navbar::where('id', $pro->navbars_id)->first();
                $pro->parent = Navbar::where('id', $pro->child->parent_category_id)->first();
            }
            // dd($data['product_cart_list']);
            return view('frontend.cart.cart_new', $data);
        }
    }

    public function clear_cartlist()
    {
        try {
            if (Auth::guard('web')->check()) {
                $user_id = Auth::guard('web')->id();
                $data['clear_cart_list'] = Cart::where('user_id', '=', $user_id)->get();
                if (count($data['clear_cart_list']) > 0) {
                    foreach ($data['clear_cart_list'] as $delete_cart_lists) {
                        $delete_cart_lists->delete();
                    }

                    return redirect()->route('user.cart')->with('message', 'Cart cleared successfully');
                } else {
                    return redirect()->route('user.cart')->with('message', 'Cart already empty');
                }
            } else {
                if (session()->has('cart')) {
                    session()->forget('cart');
                    return redirect()->route('user.cart')->with('message', 'Cart cleared successfully');
                } else {
                    return redirect()->route('user.cart')->with('message', 'Cart already empty');
                }
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function remove_cartlist(Request $request)
    {
        try {
            if (Auth::guard('web')->check()) {
                $user_id = Auth::guard('web')->id();
                $clear_cart_list = Cart::where('id', '=', base64_decode($request->cart_id))->first();

                if ($clear_cart_list) {
                    $clear_cart_list->delete();
                    return redirect()->route('user.cart')->with('message', 'Cart item deleted successfully');
                } else {
                    return redirect()->route('user.cart')->with('message', 'Cart item cannot delete try after some time');
                }
            } else {
                $cart_id = base64_decode($request->cart_id);
                $carts = session()->get('cart');
                $newCart = [];
                foreach ($carts as $cart) {
                    if ($cart->id != $cart_id) {
                        $newCart[] = $cart;
                    }
                }

                session()->put('cart', $newCart);
                return redirect()->route('user.cart')->with('message', 'Cart item removed successfully');
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function update_cartlist(Request $request)
    {

        try {
            if (Auth::guard('web')->check()) {
                //$user_id = Auth::guard('web')->id();
                $update_cart_list = Cart::where('id', '=', base64_decode($request->cart_id))->first();

                if ($update_cart_list) {
                    $update_cart_list->quantity = $request->input('pro_cart_qty');
                    $update_cart_list->save();
                    //return redirect()->route('user.cart')->with('message', 'Cart item updated successfully');
                    session(['cart_message' => 'Cart item updated successfully']);
                    return response()->json([
                        'status' => 200,
                        'message' => 'Success',
                    ]);
                } else {
                    //return redirect()->route('user.cart')->with('message', 'Cart item cannot updated try after some time');
                    session(['cart_message' => 'Cart item cannot updated try after some time']);
                    return response()->json([
                        'status' => 201,
                        'message' => 'Fail',
                    ]);
                }
            } else {
                $carts = session()->get('cart');

                foreach ($carts as $cart) {
                    if ($cart->id == base64_decode($request->cart_id)) {
                        $cart->quantity = $request->pro_cart_qty;
                    }
                }
                session()->put('cart', $carts);
                return response()->json([
                    'status' => 200,
                    'message' => 'Success',

                ]);
            }
        } catch (\Exception $e) {
            abort(404);
            //return $e->getMessage();
        }
        //catch (Throwable $e) {  report($e); return false; }
    }


    public function cart_shipping_charge(Request $request)
    {
        try {



            $shipping_charge = ShippingCharge::where(['countries_id' => $request->count_id, 'postal_code' => $request->zip_code])->get();

            if (count($shipping_charge) > 0) {
                $cart_pro_total = $request->cart_pro_total;

                $shipping_charge = $shipping_charge[0]->shipping_charge;

                $data['total_amount_with_shipping_charge'] = $cart_pro_total + $shipping_charge;
                $data['total_amount_with_shipping_charge'] = json_encode($data['total_amount_with_shipping_charge']);
                $data['shipping_charge'] = json_encode($shipping_charge);

                return response()->json([
                    'status' => 200,
                    'message' => 'Success',
                    'data' => $data,
                ]);
            } else {
                $msg = "We don't provide delivery on this postal code please enter other postal code";
                return response()->json([
                    'status' => 400,
                    'message' => 'Fail',
                    'data' => $msg,

                ]);
            }
        } catch (\Exception $e) {
            //abort(404);
            return $e->getMessage();
        }
    }

    public function delivery_details(Request $request)
    {
        session()->put('delivery_date', $request->delivery_date);
        // dd(session()->get('checkout_details'));
        return view('frontend.cart.cart_step_2');
    }

    public function save_details(Request $request)
    {
        session()->forget('checkout_details');
        if (!Auth::check()) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users,email'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['msg' => 'The email is already registered. You may want to login.'], 500);
            }
        }


        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => ' required',
            'f_name' => 'required',
            'l_name' => 'required',
            'company' => 'required',
            'location' => 'required',
            'postcode' => 'required',
            'house_no' => 'required',
            'street' => 'required',
            'verzendwijze' => 'required',
            'place' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('email')) {
                return response()->json(['msg' => $errors->first('email')], 500);
            }
            if ($errors->has('phone')) {
                return response()->json(['msg' => $errors->first('phone')], 500);
            }

            if ($errors->has('f_name')) {
                return response()->json(['msg' => $errors->first('f_name')], 500);
            }
            if ($errors->has('l_name')) {
                return response()->json(['msg' => $errors->first('l_name')], 500);
            }
            if ($errors->has('company')) {
                return response()->json(['msg' => $errors->first('company')], 500);
            }
            if ($errors->has('location')) {
                return response()->json(['msg' => $errors->first('location')], 500);
            }
            if ($errors->has('postcode')) {
                return response()->json(['msg' => $errors->first('postcode')], 500);
            }
            if ($errors->has('house_no')) {
                return response()->json(['msg' => $errors->first('house_no')], 500);
            }
            if ($errors->has('street')) {
                return response()->json(['msg' => $errors->first('street')], 500);
            }
            if ($errors->has('verzendwijze')) {
                return response()->json(['msg' => $errors->first('verzendwijze')], 500);
            }
            if ($errors->has('place')) {
                return response()->json(['msg' => $errors->first('place')], 500);
            }
        }

        if ($request->account == 1) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                if ($errors->has('password_confirmation')) {
                    return response()->json(['msg' => $errors->first('password_confirmation')], 500);
                }
                if ($errors->has('password')) {
                    return response()->json(['msg' => $errors->first('password')], 500);
                }
            }


            $user = new User();
            $user->f_name = $request->f_name;
            $user->l_name = $request->l_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::login($user);

            $carts  = session()->get('cart');
            foreach ($carts as $cart) {
                $new = new Cart();
                $new->product_id = $cart->product_id;
                $new->pro_cart_qty = $cart->quantity;
                $new->user_id = $user->id;
                $new->extra_details = json_encode($cart->extra_details);
                $new->save();
            }
        }
        session()->put('checkout_details', $request->all());

        return response()->json(['msg' => 'Details saved'], 200);
    }


    public function order_details()
    {
        // dd(session()->get('checkout_details'));
        if (!session()->get('delivery_date') || !session()->get('checkout_details')) {
            return redirect('/cart');
        }

        if (Auth::guard('web')->check()) {
            $user_id = Auth::guard('web')->id();
            $data['cart_list_count'] = Cart::where('user_id', '=', $user_id)->get()->count();

            $carts = DB::table('carts')
                ->join('product_lists', 'product_lists.id', '=', 'carts.product_id')
                ->where('carts.user_id', '=', $user_id)
                ->select('carts.id as cartId', 'carts.extra_details', 'carts.pro_cart_qty as quantity', 'product_lists.id as prodID', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time', 'product_lists.pro_shipping_charge')
                ->get();


            foreach ($carts as $cart) {
                // dd($cart);
                // $cart->quantity = $cart->pro_cart_qty;
                $cart->value = 0;
                if ($cart->extra_details) {
                    $cart->extra_details = json_decode($cart->extra_details);
                    $attributes = [];
                    foreach ($cart->extra_details as $extra) {
                        // dd($extra);
                        foreach ($extra->attributes as $attribute) {
                            $attribute->image_details = null;
                            if ($attribute->image != null) {
                                $attr = new stdClass();
                                $attr->image = $attribute->image;
                                $attr->unit = $attribute->unit;
                                $attr->dimensions = $attribute->dimensions;
                                $attributes[] = $attr;

                                $attribute->image_details = ProductAttributeImage::where('id', $attribute->image)->first();

                                $sides = new stdClass();
                                $sides->a = 0;
                                $sides->b = 0;
                                $sides->c = 0;
                                $sides->d = 0;
                                $sides->tarif =  $attribute->image_details->attr_price_from;
                                $sides->divider = $attribute->unit == "mm" ? 1000 : 100;

                                foreach ($attribute->dimensions as $dimension) {
                                    if ($dimension->side == "a") {
                                        $sides->a = $dimension->value;
                                    }
                                    if ($dimension->side == "b") {
                                        $sides->b = $dimension->value;
                                    }
                                    if ($dimension->side == "c") {
                                        $sides->c = $dimension->value;
                                    }
                                    if ($dimension->side == "d") {
                                        $sides->d = $dimension->value;
                                    }
                                }
                                $attribute->image_details->total_price = $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                                $cart->value = $cart->value + $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                            } else {
                                $attribute->dimensions = [];
                            }
                        }
                    }
                }
            }


            $data['product_cart_list'] = $carts;
            $data['country'] = Country::get();


            // dd();
            // array($arr);
            $data['delivery'] = session()->get('delivery_date');

            $data['checkout_details'] = session()->get('checkout_details');
            // dd($data['delivery']);
            // 

            return view('frontend.cart.cart_step_3', $data);
        } else {
            if (session()->has('cart')) {
                $data['cart_list_count'] = count(session()->get('cart'));
                $data['product_cart_list'] = [];
                $carts = session()->get('cart');
                foreach ($carts as $cart) {
                    // dd($attribute);

                    $product = DB::table('product_lists')
                        ->where('id', '=', $cart->product_id)
                        ->select('product_lists.id as prodID', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time', 'product_lists.pro_shipping_charge')
                        ->first();
                    if ($cart->extra_details) {

                        $product->value = 0;
                        // dd($count);

                        // $productIn = DB::table('product_lists')
                        //     ->where('id', '=', $cart->product_id)
                        //     ->select('product_lists.id as prodID', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time','product_lists.pro_shipping_charge')
                        //     ->first();
                        $attributes = [];
                        foreach ($cart->extra_details as &$extra) {
                            foreach ($extra['attributes'] as &$attribute) {
                                $attribute = (array)$attribute;
                                $attribute['image_details'] = null;
                                if ($attribute['image'] != null) {
                                    $attr = new stdClass();
                                    $attr->image = $attribute['image'];
                                    $attr->unit = $attribute['unit'];
                                    $attr->dimensions = $attribute['dimensions'];
                                    // $attr->image_details = 
                                    $attributes[] = $attr;
                                    $attribute['image_details'] = ProductAttributeImage::where('id', $attribute['image'])->first();

                                    $sides = new stdClass();
                                    $sides->a = 0;
                                    $sides->b = 0;
                                    $sides->c = 0;
                                    $sides->d = 0;
                                    $sides->tarif =  $attribute['image_details']->attr_price_from;
                                    $sides->divider = $attribute['unit'] == "mm" ? 1000 : 100;

                                    foreach ($attribute['dimensions'] as $dimension) {
                                        if ($dimension['side'] == "a") {
                                            $sides->a = $dimension['value'];
                                        }
                                        if ($dimension['side'] == "b") {
                                            $sides->b = $dimension['value'];
                                        }
                                        if ($dimension['side'] == "c") {
                                            $sides->c = $dimension['value'];
                                        }
                                        if ($dimension['side'] == "d") {
                                            $sides->d = $dimension['value'];
                                        }
                                    }

                                    // dd($count);
                                    $attribute['image_details']->total_price =  $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                                    // $dimension['value'] = ;
                                    $product->value = $product->value + $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                                } else {
                                    $attribute['dimensions'] = [];
                                }
                            }
                        }
                    } else {
                        $product = DB::table('product_lists')
                            ->where('id', '=', $cart->product_id)
                            ->select('product_lists.id as prodID', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time', 'product_lists.pro_shipping_charge')
                            ->first();
                    }
                    $product->extra_details = $cart->extra_details;
                    $product->quantity = $cart->quantity;
                    $product->uniqID = $cart->id;
                    $data['product_cart_list'][] = $product;
                }
            } else {
                $data['cart_list_count'] = "0";
                $data['product_cart_list'] = [];
            }


            $data['delivery'] = session()->get('delivery_date');

            $data['checkout_details'] = session()->get('checkout_details');


            return view('frontend.cart.cart_step_3', $data);
        }
    }



    public function place_order(Request $request)
    {
        if (!session()->get('delivery_date') || !session()->get('checkout_details')) {
            return response()->json(['msg' => 'something went wrong!', 'code' => 400], 400);
        }

        if ($request->payment_type != 1 && $request->payment_type != 2) {
            return response()->json(['msg' => 'Please select a payment method.', 'code' => 500], 500);
        }

        $checkout = session()->get('checkout_details');
        $delivery_date =  session()->get('delivery_date');

        if ($request->payment_type == 1) {
            $payment_type = 'direct';
        } else {
            $payment_type = 'invoice';
        }

        if (Auth::guard('web')->check()) {
            $user_id = Auth::guard('web')->id();

            $carts = DB::table('carts')
                ->join('product_lists', 'product_lists.id', '=', 'carts.product_id')
                ->where('carts.user_id', '=', $user_id)
                ->select('carts.id as cartId', 'carts.extra_details', 'carts.pro_cart_qty as quantity', 'product_lists.id as prodID', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time', 'product_lists.pro_shipping_charge')
                ->get();

            $total = 0;
            $delivery = 0;
            foreach ($carts as $cart) {
                // dd($cart);
                // $cart->quantity = $cart->pro_cart_qty;
                $cart->value = 0;
                if ($cart->extra_details) {
                    $cart->extra_details = json_decode($cart->extra_details);
                    $attributes = [];
                    foreach ($cart->extra_details as $extra) {
                        // dd($extra);
                        foreach ($extra->attributes as $attribute) {
                            $attribute->image_details = null;
                            if ($attribute->image != null) {
                                $attr = new stdClass();
                                $attr->image = $attribute->image;
                                $attr->unit = $attribute->unit;
                                $attr->dimensions = $attribute->dimensions;
                                $attributes[] = $attr;

                                $attribute->image_details = ProductAttributeImage::where('id', $attribute->image)->first();

                                $sides = new stdClass();
                                $sides->a = 0;
                                $sides->b = 0;
                                $sides->c = 0;
                                $sides->d = 0;
                                $sides->tarif =  $attribute->image_details->attr_price_from;
                                $sides->divider = $attribute->unit == "mm" ? 1000 : 100;

                                foreach ($attribute->dimensions as $dimension) {
                                    if ($dimension->side == "a") {
                                        $sides->a = $dimension->value;
                                    }
                                    if ($dimension->side == "b") {
                                        $sides->b = $dimension->value;
                                    }
                                    if ($dimension->side == "c") {
                                        $sides->c = $dimension->value;
                                    }
                                    if ($dimension->side == "d") {
                                        $sides->d = $dimension->value;
                                    }
                                }
                                $attribute->image_details->total_price = $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                                $cart->value = $cart->value + $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                            } else {
                                $attribute->dimensions = [];
                            }
                        }
                    }
                }
                $delivery = $delivery + $cart->pro_shipping_charge;
                $total = $total + $cart->value;
            }


            $data['product_cart_list'] = $carts;
        } else {
            if (!session()->get('cart')) {
                return response()->json(['msg' => 'something went wrong!', 'code' => 400], 400);
            }

            $data['product_cart_list'] = [];
            $carts = session()->get('cart');

            $total = 0;
            $delivery = 0;
            foreach ($carts as $cart) {
                // dd($attribute);

                $product = DB::table('product_lists')
                    ->where('id', '=', $cart->product_id)
                    ->select('product_lists.id as prodID', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time', 'product_lists.pro_shipping_charge')
                    ->first();
                if ($cart->extra_details) {

                    $product->value = 0;

                    $attributes = [];
                    foreach ($cart->extra_details as &$extra) {
                        foreach ($extra['attributes'] as &$attribute) {
                            $attribute = (array)$attribute;
                            $attribute['image_details'] = null;
                            if ($attribute['image'] != null) {
                                $attr = new stdClass();
                                $attr->image = $attribute['image'];
                                $attr->unit = $attribute['unit'];
                                $attr->dimensions = $attribute['dimensions'];
                                // $attr->image_details = 
                                $attributes[] = $attr;
                                $attribute['image_details'] = ProductAttributeImage::where('id', $attribute['image'])->first();

                                $sides = new stdClass();
                                $sides->a = 0;
                                $sides->b = 0;
                                $sides->c = 0;
                                $sides->d = 0;
                                $sides->tarif =  $attribute['image_details']->attr_price_from;
                                $sides->divider = $attribute['unit'] == "mm" ? 1000 : 100;

                                foreach ($attribute['dimensions'] as $dimension) {
                                    if ($dimension['side'] == "a") {
                                        $sides->a = $dimension['value'];
                                    }
                                    if ($dimension['side'] == "b") {
                                        $sides->b = $dimension['value'];
                                    }
                                    if ($dimension['side'] == "c") {
                                        $sides->c = $dimension['value'];
                                    }
                                    if ($dimension['side'] == "d") {
                                        $sides->d = $dimension['value'];
                                    }
                                }

                                // dd($count);
                                $attribute['image_details']->total_price =  $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                                // $dimension['value'] = ;
                                $product->value = $product->value + $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                            } else {
                                $attribute['dimensions'] = [];
                            }
                        }
                    }
                } else {
                    $product = DB::table('product_lists')
                        ->where('id', '=', $cart->product_id)
                        ->select('product_lists.id as prodID', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time', 'product_lists.pro_shipping_charge')
                        ->first();
                }

                $total = $total + $product->value;
                $delivery = $delivery + $product->pro_shipping_charge;
                $product->extra_details = $cart->extra_details;
                $product->quantity = $cart->quantity;
                $product->uniqID = $cart->id;
                $data['product_cart_list'][] = $product;
            }
        }

        if (Auth::check()) {
            $discount = Auth::user()->discount;
        } else {
            $discount = 0;
        }

        $discounted_value = $total - (($discount / 100) *  $total);
        $grand  = $discounted_value + $delivery;


        $order = new Order();
        $id = Order::latest()->first() ? Order::latest()->first()->id : 0;
        $order->order_id = Str::random(10) . ($id + 1);
        $order->user_id = Auth::check() ? Auth::user()->id : 'Non-Reg';
        $order->email = Auth::check() ? Auth::user()->email : $checkout['email'];
        $order->first_name = $checkout['f_name'];
        $order->last_name = $checkout['l_name'];
        $order->street = $checkout['street'];
        $order->place = $checkout['place'];
        $order->postcode = $checkout['postcode'];
        $order->phone = $checkout['phone'];
        $order->supplement = $checkout['supplement'];
        $order->country = $checkout['location'];
        $order->house_no = $checkout['house_no'];
        $order->company_name = $checkout['company'];
        $order->coupon_value = $discount;
        $order->discounted_value = $discounted_value;
        $order->total_amount = $total;
        $order->grand_total = $grand;
        $order->shipping_charge = $delivery;
        $order->delivery_type = $checkout['verzendwijze'];
        $order->delivery_date = $delivery_date;
        $order->payment_type = $payment_type;
        if ($request->payment_type == 2) {
            $order->order_status = 1;
        } else {
            $order->order_status = 0;
        }
        $order->payment_status = 2;
        $order->save();
        foreach ($data['product_cart_list'] as $cart) {
            $details = new OrderDetail();
            $details->order_id = $order->id;
            $details->product_lists_id = $cart->prodID;
            $details->price = $cart->value;
            $details->extra_details = Auth::check() ? json_encode($cart->extra_details) : json_encode($cart->extra_details);
            $details->qty = $cart->quantity;
            $details->save();
        }

        if ($request->payment_type == 2) {
            session()->forget('delivery_date');
            session()->forget('cart');
            session()->forget('checkout_details');

            if (Auth::check()) {
                Cart::where('user_id', Auth::user()->id)->delete();
            }

            return response()->json(['msg' => 'Order placed successfully', 'order_id' =>  $order->order_id, 'code' => 200], 200);
        } else {
            try {
                $client = new \GuzzleHttp\Client();

                $response = $client->request('POST', 'https://testapi.multisafepay.com/v1/json/orders?api_key=' . env('MULTISAFEPAY_SECRET'), [
                    'body' => '{"payment_options":{"close_window":false,"redirect_url":"https://jobportal.itexpertiseindia.com/glassprofi/success","cancel_url":"https://jobportal.itexpertiseindia.com/glassprofi/error"},"customer":{"locale":"nl_NL"},"checkout_options":{"validate_cart":false},"days_active":30,"seconds_active":900,"description":"Direct Pay on Glasprofi","currency":"EUR","order_id":"' . $order->order_id . '","amount":' . $grand * 100 . '}',
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                ]);

                $payment = json_decode($response->getBody());
                // return $payment;
                if ($payment->success  == true) {
                    return response()->json(['msg' => 'Payment link generated', 'link' =>  $payment->data->payment_url, 'code' => 201], 201);
                } else {
                    OrderDetail::where('order_id', $order->id)->delete();
                    Order::where('id', $order->id)->delete();
                    return response()->json(['msg' => 'Something went wrong!', 'code' => 400], 400);
                }
            } catch (Exception $e) {
                // return $payment;
                OrderDetail::where('order_id', $order->id)->delete();
                Order::where('id', $order->id)->delete();
                return response()->json(['msg' => $e->getMessage(), 'code' => 500], 500);
            }
        }
    }


    public function order($id)
    {
        $order = Order::where(['order_id' => $id, 'order_status' => 1])->first();

        if ($order) {
            if ($order->payment_type == "invoice" && $order->payment_status == 2) {
                $msg = 'Congratulations on your order! Invoice will be sent to your email account.';
            }

            if (($order->payment_type == 'direct' || $order->payment_type == "invoice") && $order->payment_status == 1) {
                $msg = 'Congratulations on your order!';
            }
            return view('frontend.cart.cart_final', compact('msg'));
        } else {
            return abort(404);
        }
    }


    public function measure_quote(Request $request)
    {
        if ($request->type == "measureForm") {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'phone' => 'required',
                'postalcode' => 'required',
                'f_name' => 'required',
                'l_name' => 'required',
                'street' => 'required',
                'place' => 'required',
                'house_no' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'phone' => 'required',
                'f_name' => 'required',
                'l_name' => 'required',
            ]);
        }

        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('postalcode')) {
                return response()->json(['msg' => $errors->first('postalcode')], 500);
            }
            if ($errors->has('street')) {
                return response()->json(['msg' => $errors->first('street')], 500);
            }
            if ($errors->has('house_no')) {
                return response()->json(['msg' => $errors->first('house_no')], 500);
            }
            if ($errors->has('place')) {
                return response()->json(['msg' => $errors->first('place')], 500);
            }

            if ($errors->has('email')) {
                return response()->json(['msg' => $errors->first('email')], 500);
            }
            if ($errors->has('phone')) {
                return response()->json(['msg' => $errors->first('phone')], 500);
            }
            if ($errors->has('f_name')) {
                return response()->json(['msg' => $errors->first('f_name')], 500);
            }
            if ($errors->has('l_name')) {
                return response()->json(['msg' => $errors->first('l_name')], 500);
            }
        }


        $quote = new MeasureQuote();
        $quote->email = $request->email;
        $quote->phone = $request->phone;
        $quote->f_name = $request->f_name;
        $quote->l_name = $request->l_name;
        $quote->place = $request->place;
        $quote->house_no = $request->house_no;
        $quote->street = $request->street;
        $quote->postalcode = $request->postalcode;
        $quote->reference = $request->reference;
        $quote->supplement = $request->supplement;
        $quote->comments = $request->comments;
        $quote->save();

        session()->forget('cart');
        session()->forget('delivery_date');
        session()->forget('checkout_details');

        if (Auth::check()) {
            Cart::where('user_id', Auth::user()->id)->delete();
        }
        return response()->json(['msg' => 'Form submitted successfully.'], 200);
    }
}
