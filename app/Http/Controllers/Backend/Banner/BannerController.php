<?php

namespace App\Http\Controllers\Backend\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Banner;

class BannerController extends Controller
{
    public function index(){
        
        $data['banner'] = Banner::orderBy('id', 'desc')
                                   ->get();
        return view('backend.banner.banner_index', $data);
    }


    // public function status(Request $request, $status, $id){
    //     $model = Banner::where('id', $id)->first();
    //     $model->status=$status;
    //     $model->save();
    //     $request->session()->flash('message', 'status updated');
    //     return redirect()->route('admin.banner.index');
    // }


    public function edit($id)
    {
        $data['banner'] = Banner::where('id', '=', $id)
                                ->orderBy('id', 'desc')
                                  ->get();
      
       return view('backend.banner.edit_banner', $data);
    }

    public function update(Request $request, $id){
        //dd('you are here');
        $this->validate($request, [
            'banner_heading'=>'required|min:20|max:200',
            'banner_paragraph' => 'required|min:20|max:200',
            //'banner_image'=>'required|mimes:jpeg,jpg,png,webp',
           ]);
           $model = Banner::where('id', '=', $id)->first();
           $model->banner_heading = $request->input('banner_heading');
           $model->banner_para = $request->input('banner_paragraph');
           $model->status = '1';
   
           if($request->hasfile('banner_image')){
               $request->validate([
                   'banner_image'=> 'mimes:jpeg,jpg,png,webp',
               ]);
               if($model->banner_image !=""){
                    if(Storage::exists('public/banner/'.$model->banner_image))
                        {
                         Storage::delete('public/banner/'.$model->banner_image);
                        }
                }
                 $ext = $request->banner_image->extension();
                 $filename=time().'_'.rand(11111, 99999).'.'.$ext;
                 //$destinationPath = 'public/products/'.$model->product_lists_id;
                 $destinationPath = 'public/banner/';
                 $request->banner_image->storeAs($destinationPath,$filename); 
                 $model->banner_image= $filename;
           }
   
   
           $model->save();
           return redirect()->route('admin.banner.index')->with('message', 'Data updated successfully');
    }




    
}
