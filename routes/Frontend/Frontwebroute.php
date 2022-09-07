<?php

use App\Http\Controllers\Frontend\Home\HomeController;
use App\Http\Controllers\Frontend\Login\Logincontroller;
use App\Http\Controllers\Frontend\Register\RegisterController;
use App\Http\Controllers\Frontend\Contacus\ContactusController;
use App\Http\Controllers\Frontend\Product\ProductlistController;
use App\Http\Controllers\Frontend\Sampleproduct\SampleProductController;
use App\Http\Controllers\Frontend\Wishlist\WishlistController;
use App\Http\Controllers\Frontend\Cart\CartController;
use App\Http\Controllers\Frontend\Placeorder\PlaceorderController;
use Illuminate\Support\Facades\Artisan;

// Route::get('/', function () {
//     // Artisan::call('migrate --path=/database/migrations/2022_09_07_065206_create_measure_quotes_table.php');
//     dd('done');
// })->name('home');

/*Route::get('/login', function () {
    return view('frontend.login.userlogin');
})->name('user.login');

Route::get('/registration', function () {
    return view('frontend.registration.userregistration');
})->name('user.register');*/


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [Logincontroller::class, 'index'])->name('user.login');
Route::post('/login', [Logincontroller::class, 'signin'])->name('user.signin');
Route::get('/registration', [RegisterController::class, 'index'])->name('user.register');
Route::post('/registration', [RegisterController::class, 'registration'])->name('user.registeration');


Route::get('/checkout', [HomeController::class, 'check_out'])->name('user.checkout');
Route::get('/account', [HomeController::class, 'user_account'])->name('user.account');
//Route::get('/cart', [HomeController::class, 'user_cart'])->name('user.cart');

Route::get('/inspiratinen', [HomeController::class, 'user_inspiratinen'])->name('user.inspiratinen');
Route::get('/aboutus', [HomeController::class, 'user_aboutus'])->name('user.aboutus');
//Route::get('/testsamples', [HomeController::class, 'user_test_samples'])->name('user.kostenlose.testmuster');
Route::get('/messservice', [HomeController::class, 'user_messservice'])->name('user.messservice');
Route::get('/contactus', [ContactusController::class, 'user_contactus'])->name('user.contactus');
Route::post('/contactus', [ContactusController::class, 'user_contactus_submit'])->name('user.contactus.form.submit');

//Route::get('/product/list/{slug}', [ProductlistController::class, 'product_list'])->name('product.list');
Route::get('/product/list/{p_slug}/{c_slug}', [ProductlistController::class, 'product_list'])->name('product.list');
Route::get('/product/configurator', [ProductlistController::class, 'product_configurator'])->name('product.configurator');
Route::get('/product/get-selection-aid', [ProductlistController::class, 'getSelectionAid'])->name('product.get-selection-aid');
Route::get('/product/get-selection-aid2', [ProductlistController::class, 'getSelectionAid2'])->name('product.get-selection-aid2');
Route::get('/product/get-selection-aid3', [ProductlistController::class, 'getSelectionAid3'])->name('product.get-selection-aid3');
Route::get('/product/get-selection-aid4', [ProductlistController::class, 'getSelectionAid4'])->name('product.get-selection-aid4');
Route::get('/product/details/{product_slug}', [ProductlistController::class, 'product_details'])->name('product.details');


Route::get('/testsamples', [SampleProductController::class, 'user_test_samples'])->name('user.kostenlose.testmuster');
Route::get('/samplesdetails/{sample_product_slug}', [SampleProductController::class, 'user_samples_details'])->name('sample.product');

Route::post('porduct/popular', [HomeController::class, 'popular_item_detail'])->name('popular.item.detail');

Route::post('porduct/add_wishlist', [WishlistController::class, 'add__wishlist'])->name('add.item.wishlist');
Route::get('/wishlist', [WishlistController::class, 'user_wishlist'])->name('user.wishlist');

Route::post('porduct/addcart', [CartController::class, 'add__cart'])->name('add.item.cart');
Route::get('/cart', [CartController::class, 'user_cart'])->name('user.cart');
Route::get('user/clearcartlist', [CartController::class, 'clear_cartlist'])->name('user.clear.cartlist');
Route::get('user/removecartlist', [CartController::class, 'remove_cartlist'])->name('user.remove.cartlist');
Route::post('user/updatecartlist', [CartController::class, 'update_cartlist'])->name('user.update.cartlist');

Route::post('user/measure_quote', [CartController::class, 'measure_quote'])->name('cart.measure_quote');

Route::post('user/cartshippingcharge', [CartController::class, 'cart_shipping_charge'])->name('cart.shipping.charge');
Route::post('user/placeorder', [PlaceorderController::class, 'place_order'])->name('place.order');
Route::get('success', [PlaceorderController::class, 'success']);
Route::get('error', [PlaceorderController::class, 'error']);


Route::post('checkout/delivery_details', [CartController::class, 'delivery_details'])->name('checkout.delivery_details');
Route::post('checkout/save_details', [CartController::class, 'save_details'])->name('checkout.save_details');
Route::post('checkout/order_details', [CartController::class, 'order_details'])->name('checkout.order_details');
Route::post('place-order', [CartController::class, 'place_order'])->name('place-order');
Route::get('order/{id}', [CartController::class, 'order'])->name('order');

Route::middleware(['auth'])->group(function () {
    Route::get('user/logout', [Logincontroller::class, 'signout'])->name('user.logout');
    Route::get('user/clearwishlist', [WishlistController::class, 'clear_wishlist'])->name('user.clear.wishlist');
    Route::get('user/addcartwishlist', [WishlistController::class, 'add_cart_wishlist'])->name('user.add.cart_wishllist');



    //Route::post('user/payplaceorder', [PlaceorderController::class, 'place_pay_order'])->name('place.pay.order');



    //Route::post('user/pay', [PlaceorderController::class, 'pay'])->name('user.pay_order');




});

//php artisan migrate --path=/database/migrations/2022_06_07_093211_create_contactuses_table.php
//php artisan migrate --path=/database/migrations/2022_07_16_120719_create_wish_lists_table.php

//php artisan migrate --path=/database/migrations/2022_07_18_094715_create_carts_table.php
//php artisan migrate --path=/database/migrations/2022_07_21_085320_create_orders_table.php
//php artisan migrate --path=/database/migrations/2022_07_21_085354_create_order_details_table.php




//composer require graham-campbell/markdown:^14.0
