<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Slider;
use App\Models\Backend\ImageGallery;
use App\Models\Backend\ClientSay;
use App\Models\Backend\ProductList;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\WishList;
use App\Models\Cart;
use App\Models\Backend\Banner;
use App\Models\Backend\Navbar;
use App\Models\Backend\ProductAttributeImage;
use App\Models\Backend\ShippingCharge;



use Illuminate\Http\RedirectResponse;
use stdClass;

class HomeController extends Controller
{
    public function index()
    {
        $data['carousel'] = Slider::where('slider_status', '=', '1')->get();
        $data['banner'] = Banner::where('status', '=', '1')->get();
        $data['is_popular'] = ProductList::where(['pro_status' => '1', 'is_popular' => 'Yes'])
            ->orderBy('id', 'desc')
            //->select('id', 'name', 'navbars_id'
            ->take(8)
            ->get();
        $data['clientsay'] = ClientSay::where('status', '=', '1')->get();
        $data['imagegallery'] = ImageGallery::where('image_status', '=', '1')->get();

        $data['products_category'] = Navbar::with('parent')->where(['category_status' => '1', 'show_home_page' => 'Yes'])->orderby('id', 'desc')->take(5)->get();
        $data['home_products'] = ProductList::with('productimage')->where(['pro_status' => '1', 'show_on_homepage' => 'Yes'])->orderby('id', 'asc')->take(2)->get();

        return view('frontend.home.home', $data);
    }

    // public function adminlogin(){
    //     return view ('backend.adminlogin.login');
    // }

    public function check_out(Request $request)
    {

        $this->validate($request, [
            'shipping_country_cart' => 'required',
            'zip_code_cart' => 'required',
        ], [
            'zip_code_cart.required' => "Zip code is required",
        ]);


        if (Auth::guard('web')->check()) {
            $user_id = Auth::guard('web')->id();
            $data['cart_list_count'] = Cart::where('user_id', '=', $user_id)->get()->count();

            $carts = DB::table('carts')
                ->join('product_lists', 'product_lists.id', '=', 'carts.product_id')
                ->where('carts.user_id', '=', $user_id)
                ->select('carts.id as cartId', 'carts.extra_details', 'carts.pro_cart_qty', 'product_lists.id as prodID', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time')
                ->get();

            foreach ($carts as $cart) {
                if ($cart->extra_details) {
                    $loopCart = (json_decode($cart->extra_details));
                    $attributes = [];
                    foreach ($loopCart as $extra) {
                        // dd($extra);
                        foreach ($extra->attributes as $attribute) {
                            if ($attribute->image != null) {
                                $attr = new stdClass();
                                $attr->image = $attribute->image;
                                $attr->unit = $attribute->unit;
                                $attr->dimensions = $attribute->dimensions;
                                $attributes[] = $attr;
                            }
                        }
                    }

                    foreach ($attributes as $attribute) {
                        $image = ProductAttributeImage::where('id', $attribute->image)->first();
                        $sides = new stdClass();
                        $sides->a = 0;
                        $sides->b = 0;
                        $sides->c = 0;
                        $sides->d = 0;
                        $sides->tarif = $image->attr_price_from;
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

                        $cart->value = $cart->value + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                    }
                }
            }

            $data['product_cart_list'] = $carts;

            $getCartTotalamount = 0;
            foreach ($data['product_cart_list'] as $list) {
                $getCartTotalamount = $getCartTotalamount + ($list->pro_cart_qty * $list->value);
            }
            $data['getCartTotalamount'] = $getCartTotalamount;

            $shipping_country = $request->shipping_country_cart;
            $shipping_zipcode = $request->zip_code_cart;
            $data['checkout_shipping_charge'] = ShippingCharge::where(['countries_id' => $shipping_country, 'postal_code' => $shipping_zipcode])->get();
            $data['grand_total'] = $getCartTotalamount + $data['checkout_shipping_charge'][0]->shipping_charge;
        } else {
            if (session()->has('cart')) {
                $data['product_cart_list'] = [];
                // dd(session()->get('cart') );
                foreach (session()->get('cart') as $cart) {
                    if ($cart->extra_details) {
                        $product = DB::table('product_lists')
                            ->where('id', '=', $cart->product_id)
                            ->select('product_lists.id as prodID', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time')
                            ->first();

                        $attributes = [];
                        foreach ($cart->extra_details as $extra) {
                            foreach ($extra['attributes'] as $attribute) {
                                if ($attribute['image'] != null) {
                                    $attr = new stdClass();
                                    $attr->image = $attribute['image'];
                                    $attr->unit = $attribute['unit'];
                                    $attr->dimensions = $attribute['dimensions'];
                                    $attributes[] = $attr;
                                }
                            }
                        }

                        foreach ($attributes as $attribute) {
                            $image = ProductAttributeImage::where('id', $attribute->image)->first();
                            $sides = new stdClass();
                            $sides->a = 0;
                            $sides->b = 0;
                            $sides->c = 0;
                            $sides->d = 0;
                            $sides->tarif = $image->attr_price_from;
                            $sides->divider = $attribute->unit == "mm" ? 1000 : 100;

                            foreach ($attribute->dimensions as $dimension) {
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

                            $product->value = $product->value + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                        }
                    } else {
                        $product = DB::table('product_lists')
                            ->where('id', '=', $cart->product_id)
                            ->select('product_lists.id as prodID', 'product_lists.name', 'product_lists.pro_image', 'product_lists.value', 'product_lists.delivery_time')
                            ->first();
                    }
                   
                    $product->pro_cart_qty = $cart->quantity;
                    $product->uniqID = $cart->id;
                    $data['product_cart_list'][] = $product;
                }
            } else {
                $data['product_cart_list'] = [];
            }


            $getCartTotalamount = 0;
            foreach ($data['product_cart_list'] as $list) {
               
                $getCartTotalamount = $getCartTotalamount + ($list->pro_cart_qty * $list->value);
            }
            $data['getCartTotalamount'] = $getCartTotalamount;
        
            $shipping_country = $request->shipping_country_cart;
            $shipping_zipcode = $request->zip_code_cart;
            $data['checkout_shipping_charge'] = ShippingCharge::where(['countries_id' => $shipping_country, 'postal_code' => $shipping_zipcode])->get();
            $data['cart_list_count'] = count($data['product_cart_list']);
            $data['grand_total'] = $getCartTotalamount + $data['checkout_shipping_charge'][0]->shipping_charge;
        }
        // dd($data);
        return view('frontend.checkout.checkout', $data);
    }

    public function user_account()
    {
        return view('frontend.account.account');
    }



    public function user_inspiratinen()
    {
        return view('frontend.inspiration.inspiratinen');
    }

    public function user_aboutus()
    {
        return view('frontend.aboutus.aboutus');
    }



    public function user_messservice()
    {
        return view('frontend.messservice.messservice');
    }





    public function popular_item_detail(Request $request)
    {

        $data['poducts_list'] = ProductList::with('productimage')->where('id', '=', base64_decode($request->product_id))
            ->get();
        if (count($data['poducts_list']) > 0) {
            $data['poducts_list'] = json_encode($data['poducts_list']);
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'messages' => 'Fail',

            ]);
        }
    }
}
