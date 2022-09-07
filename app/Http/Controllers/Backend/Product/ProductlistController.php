<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\ProductList;
use App\Models\Backend\Navbar;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class ProductlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data['productlist'] = ProductList::all();
        //$data['productlist'] = ProductList::with('navbar')->get();

        $data['productlist']= DB::table('product_lists')
                            ->join('navbars', 'product_lists.navbars_id', '=', 'navbars.id')
                            //->where(['product_lists.pro_status' =>'1' ])
                            ->select('product_lists.*', 'navbars.id as category_id', 'navbars.category_name')
                            ->orderby('product_lists.id', 'desc')
                            ->get();
     

        return view('backend.product.productlist', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['navbar'] = Navbar::where('category_status', '=', '1')
                        ->select('id', 'category_name', 'parent_category_id')
                        ->get();
        
        return view('backend.product.add_productlist', $data);
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
            'product_name'=>'required',
            'product_slug'=>'required|unique:App\Models\Backend\ProductList,slug,',
            'category'=>'required',
            'product_title'=>'required',
            'product_value'=>'required|integer|min:0',
            'delivery_time'=>'required|integer|min:0',
            'short_description'=>'required',
            'description'=>'required',
            'product_image'=>'required',
           ],[
            //'category_slug.required'=> 'Slug is required',
            ]);
        $model = new ProductList;
        $model->name = $request->input('product_name');
        $model->slug = $request->input('product_slug');
        $model->navbars_id = $request->input('category');
        $model->title = $request->input('product_title'); 
        $model->value = $request->input('product_value'); 
        $model->delivery_time = $request->input('delivery_time');
        $model->sample_product = $request->input('sample_product');  

        $model->pro_shipping_charge = $request->input('pro_shipping_charge'); 
        $model->pro_meta_title = $request->input('product_meta_title'); 
        $model->pro_meta_keyword = $request->input('product_meta_keywords'); 
        $model->pro_meta_description = $request->input('product_meta_description'); 

        $model->short_desc =  $request->input('short_description');
        $model->desc =  $request->input('description');
        $model->keywords =  $request->input('kewords');
        $model->pro_status = 1;
        $model->product_route_name = 'product.details';
        $model->is_popular = 'No';
        $model->show_on_homepage = 'No';

        if($request->hasfile('product_image')){
            $request->validate([
                'product_image'=> 'mimes:jpeg,jpg,png,webp',
            ]);

            if(Storage::exists('public/products/'.$model->pro_image))
              {
               Storage::delete('public/products/'.$model->pro_image);
               
              }
              $ext = $request->product_image->extension();
              $filename=time().'_'.rand(11111, 99999).'.'.$ext;
              $destinationPath = 'public/products';
              $request->product_image->storeAs($destinationPath,$filename); 
              $model->pro_image= $filename;
              //die();
        }
        $model->save();
        return redirect()->route('admin.productlist.index')->with('message', 'Product added successfully');
        //return redirect()->route('admin.navbar')->with('message', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $data['product_list'] = ProductList::where('slug', '=', $id)->get();
        $data['navbar'] = Navbar::where('category_status', '=', '1')
                        ->select('id', 'category_name', 'parent_category_id')
                        ->get();
        return view('backend.product.show_productlist', $data);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data['product_list'] = ProductList::where('slug', '=', $id)->get();
        $data['navbar'] = Navbar::where('category_status', '=', '1')
                        ->select('id', 'category_name', 'parent_category_id')
                        ->get();
       
        return view('backend.product.edit_productlist', $data);
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
            'product_name'=>'required',
            'product_slug'=>'required|unique:App\Models\Backend\ProductList,slug,' .$request->input('id'),
            'category'=>'required',
            'product_title'=>'required',
            'product_value'=>'required|integer|min:0',
            'delivery_time'=>'required|integer|min:0',
            'short_description'=>'required',
            'description'=>'required',
            //'product_image'=>'required',
           ],[
            //'category_slug.required'=> 'Slug is required',
            ]);

        
        $model = ProductList::where('slug', '=', $id)->first();
       
        $model->name = $request->input('product_name');
        $model->slug = $request->input('product_slug');
        $model->navbars_id = $request->input('category');
        $model->title = $request->input('product_title'); 
        $model->value = $request->input('product_value'); 
        $model->delivery_time = $request->input('delivery_time');
        $model->sample_product = $request->input('sample_product');

        $model->pro_shipping_charge = $request->input('pro_shipping_charge'); 
        $model->pro_meta_title = $request->input('product_meta_title'); 
        $model->pro_meta_keyword = $request->input('product_meta_keywords'); 
        $model->pro_meta_description = $request->input('product_meta_description'); 

        $model->short_desc =  $request->input('short_description');
        $model->desc =  $request->input('description');
        $model->keywords =  $request->input('kewords');
        $model->pro_status = 1;

        if($request->hasfile('product_image')){
            $request->validate([
                'product_image'=> 'mimes:jpeg,jpg,png,webp',
            ]);

            if(Storage::exists('public/products/'.$model->pro_image))
              {
               Storage::delete('public/products/'.$model->pro_image);
               
              }
              $ext = $request->product_image->extension();
              $filename=time().'_'.rand(11111, 99999).'.'.$ext;
              $destinationPath = 'public/products';
              $request->product_image->storeAs($destinationPath,$filename); 
              $model->pro_image= $filename;
              //die();
        }
        $model->save();
        return redirect()->route('admin.productlist.index')->with('message', 'Product updated successfully');
        //return redirect()->back()->with('message', 'Product updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ProductList::where('slug', '=', $id)->first();
      
           if($model->pro_image !=""){
                if(Storage::exists('public/products/'.$model->pro_image))
                {
                    Storage::delete('public/products/'.$model->pro_image);
                }
            }
        $model->delete();
       return redirect()->route('admin.productlist.index')->with('message', 'Product is deleted successfully');
    }
    
    public function status(Request $request, $status, $slug){
            $model = ProductList::where('slug', $slug)->first();
            $model->pro_status=$status;
            $model->save();
            $request->session()->flash('message', 'Product status updated');
            return redirect()->route('admin.productlist.index');
    }


    public function is_popular(Request $request, $ispopular, $slug){
        $model = ProductList::where('slug', $slug)->first();
        $model->is_popular=$ispopular;
        $model->save();
        $request->session()->flash('message', 'Data updated successfully');
        //return redirect('/admin/navbar');
        return back();
    }


    public function show_on_homepage(Request $request, $show, $slug){
        $model = ProductList::where('slug', $slug)->first();
        $model->show_on_homepage=$show;
        $model->save();
        $request->session()->flash('message', 'Data updated successfully');
        //return redirect('/admin/navbar');
        return back();
    }

   

}
