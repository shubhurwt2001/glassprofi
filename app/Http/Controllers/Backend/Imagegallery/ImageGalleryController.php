<?php

namespace App\Http\Controllers\Backend\Imagegallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Backend\ImageGallery;
use Illuminate\Support\Facades\Storage;
class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data['productimage'] = collect([]);
        $data['imagegallery'] = ImageGallery::orderBy('id', 'desc')
                                  ->get();
        return view('backend.imagegallery.imagegallery', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.imagegallery.add_imagegallery');
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
            'image_name'=>'required',
            'image_slug' => 'required|unique:App\Models\Backend\ImageGallery,slug,',
            'image_gallery'=>'required|mimes:jpeg,jpg,png,webp',
           ]);
           $model = new ImageGallery;
           $model->image_name = $request->input('image_name');
           $model->slug = $request->input('image_slug');
   
           if($request->hasfile('image_gallery')){
               $request->validate([
                   'image_gallery'=> 'mimes:jpeg,jpg,png,webp',
               ]);
                 $ext = $request->image_gallery->extension();
                 $filename=time().'_'.rand(11111, 99999).'.'.$ext;
                 //$destinationPath = 'public/products/'.$model->product_lists_id;
                 $destinationPath = 'public/imagegallery/';
                 $request->image_gallery->storeAs($destinationPath,$filename); 
                 $model->image= $filename;
           }
   
   
           $model->save();
           return redirect()->route('admin.imagegallery.index')->with('message', 'Image added successfully');
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
    public function edit($id)
    {
        $data['imagegallery'] = ImageGallery::where('slug', '=', $id)
                                  ->orderBy('id', 'desc')
                                  ->get();
       return view('backend.imagegallery.edit_imagegallery', $data);
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
            'image_name'=>'required',
            'image_slug' => 'required|unique:App\Models\Backend\ImageGallery,slug,' .base64_decode($request->input('id')),
           ]);
           $model = ImageGallery::where('slug', '=', $id)->first();
           $model->image_name = $request->input('image_name');
           $model->slug = $request->input('image_slug');
   
           if($request->hasfile('image_gallery')){
               $request->validate([
                   'image_gallery'=> 'mimes:jpeg,jpg,png,webp',
               ]);
            if(Storage::exists('public/imagegallery/'.$model->image))
              {
                   Storage::delete('public/imagegallery/'.$model->image);
              }
                 $ext = $request->image_gallery->extension();
                 $filename=time().'_'.rand(11111, 99999).'.'.$ext;
                 //$destinationPath = 'public/products/'.$model->product_lists_id;
                 $destinationPath = 'public/imagegallery/';
                 $request->image_gallery->storeAs($destinationPath,$filename); 
                 $model->image= $filename;
           }
   
   
           $model->save();
           return redirect()->route('admin.imagegallery.index')->with('message', 'Image Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ImageGallery::where('id', '=', $id)->first();
        if($model->image !=""){
            if(Storage::exists('public/imagegallery/'.$model->image))
            {
                Storage::delete('public/imagegallery/'.$model->image);
            }
        }
        $model->delete();

        
        return redirect()->route('admin.imagegallery.index')->with('message', 'Image deleted successfully');
    }

    public function status(Request $request, $status, $id){
        $model = ImageGallery::where('id', $id)->first();
        $model->image_status=$status;
        $model->save();
        $request->session()->flash('message', 'Image status updated');
        return redirect()->route('admin.imagegallery.index');
    }
}
