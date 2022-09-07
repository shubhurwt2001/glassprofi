<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\ProductList;
use App\Models\Backend\Navbar;

use App\Models\Backend\ProductFeature;
use App\Models\Backend\ProductDocument;
use App\Models\Backend\ProductImage;
use App\Models\Backend\ProductAttribute;
use App\Models\Backend\ProductAttributeDimension;
use App\Models\Backend\ProductAttributeImage;
use App\Models\Cart;
use App\Models\Step;
use App\Models\SelectionAid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProductlistController extends Controller
{
    //public function product_list(Request $request, $slug){
    public function product_list(Request $request, $p_slug, $c_slug)
    {
        $data['parent_category'] = Navbar::where('category_slug', $p_slug)->get();
        $data['child_category'] = Navbar::withCount('productlist')->where(['parent_category_id' => $data['parent_category'][0]->id])->get();
        $data['child_select_category'] = Navbar::where('category_slug', $c_slug)->select('id', 'nav_short_desc', 'nav_desc', 'category_image', 'parent_category_id', 'category_name', 'nav_meta_title', 'nav_meta_keyword', 'nav_meta_description')->get();
        $data['poducts'] = ProductList::where('navbars_id', '=', $data['child_select_category'][0]->id)->where(['pro_status' => '1', 'sample_product' => 'No'])->get();

        return view('frontend.products.product_list', $data);
    }





    public function product_details_old(Request $request, $product_slug)
    {
        $data['poduct_details'] = ProductList::where('slug', '=', $product_slug)->where('pro_status', '=', '1')->get();

        $data['poduct_feature'] = ProductFeature::where('product_lists_id', '=', $data['poduct_details'][0]->id)
            ->where('feature_status', '=', '1')
            ->orderBy('pro_feature_serial_no', 'asc')
            ->get();
        $data['poduct_document'] = ProductDocument::where('product_lists_id', '=', $data['poduct_details'][0]->id)
            ->where('document_status', '=', '1')
            ->orderBy('id', 'desc')
            ->get();
        $data['poduct_image'] = ProductImage::where('product_lists_id', '=', $data['poduct_details'][0]->id)
            ->where('images_status', '=', '1')
            ->orderBy('id', 'desc')
            ->get();
        $data['poduct_attr'] = ProductAttribute::where('product_lists_id', '=', $data['poduct_details'][0]->id)
            ->where('attribute_status', '=', '1')
            ->orderBy('id', 'desc')
            ->get();
        // $data['poduct_attr'] = DB::table('product_attributes')
        //                            ->join('product_attribute_images', 'product_attributes.id', '=', 'product_attribute_images.attr_id')
        //                            //->join('product_attribute_dimensions', 'product_attribute_images.id', '=', 'product_attribute_dimensions.attr_image_id')
        //                            ->where('product_attributes.product_lists_id', '=', $data['poduct_details'][0]->id)
        //                            ->select('product_attributes.*', 'product_attribute_images.id as attr_image_id')
        //                            ->get();

        $data['pro_attr_image'][] = "";
        $data['pro_attr_dimension'][] = "";
        if (count($data['poduct_attr']) > 0) {
            foreach ($data['poduct_attr'] as $list1) {
                $data['pro_attr_image'][$list1->id] = DB::table('product_attribute_images')
                    ->where(['product_attribute_images.attr_id' => $list1->id])
                    ->get();
                if (count($data['pro_attr_image'][$list1->id]) > 0) {
                    foreach ($data['pro_attr_image'][$list1->id] as $list2) {
                        $data['pro_attr_dimension'][$list2->id] = DB::table('product_attribute_dimensions')
                            ->where(['product_attribute_dimensions.attr_image_id' => $list2->id])
                            ->get();
                    }
                }
            }
        }

        $data['category'] = Navbar::where('id', $data['poduct_details'][0]->navbars_id)
            ->select('id', 'category_name', 'category_slug', 'parent_category_id', 'category_route_name')
            ->get();
        $data['parent_category'] = Navbar::where('id', $data['category'][0]->parent_category_id)
            ->select('id', 'category_name', 'category_slug', 'parent_category_id', 'category_route_name')
            ->get();

        return view('frontend.products.product_details', $data);
    }


    public function product_details(Request $request, $product_slug)
    {
        $product = ProductList::where('slug', '=', $product_slug)->where('pro_status', '=', '1')->first();

        $product->product_features = ProductFeature::where('product_lists_id', '=', $product->id)
            ->where('feature_status', '=', '1')
            ->orderBy('pro_feature_serial_no', 'asc')
            ->get();

        $product->product_documents = ProductDocument::where('product_lists_id', '=', $product->id)
            ->where('document_status', '=', '1')
            ->orderBy('id', 'desc')
            ->get();
        $product->product_images = ProductImage::where('product_lists_id', '=', $product->id)
            ->where('images_status', '=', '1')
            ->orderBy('id', 'desc')
            ->get();

        $product->steps = Step::where('product_id', $product->id)->get();

        foreach ($product->steps as $steps) {
            $steps->attributes = ProductAttribute::where('step', '=', $steps->id)
                ->where('attribute_status', '=', '1')
                ->get();


            foreach ($steps->attributes as $attribute) {
                $attribute->images = ProductAttributeImage::where('attr_id', '=', $attribute->id)
                    ->where('attr_image_status', '=', '1')
                    ->get();

                foreach ($attribute->images as $image) {
                    $image->dimensions = ProductAttributeDimension::where('attr_image_id', '=', $image->id)
                        ->where('attr_dim_status', '=', '1')
                        ->get();
                }
            }
        }



        $product->category = Navbar::where('id', $product->navbars_id)
            ->select('id', 'category_name', 'category_slug', 'parent_category_id', 'category_route_name')
            ->first();
        $product->parent = Navbar::where('id', $product->category->parent_category_id)
            ->select('id', 'category_name', 'category_slug', 'parent_category_id', 'category_route_name')
            ->first();

        if ($request->edit) {
            $cart = null;
            if (Auth::check()) {
                $cart = Cart::where('id', $request->edit)->first();
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
                                $cart->value = $cart->value + $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                            } else {
                                $attribute->dimensions = [];
                            }
                        }
                    }
                }
            } else {
                $carts = session()->get('cart');
                // dd($carts);
                if (!$carts) {
                    return abort(404);
                }
                foreach ($carts as $cartItem) {
                    if ($cartItem->id == $request->edit) {
                        $cart = $cartItem;
                        $cart->value = 0;
                        if ($cart->extra_details) {
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
                                        $cart->value = $cart->value + $sides->tarif + ((($sides->a / $sides->divider) + ($sides->d / $sides->divider)) * ($sides->b / $sides->divider) * $sides->tarif);
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if (!$cart) {
                return abort(404);
            } else {
                $product->cart = $cart;
            }
        }
        $product->edit = $request->edit;
        return view('frontend.products.product_details', compact('product'));
    }

    public function product_configurator()
    {
        $data['selection_categories'] = SelectionAid::where('parent_id', '=', 1)->get();
        ///dd($data['categories']);
        return view('frontend.products.product_configurator')->with($data);
    }

    public function getSelectionAid(Request $request)
    {
        $cat_id = $request->cat_id;
        $selectionCategoriesData = SelectionAid::where('parent_id', '=', $cat_id)->get();
        return view('frontend.products.get-selection-aid', compact('selectionCategoriesData'));
    }

    public function getSelectionAid2(Request $request)
    {
        $cat_id = $request->cat_id;
        $selectionCategoriesData = SelectionAid::where('parent_id', '=', $cat_id)->get();
        return view('frontend.products.get-selection-aid2', compact('selectionCategoriesData'));
    }

    public function getSelectionAid3(Request $request)
    {
        $cat_id = $request->cat_id;
        $selectionCategoriesData = SelectionAid::where('parent_id', '=', $cat_id)->get();
        return view('frontend.products.get-selection-aid3', compact('selectionCategoriesData'));
    }

    public function getSelectionAid4(Request $request)
    {
        $cat_id = $request->cat_id;
        $selectionCategoriesData = SelectionAid::where('parent_id', '=', $cat_id)->get();
        return view('frontend.products.get-selection-aid4', compact('selectionCategoriesData'));
    }
}
