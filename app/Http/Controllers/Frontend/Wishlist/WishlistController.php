<?php

namespace App\Http\Controllers\Frontend\Wishlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WishList;
use App\Models\Cart;
use App\Models\Backend\ProductList;

use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function user_wishlist(){
        if (Auth::guard('web')->check()) {
            $user_id = Auth::guard('web')->id();
            //$data['wish_list'] = WishList::where('user_id', '=', $user_id )->get();
            $data['wish_list_count'] = WishList::where('user_id', '=', $user_id )->get()->count();
            
            $data['product_wish_list'] = DB::table('wish_lists')
                                        ->join('product_lists', 'product_lists.id', '=', 'wish_lists.product_id')
                                        ->where('wish_lists.user_id', '=', $user_id )
                                        ->select('wish_lists.id as wishlist_id', 'wish_lists.product_id as wishlist_proID', 'product_lists.id as pro_id', 'product_lists.name', 'product_lists.value', 'product_lists.delivery_time', 'product_lists.pro_image', 'product_lists.slug', 'product_lists.product_route_name' )
                                        ->get();
            // echo "<pre>";
            // print_r($data['product_wish_list']->toArray());
            // die();
        
            return view('frontend.wishlist.wishlist', $data);
        }else{
            session(['wishlist' => 'You are not login to see your wishlist']);
            return redirect('/login');
        }
        
    }


    public function clear_wishlist(){
        try{
            if (Auth::guard('web')->check()) {
                $user_id = Auth::guard('web')->id();
                $data['clear_wish_list'] = WishList::where('user_id', '=', $user_id )->get();
                 if(count($data['clear_wish_list'])>0){
                    foreach($data['clear_wish_list'] as $delete_wish_lists){
                        $delete_wish_lists->delete();
                    }
                    
                    return redirect()->route('user.wishlist')->with('message', 'Wishlist cleared successfully');
                }else{
                    return redirect()->route('user.wishlist')->with('message', 'Wishlist already empty');
                }
            }
        }catch(Throwable $e){
            abort(404);
        }
    }


    public function add__wishlist(Request $request){
       
        if (Auth::guard('web')->check()) {
            $userId = Auth::id();
            $check_wishlist = Wishlist::where('product_id', '=', base64_decode($request->wishlist_id))->get();
            if(count($check_wishlist)>0){
                return response()->json([
                    'status'=> 201,
                    'message' => 'Fail',
                  ]);
            }else{
                $model = new Wishlist;
                $model->product_id = base64_decode($request->wishlist_id);
                $model->user_id = $userId;
                $model->save();
                $data['wishlist_count'] = Wishlist::where("user_id", "=", auth()->id())->count();
                //$data['cart_count'] = Cart::where("user_id", "=", auth()->id())->count();
                $data = json_encode($data);
                return response()->json([
                    'status'=> 200,
                    'message' => 'Success',
                    'data' => $data,
                ]);
                }
        }else{
            session(['wishlist' => 'You cannot add item into wishlist without login']);
            return response()->json([
                'status'=> 400,
                'message' => 'Fail',
             
            ]);
        }
    }


    public function add_cart_wishlist(Request $request){
        
        echo "<pre>";
        print_r($_GET);
        //die();
        try{
            if (Auth::guard('web')->check()) {
                $userId = Auth::id();
                $check_wishlist = Wishlist::where('id', '=', base64_decode($request->wishlist_id))->get();
                if(count($check_wishlist)>0){
                    $check_cartlist = Cart::where('product_id', '=', base64_decode($request->prod_id))->get();
                        if(count($check_cartlist)>0){
                            $remove_wish_list = Wishlist::where('id', '=',base64_decode($request->wishlist_id) )->first();
                            $remove_wish_list->delete();
                            return redirect()->route('user.wishlist')->with('message', 'Item alreay in cart list, item delted from wishlist');    
                        }else{
                            $remove_wish_list = Wishlist::where('id', '=',base64_decode($request->wishlist_id) )->first();
                            $remove_wish_list->delete();
                            $model = new Cart;
                            $model->product_id = base64_decode($request->prod_id);
                            $model->user_id = $userId;
                            $model->pro_cart_qty = 1;
                            $model->save();
                            return redirect()->route('user.wishlist')->with('message', 'Item added in your cart');    
                        }
                }else{
                    return redirect()->route('user.wishlist')->with('message', 'Data not found');    
                }
            }else{
                return redirect()->route('user.login')->with('loginerror', 'You are not authorize to make changes');
            }


        }catch(\Exception $e){
            //abort(404);
            return $e->getMessage();
        }
    }
}
