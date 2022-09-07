<?php

namespace App\Http\Controllers\Backend\SampleProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\SampleProduct;

class SampleProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sampleproduct']=SampleProduct::get();
        return view('backend.sampleproduct.sampleproduct', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sampleproduct.add_sampleproduct');
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
            'sample_product_name'=>'required',
            'sample_product_slug'=>'required|unique:App\Models\Backend\SampleProduct,slug,',
            'delivery_time'=>'required',
            'description'=>'required',
            'keywords'=>'required',
            'sample_product_image'=>'required',
            
           ],[
                'sample_product_name.required'=> 'Name field is required',
                'sample_product_slug.required' => 'Slug field is requred',
                'sample_product_slug.slug' => 'Slug should be unique',
                'sample_product_image' => 'Image field is required'
            ]);
            $model = new SampleProduct;
            $model->name = $request->input('sample_product_name');
            $model->slug = $request->input('sample_product_slug');
            $model->value = 'Free';
            $model->delivery_time = $request->input('delivery_time'); 
            $model->short_desc = $request->input('description'); 
            $model->keywords =  $request->input('keywords');
            $model->pro_status = '1';
            $model->product_route_name = 'sample.product';
    
            if($request->hasfile('sample_product_image')){
                $request->validate([
                    'sample_product_image'=> 'mimes:jpeg,jpg,png,webp',
                ]);
                  $ext = $request->sample_product_image->extension();
                  $filename=time().'_'.rand(11111, 99999).'.'.$ext;
                  $destinationPath = 'public/sampleproducts';
                  $request->sample_product_image->storeAs($destinationPath,$filename); 
                  $model->pro_image= $filename;
                  
            }
            $model->save();
            return redirect()->route('admin.sampleproduct.index')->with('message', 'Sample product added successfully');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data['sample_product'] = SampleProduct::where('slug', '=', $slug)->get();
        
        return view('backend.sampleproduct.show_sampleproduct', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data['sample_product'] = SampleProduct::where('slug', '=', $id)->get();
        //$data['sample_product'][0]['name'];
       
        return view('backend.sampleproduct.edit_sampleproduct', $data);
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
            'sample_product_name'=>'required',
            'sample_product_slug'=>'required|unique:App\Models\Backend\SampleProduct,slug,' .$request->input('id'),
            'delivery_time'=>'required',
            'description'=>'required',
            'keywords'=>'required',
            //'sample_product_image'=>'required',
            
           ],[
                'sample_product_name.required'=> 'Name field is required',
                'sample_product_slug.required' => 'Slug field is requred',
                'sample_product_slug.slug' => 'Slug should be unique',
                //'sample_product_image' => 'Image field is required',
            ]);
       
        $model = SampleProduct::where('slug', '=', $id)->first();
        $model->name = $request->input('sample_product_name');
        $model->slug = $request->input('sample_product_slug');
        $model->value = 'Free';
        $model->delivery_time = $request->input('delivery_time'); 
        $model->short_desc = $request->input('description'); 
        $model->keywords =  $request->input('keywords');
        $model->pro_status = '1';
        $model->product_route_name = 'sample.product';
    
        if($request->hasfile('sample_product_image')){
                $request->validate([
                    'sample_product_image'=> 'mimes:jpeg,jpg,png,webp',
                ]);
                if(Storage::exists('public/sampleproducts/'.$model->pro_image))
                {
                     Storage::delete('public/sampleproducts/'.$model->pro_image);
                }
                  $ext = $request->sample_product_image->extension();
                  $filename=time().'_'.rand(11111, 99999).'.'.$ext;
                  $destinationPath = 'public/sampleproducts';
                  $request->sample_product_image->storeAs($destinationPath,$filename); 
                  $model->pro_image= $filename;
                  
        }
            $model->save();
            return redirect()->route('admin.sampleproduct.index')->with('message', 'Sample product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $model = SampleProduct::where('slug', '=', $slug)->first();
        //echo "<pre>";
        //print_r($model);
        //echo $model->pro_image;
        //die();
           if($model->pro_image !=""){
                if(Storage::exists('public/sampleproducts/'.$model->pro_image))
                {
                    Storage::delete('public/sampleproducts/'.$model->pro_image);
                }
            }
        $model->delete();
       return redirect()->route('admin.sampleproduct.index')->with('message', 'Sampled product is deleted successfully');
    }


    public function status(Request $request, $status, $slug){
        $model = SampleProduct::where('slug', $slug)->first();
        $model->pro_status=$status;
        $model->save();
        $request->session()->flash('message', 'Sample product status updated');
        return redirect()->route('admin.sampleproduct.index');
}
}
