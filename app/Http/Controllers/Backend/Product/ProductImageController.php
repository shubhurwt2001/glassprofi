<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Models\Backend\ProductImage;
use App\Models\Backend\ProductList;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product_slug = $request->get('product');
         $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id','name', 'slug')->get();
         $data['productimage'] = ProductImage::where('product_lists_id', '=', $data['productlist'][0]->id)
                                  ->orderBy('id', 'desc')
                                  ->get();
        
        // echo "<pre>";
        // print_r($data['productlist']);
        // die();
         return view('backend.product.productimage.productimage', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product_slug = $request->get('product');
        $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'slug')->get();
        return view('backend.product.productimage.add_productimage', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_image_name'=>'required',
            'product_image'=>'required|mimes:jpeg,jpg,png,webp',
           ]);
        $model = new ProductImage;
        $model->image_name = $request->input('product_image_name');
        $model->product_lists_id = $request->input('product_id');

        if($request->hasfile('product_image')){
            $request->validate([
                'product_image'=> 'mimes:jpeg,jpg,png,webp',
            ]);

            // if(Storage::exists('public/products/'.$model->product_lists_id.'/'.$model->image))
            //   {
            //    Storage::delete('public/products/'.$model->product_lists_id.'/'.$model->image);
               
            //   }
              $ext = $request->product_image->extension();
              $filename=time().'_'.rand(11111, 99999).'.'.$ext;
              //$destinationPath = 'public/products/'.$model->product_lists_id;
              $destinationPath = 'public/products/';
              $request->product_image->storeAs($destinationPath,$filename); 
              $model->image= $filename;
        }


        $model->save();

        $product_slug= $request->input('product_slug');
        return redirect()->route('admin.productimage.index',['product'=>$product_slug])->with('message', 'Product image added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $data['product_slug'] = $request->get('product');
        $data['product_image'] = ProductImage::where('id', $id)->get();
        return view('backend.product.productimage.edit_productimage', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_image_name'=>'required',
            //'product_image'=>'mimes:jpeg,jpg,png,webp',
           ]);

        $model = ProductImage::where('id', '=', $id)->first();
        $model->image_name = $request->input('product_image_name');

        if($request->hasfile('product_image')){
            $request->validate([
                'product_image'=> 'mimes:jpeg,jpg,png,webp',
            ]);

            if(Storage::exists('public/products/'.$model->image))
              {
               Storage::delete('public/products/'.$model->image);
               
              }
              $ext = $request->product_image->extension();
              $filename=time().'_'.rand(11111, 99999).'.'.$ext;
              $destinationPath = 'public/products';
              $request->product_image->storeAs($destinationPath,$filename); 
              $model->document= $filename;
              //die();
        }
        
        $model->save();
        $product_slug= $request->input('product_slug');
        return redirect()->route('admin.productimage.index',['product'=>$product_slug])->with('message', 'Product Image Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = ProductImage::where('id', '=', $id)->first();
        if($model->image !=""){
            if(Storage::exists('public/products/'.$model->image))
            {
                Storage::delete('public/products/'.$model->image);
            }
        }
        $model->delete();
        $product_slug= $request->input('product_slug');
        return redirect()->route('admin.productimage.index',['product'=>$product_slug])->with('message', 'Product image deleted successfully');
    }

    public function status(Request $request, $p_slug, $status, $id){
        
        $model = ProductImage::where('id', $id)->first();
        $model->images_status=$status;
        $model->save();
        $request->session()->flash('message', 'Product image status updated');
        return redirect()->route('admin.productimage.index',['product'=>$p_slug]);
    }



}
