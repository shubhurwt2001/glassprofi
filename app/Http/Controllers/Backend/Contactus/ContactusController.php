<?php

namespace App\Http\Controllers\Backend\Contactus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contactus;

class ContactusController extends Controller
{
    public function contact_us(){
        $data['contact_us'] = Contactus::orderby('id', 'desc')->simplepaginate(15);
        return view ('backend.contactus.contactus', $data);
    }

    public function contact_us_delete(Request $request, $id){
         
        $model = Contactus::findorfail($id);
        //echo $model;
        //die();
        $model->delete();
        $request->session()->flash('message', 'Message deleted successfully');
        return redirect()->route('admin.contactus');
   
   
   
    }



}
