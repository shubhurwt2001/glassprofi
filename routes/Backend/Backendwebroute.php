<?php


use App\Http\Controllers\Backend\Login\AdminLoginController;
use App\Http\Controllers\Backend\Menu\NavbarController;
use App\Http\Controllers\Backend\Slider\CarouselController;
use App\Http\Controllers\Backend\Contactus\ContactusController;
use App\Http\Controllers\Backend\Product\ProductlistController;
use App\Http\Controllers\Backend\Product\Productfeaturecontroller;
use App\Http\Controllers\Backend\Product\ProductdocumentController;
use App\Http\Controllers\Backend\Product\ProductImageController;
use App\Http\Controllers\Backend\Product\ProductAttributeController;
use App\Http\Controllers\Backend\SampleProduct\SampleProductController;
use App\Http\Controllers\Backend\Imagegallery\ImageGalleryController;
use App\Http\Controllers\Backend\Clientsays\Clientsays;
use App\Http\Controllers\Backend\Banner\BannerController;
use App\Http\Controllers\Backend\Shippingcharge\CountryController;
use App\Http\Controllers\Backend\Shippingcharge\ShippingchargeController;
use App\Http\Controllers\Backend\Order\OrderController;
use App\Http\Controllers\Backend\Product\StepsController;
use App\Http\Controllers\Backend\User\UserController;
use App\Http\Controllers\Backend\Siteseo\SiteseoController;


Route::get('/admin', [AdminLoginController::class, 'index'])->name('admin');
Route::post('/admin/login', [AdminLoginController::class, 'signin'])->name('admin.signin');
Route::group(['middleware' => 'auth:webadmin'], function () {

    Route::get('/admin/dashboard', [AdminLoginController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    //below links for navbar
    Route::get('/admin/navbar', [NavbarController::class, 'navbar'])->name('admin.navbar');
    Route::get('/admin/managenavbar', [NavbarController::class, 'addnavbar'])->name('admin.manage.navbar');
    Route::get('admin/managenavbar/{id}', [NavbarController::class, 'addnavbar'])->name('admin.edit.navbar');
    //Route::put('admin/managenavbar/{id}', [NavbarController::class, 'addnavbar'])->name('admin.edit.navbar');
    Route::post('/admin/managenavbar', [NavbarController::class, 'add_navbar_submit'])->name('admin.add.navbar');
    Route::get('admin/navbar/status/{status}/{id}', [NavbarController::class, 'status']);
    Route::get('admin/navbar/delete/{id}', [NavbarController::class, 'delete']);
    Route::get('admin/navbar/show/{show}/{id}', [NavbarController::class, 'show_on_homepage']);

    //below links for carousel slider
    Route::get('/admin/slider', [CarouselController::class, 'slider'])->name('admin.slider');
    Route::get('/admin/manageslider', [CarouselController::class, 'manage_slider'])->name('admin.add.slider');
    Route::get('admin/manageslider/{id}', [CarouselController::class, 'manage_slider'])->name('admin.slider.edit');
    Route::post('/admin/manageslider', [CarouselController::class, 'manage_slider_submit'])->name('admin.manage.slider');
    //Route::get('admin/slider/status/{status}/{id}', [CarouselController::class, 'status' ])->name('admin.slider.status');
    Route::get('admin/slider/status/{status}/{slug}', [CarouselController::class, 'status'])->name('admin.slider.status');
    Route::get('admin/slider/delete/{id}', [CarouselController::class, 'delete'])->name('admin.slider.delete');

    //below link for contactus form fill by user show to admin 
    Route::get('/admin/contactus', [ContactusController::class, 'contact_us'])->name('admin.contactus');
    Route::get('admin/contactus/delete/{id}', [ContactusController::class, 'contact_us_delete'])->name('admin.contactus.message.delete');

    //below link for manage product list for admin
    //Route::resource('/admin/productlist', ProductlistController::class);
    Route::prefix('admin')->name('admin')->resource('/admin/productlist', ProductlistController::class);
    Route::get('admin/productlist/status/{status}/{slug}', [ProductlistController::class, 'status'])->name('admin.productlist.status');
    Route::get('admin/productlist/ispopular/{ispopular}/{slug}', [ProductlistController::class, 'is_popular'])->name('admin.productlist.ispopular');
    Route::get('admin/productlist/show/{show}/{slug}', [ProductlistController::class, 'show_on_homepage'])->name('admin.productlist.showonhomepage');

    //below link manage product features for admin.
    //Route::get('/admin/productfeature/{slug}', [Productfeaturecontroller::class, 'product_feature'])->name('admin.product.feature');
    Route::prefix('admin')->name('admin')->resource('/admin/productfeature', Productfeaturecontroller::class);
    Route::get('admin/productfeature/status/{product}/{status}/{id}', [Productfeaturecontroller::class, 'status'])->name('admin.productfeature.status');

    //below link manage download documents for admin
    Route::prefix('admin')->name('admin')->resource('/admin/productdocument', ProductdocumentController::class);
    Route::get('admin/productdocument/status/{product}/{status}/{id}', [ProductdocumentController::class, 'status'])->name('admin.productdocument.status');

    //below link manage product image for admin
    Route::prefix('admin')->name('admin')->resource('/admin/productimage', ProductImageController::class);
    Route::get('admin/productimage/status/{product}/{status}/{id}', [ProductImageController::class, 'status'])->name('admin.productimage.status');

    //below link manage product attribute for admin
    Route::prefix('admin')->name('admin')->resource('/admin/productattribute', ProductAttributeController::class);
    Route::get('admin/productattribute/status/{product}/{status}/{id}', [ProductAttributeController::class, 'status'])->name('admin.productattribute.status');

    Route::get('admin/productattribute/addimage/{id}/{product}', [ProductAttributeController::class, 'create_attribute_image'])->name('admin.productattribute.add.image');
    Route::post('admin/productattribute/addimage', [ProductAttributeController::class, 'store_attribute_image'])->name('admin.productattribute.store.image');
    Route::get('admin/productattribute/manageimage/{id}/{product}', [ProductAttributeController::class, 'manage_attribute_image'])->name('admin.productattribute.manage.image');
    Route::get('admin/productattribute/editimage/{attr_image_id}/{product}/{attr_id}', [ProductAttributeController::class, 'edit_attribute_image'])->name('admin.productattribute.edit.image');
    Route::post('admin/productattribute/updateimage', [ProductAttributeController::class, 'update_attribute_image'])->name('admin.productattribute.update.image');
    Route::delete('admin/productattribute/manageimage/{id}', [ProductAttributeController::class, 'destroy_attribute_image'])->name('admin.productattribute.destroy.image');
    Route::get('admin/productattribute/manageimage/status/{product}/{status}/{attr_img_id}/{attr_id}', [ProductAttributeController::class, 'attr_image_status'])->name('admin.productattribute.image.status');


    Route::get('admin/productattribute/addimagedimensions/{attr_image_id}/{product}/{attr_id}', [ProductAttributeController::class, 'create_attribute_dimensions'])->name('admin.productattribute.add.image.dimensions');
    Route::post('admin/productattribute/addimagedimensions', [ProductAttributeController::class, 'store_attribute_dimensions'])->name('admin.productattribute.store.image.dimension');
    Route::get('admin/productattribute/managedimension/{attr_image_id}/{product}/{attr_id}', [ProductAttributeController::class, 'manage_attribute_dimension'])->name('admin.productattribute.manage.dimension');
    Route::get('admin/productattribute/editdimension/{attr_dimension_id}/{attr_image_id}/{product}/{attr_id}', [ProductAttributeController::class, 'edit_attribute_dimension'])->name('admin.productattribute.edit.dimension');
    Route::post('admin/productattribute/editdimension/', [ProductAttributeController::class, 'update_attribute_dimension'])->name('admin.productattribute.update.dimension');
    Route::delete('admin/productattribute/managedimension/{id}', [ProductAttributeController::class, 'destroy_attribute_dimension'])->name('admin.productattribute.destroy.dimension');
    Route::get('admin/productattribute/managedimension/status/{product}/{status}/{attr_dimension_id}/{attr_id}/{attr_image_id}', [ProductAttributeController::class, 'attr_dimension_status'])->name('admin.productattribute.dimension.status');


    // product steps 
    Route::prefix('admin')->name('admin')->resource('/admin/productstep', StepsController::class);
    Route::get('admin/productstep/status/{product}/{status}/{id}', [StepsController::class, 'status'])->name('admin.productstep.status');





    //below link manage Sample product for admin
    Route::prefix('admin')->name('admin')->resource('/admin/sampleproduct', SampleProductController::class);
    Route::get('admin/sampleproduct/status/{status}/{slug}', [SampleProductController::class, 'status'])->name('admin.sampleproduct.status');

    //below link manage Image Gallery on landing page for admin
    Route::prefix('admin')->name('admin')->resource('/admin/imagegallery', ImageGalleryController::class);
    Route::get('admin/imagegallery/status/{status}/{slug}', [ImageGalleryController::class, 'status'])->name('admin.imagegallery.status');

    //below link manage Image Gallery on landing page for admin
    Route::prefix('admin')->name('admin')->resource('/admin/clientsays', Clientsays::class);
    Route::get('admin/clientsays/status/{status}/{id}', [Clientsays::class, 'status'])->name('admin.clientsays.status');

    //below link manage Banner on landing page 
    Route::prefix('admin')->name('admin')->resource('/admin/banner', BannerController::class);
    //Route::get('admin/banner/status/{status}/{id}', [BannerController::class, 'status' ])->name('admin.banner.status');

    //below link manage shipping charge route on backend page 
    Route::prefix('admin')->name('admin')->resource('/admin/shippingcharge/country', CountryController::class);
    Route::prefix('admin')->name('admin')->resource('/admin/shippingcharge', ShippingchargeController::class);
    Route::get('admin/shippingcharge/status/{status}/{id}', [ShippingchargeController::class, 'status'])->name('admin.shippingcharge.status');

    //below link manage order route on backend page 
    Route::get('admin/order', [OrderController::class, 'index'])->name('admin.order');
    Route::get('admin/orderdetails/{order_id}', [OrderController::class, 'order_details'])->name('admin.order.details');

    //below link mange registered users from frontside
    Route::get('admin/user', [UserController::class, 'index'])->name('admin.registeruser');
    Route::get('admin/user/status/{status}/{id}', [UserController::class, 'status'])->name('admin.user.status');

    //below link mange seo section of site
    Route::get('admin/seo', [SiteseoController::class, 'index'])->name('admin.seo');
    Route::get('admin/seo/edit/{seo_id}', [SiteseoController::class, 'edit'])->name('admin.seo.edit');
    Route::put('admin/seo/updatae/{id}', [SiteseoController::class, 'update'])->name('admin.seo.update');
});


// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('/admin/productlist', ProductlistController::class)->name('admin.productlist');
//     //Route::resource('rooms', 'RoomController');
//     //Route::resource('rooms/gallery', 'RoomGalleryController');
// });

/*
Route::namespace('Admin\Hotel')->group(function () {
    Route::resource('hotels', 'HotelController');
    Route::prefix('hotels')->name('hotels.')->group(function () {
        Route::resource('gallery', 'HotelGalleryController');
        Route::resource('rooms', 'RoomController');
        Route::resource('rooms/gallery', 'RoomGalleryController');
    });
});
*/






//Route::get('/admin/updatepassword', [AdminloginController::class, 'updatepassword' ]);
//php artisan migrate --path=/database/migrations/2022_05_26_124435_create_super_admin_users_table.php
//php artisan migrate --path=/database/migrations/2022_05_31_101352_create_navbars_table.php
//php artisan migrate --path=/database/migrations/2022_06_04_101017_create_sliders_table.php
//php artisan migrate --path=/database/migrations/2022_06_08_094404_create_product_lists_table.php

//php artisan migrate --path=/database/migrations/2022_06_15_074405_create_product_documents_table.php
//php artisan migrate --path=/database/migrations/2022_06_15_074438_create_product_features_table.php

//php artisan migrate --path=/database/migrations/2022_06_16_132147_create_product_images_table.php

//php artisan migrate --path=/database/migrations/2022_06_18_073100_create_product_attributes_table.php

//php artisan migrate --path=/database/migrations/2022_06_20_084243_create_product_attribute_images_table.php
//php artisan migrate --path=/database/migrations/2022_06_22_075002_create_product_attribute_dimensions_table.php

//php artisan migrate --path=/database/migrations/2022_07_04_124355_add_fields_to_navbar_table.php

//php artisan migrate --path=/database/migrations/2022_07_06_130739_create_sample_products_table.php
//php artisan migrate --path=/database/migrations/2022_07_14_092346_create_image_galleries_table.php

//php artisan migrate --path=/database/migrations/2022_07_15_051133_create_client_says_table.php

//php artisan migrate --path=/database/migrations/2022_07_22_121527_create_banners_table.php

//php artisan migrate --path=/database/migrations/2022_07_27_124559_create_countries_table.php
//php artisan migrate --path=/database/migrations/2022_07_27_124621_create_zip_codes_table.php

//php artisan migrate --path=/database/migrations/2022_07_30_085246_create_shipping_charges_table.php

//php artisan migrate --path=/database/migrations/2022_08_30_124537_create_page_seos_table.php
 //git pull
 //git add .
 //git commit -m done
 //git push












//php artisan make:request Backend/Navbar/NavbarStoreRequest

//Laravel & Realtime: Build Several Realtime Apps with Laravel
