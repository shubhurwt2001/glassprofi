<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Navbar;


use App\Http\Requests\Backend\Navbar\NavbarStoreRequest;
use Illuminate\Support\Facades\Storage;

class NavbarController extends Controller
{
    public function navbar(){
        
        $data['navbar'] = Navbar::orderby('id', 'desc')->get();
        return view('backend.menu.navbar', $data);
    }

    public function addnavbar($id=""){
        if($id !=""){
            $model = Navbar::findOrFail($id);
            $data['id'] = $model->id;
            $data['category_name']= $model->category_name;
            $data['category_slug']= $model->category_slug;
            $data['parent_category_id']= $model->parent_category_id;

            $data['nav_meta_title']= $model->nav_meta_description;
            $data['nav_meta_keyword']= $model->nav_meta_description;
            $data['nav_meta_description']= $model->nav_meta_description;

            $data['category_image']= $model->category_image;
            $data['category_route_name']= $model->category_route_name;
            $data['nav_short_description']= $model->nav_short_desc;
            $data['nav_description']= $model->nav_desc;
            
                      
        }else{
            $data['id']='';
            $data['category_name']= '';
            $data['category_slug']= '';
            $data['parent_category_id']= '';

            $data['nav_meta_title']= " ";
            $data['nav_meta_keyword']= " ";
            $data['nav_meta_description']= " ";

            $data['category_image']= '';
            $data['category_route_name']= '';
            $data['nav_short_description']= '';
            $data['nav_description']= '';
            
        }
        $data['navbar'] = Navbar::where('category_status', '=', '1')
                                ->select('id', 'category_name', 'parent_category_id')
                                ->get();
        return view('backend.menu.manage_navbar', $data);
    }

    //public function add_navbar_submit(NavbarStoreRequest $request){
    public function add_navbar_submit(Request $request){
        
        if($request->post('id') != ""){
            $slug_validation = 'required|unique:App\Models\Backend\Navbar,category_slug,'.$request->post('id');
            $model = Navbar::find($request->post('id'));
            $msg="Category updated Successfully";
            
        }else{
            $slug_validation = 'required|unique:App\Models\Backend\Navbar,category_slug,';
            $model = new Navbar;
            $msg="Category added successfully";
        }

        $this->validate($request, [
            'category_name'=>'required',
            'category_slug'=>$slug_validation,
            'nav_short_description' => 'required',
            'nav_description' => 'required',
            //'route_name' => 'required',
           ],[
            'category_slug.required'=> 'Slug is required',
            'nav_short_description.required' => 'Short description is required',
            'nav_description.required' => 'Description is required',
            'route_name.required' => 'Please select your route',
            ]);
        
        $model->category_name = $request->input('category_name');
        $model->category_slug = $request->input('category_slug');
        $model->parent_category_id = $request->input('parent_category'); 
        
        $model->nav_meta_title = $request->input('navbar_meta_title');
        $model->nav_meta_keyword = $request->input('navbar_meta_keywords');
        $model->nav_meta_description = $request->input('navbar_meta_description'); 
        $parent_id = $request->input('parent_category');
        if($parent_id == "0"){
            $route_name = "NULL";
        }else{
            $route_name = $request->input('route_name');
        }
        $model->category_route_name = $route_name;

        $model->nav_short_desc = $request->input('nav_short_description');
        $model->nav_desc = $request->input('nav_description');
        $model->category_status = '1';
        $model->show_home_page = 'No';

        if($request->hasfile('navbar_image')){
            $request->validate([
                'navbar_image'=> 'mimes:jpeg,jpg,png,webp',
            ]);

            if(Storage::exists('public/category/'.$model->category_name))
              {
               Storage::delete('public/category/'.$model->category_name);
               
              }
              $ext = $request->navbar_image->extension();
              $filename=time().'_'.rand(11111, 99999).'.'.$ext;
              $destinationPath = 'public/category';
              $request->navbar_image->storeAs($destinationPath,$filename); 
              $model->category_image= $filename;
              //die();
        }
        $model->save();
        //return redirect()->route('admin.navbar')->with('message', $msg);
        return redirect()->back()->with('message', $msg);

    }


    public function status(Request $request, $status, $id){
        $model = Navbar::findorfail($id);
        $model->category_status=$status;
        $model->save();
        $request->session()->flash('message', 'Navbar status updated');
        return redirect('/admin/navbar');
    }


    public function show_on_homepage(Request $request, $show, $id){
        $model = Navbar::findorfail($id);
        $model->show_home_page=$show;
        $model->save();
        $request->session()->flash('message', 'Data updated successfully');
        //return redirect('/admin/navbar');
        return back();
    }


    public function delete(Request $request, $id){
        
        $model = Navbar::findorfail($id);

        if($model->cagegory_image !=""){
                if(Storage::exists('storage/category/'.$model->cagegory_image))
                {
                    Storage::delete('storage/category/'.$model->cagegory_image);
                }
        }
        $model->delete();
        $request->session()->flash('message', 'Navbar is deleted successfully');
        return redirect('admin/navbar');
      }

}
