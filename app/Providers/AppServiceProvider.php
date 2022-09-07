<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Backend\Navbar;
use View;

use App\Models\WishList;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view)
        {
            //$navitem= Navbar::all();
            $categories = Navbar::where('parent_category_id', '=', 0)->where('category_status', '=', "1")->get();
            $allCategories = Navbar::pluck('category_name','id','category_route_name')->all();
            //$view->with('navitem', $navitem);
            $view->with(compact('categories','allCategories'));
        });
        
        View::composer('*', function($view)
        {
            if (Auth::guard('web')->check()) {            
                $total_wishlist_item = Wishlist::where("user_id", "=", auth()->id())->count();
                $total_cart_itme = Cart::where("user_id", "=", auth()->id())->count();
                $view->with(compact('total_wishlist_item','total_cart_itme'));
            }
            else{
                
                if(session()->has('cart')){
                    $total_cart_itme = count(session()->get('cart'));
                    $total_wishlist_item =0;
                }else{
                    $total_cart_itme = 0;
                    $total_wishlist_item =0;
                }
                $total_cart_itme = $total_cart_itme;
                $view->with(compact('total_wishlist_item','total_cart_itme'));
            }
        });


    }
}
