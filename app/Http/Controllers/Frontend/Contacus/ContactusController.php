<?php

namespace App\Http\Controllers\Frontend\Contacus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contactus;

class ContactusController extends Controller
{

    public function user_contactus(){
        return view('frontend.contactus.contactus');
    }


    public function user_contactus_submit(Request $request){

        //$validated = $request->validate([
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'your_question' => 'required'
        ]);

        // echo "<pre>";
        // print_r($validated);
        // die();

        $model = new Contactus();
        $model->first_name = $request->input('first_name');
        $model->last_name = $request->input('last_name');
        $model->phone_number = $request->input('phone_number');
        $model->email = $request->input('email');
        $model->your_question = $request->input('your_question');
        $model->save();
        
        return redirect()->route('user.contactus')->with('message', 'Your query has been submitted Admin will contact you shortly');
    }
}
