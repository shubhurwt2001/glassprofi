<?php

namespace App\Http\Controllers\Backend\Slider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Slider;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function slider(){
        //dd('you are here');
        $data['slider'] = Slider::orderby('id', 'desc')->simplepaginate(15);
        return view('backend.slider.carousel', $data);
    }


    public function manage_slider($id=""){
        if($id !=""){
           
            $model = Slider::findOrFail($id);
            
            $data['id'] = $model->id;
            $data['slider_image']= $model->slider_image;
            $data['slider_name']= $model->slider_name;
            $data['slider_slug']= $model->slider_slug;
            $data['slider_first_ptag']= $model->slider_first_ptag;
            $data['slider_htag']= $model->slider_htag;
            $data['slider_second_ptag']= $model->slider_second_ptag;
           
                      
        }else{
            $data['id']='';
            $data['slider_image']= '';
            $data['slider_name']= '';
            $data['slider_slug']= '';
            $data['slider_first_ptag']= '';
            $data['slider_htag']= '';
            $data['slider_second_ptag']= '';
            
            
        }
        
        return view('backend.slider.manage_carousel', $data);
    }

    public function manage_slider_submit(Request $request){
       
        if($request->post('id') != ""){
            $slug_validation = 'required|unique:App\Models\Backend\Slider,slider_slug,'.$request->post('id');
            $slider_image = 'required,'.$request->post('id');
            $model = Slider::find($request->post('id'));
            $msg="Slider updated Successfully";
            
        }else{
            $slug_validation = 'required|unique:App\Models\Backend\Slider,slider_slug,';
            $slider_image = 'required';
            $model = new Slider;
            $msg="Slider added successfully";
        }

        $this->validate($request, [
            'slider_image'=>$slider_image,
            'slider_name'=>'required',
            'slider_slug'=>$slug_validation,
            'slider_first_text'=>'required',
            'slider_second_text'=>'required',
            'slider_third_text'=>'required',
            
           ],[
            'category_slug.required'=> 'Slug is required',
            ]);
        //$model = new Navbar;
        $model->slider_name = $request->input('slider_name');
        $model->slider_slug = $request->input('slider_slug');
        $model->slider_first_ptag = $request->input('slider_first_text'); 
        $model->slider_htag =  $request->input('slider_second_text');
        $model->slider_second_ptag = $request->input('slider_third_text');
        $model->slider_status = '1';

        if($request->hasfile('slider_image')){
            $request->validate([
                'slider_image'=> 'mimes:jpeg,jpg,png,webp',
            ]);

            if(Storage::exists('public/slider/'.$model->slider_image))
              {
               Storage::delete('public/slider/'.$model->slider_image);
               
              }
              $ext = $request->slider_image->extension();
              $filename=time().'_'.rand(11111, 99999).'.'.$ext;
              $destinationPath = 'public/slider';
              $request->slider_image->storeAs($destinationPath,$filename); 
              $model->slider_image= $filename;
              //die();
        }
        $model->save();
        //return redirect()->route('admin.navbar')->with('message', 'Category added successfully');
        return redirect()->route('admin.slider')->with('message', $msg);

    }


    //public function status(Request $request, $status, $id){
    public function status(Request $request, $status, $slug){
        //$model = Slider::findorfail($id);
        $model = Slider::where('slider_slug', $slug)->first();
        $model->slider_status=$status;
        $model->save();
        $request->session()->flash('message', 'Slider status updated');
        return redirect('/admin/slider');
    }


    public function delete(Request $request, $id){
        
        $model = Slider::findorfail($id);
        

        if($model->slider_image !=""){
                if(Storage::exists('public/slider/'.$model->slider_image))
                {
                    Storage::delete('public/slider/'.$model->slider_image);
                }
        }
        $model->delete();
        $request->session()->flash('message', 'Slider is deleted successfully');
        return redirect('admin/slider');
    }
}
