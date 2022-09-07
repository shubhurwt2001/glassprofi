<?php

namespace App\Http\Controllers\Backend\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
//use App\Models\User;
use App\Models\Backend\SuperAdminUser;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    
    public function index(){
        if (Auth::guard('webadmin')->check()) {
            return redirect('/admin/dashboard');
        }else{
            return view('backend.adminlogin.login');
        }
        //return view('backend.adminlogin.login');
    }

    public function signin(Request $request){
        $credentials = $request->validate([
            'email'=>'required',
            'password'=>'required' 
         ]);

         $credentials = $request->only('email','password');
         //echo "<pre>";
         //print_r($credentials);
         //die();
         if (Auth::guard('webadmin')->attempt($credentials)) {
             //$email = $request->input('email');
             //$superadminuseredetail = SuperAdminUser::where(['email'=>$email])->first();
             $details = Auth::guard('webadmin')->user();
             //$user = $details['original'];
            
             return redirect('/admin/dashboard');
         }else{
             $request->session()->flash('adminloginerror', 'Please enter valid Login Details');
             return redirect('/admin');
         }
       
    }

/*    public function updatepassword(){
        $r = SuperAdminUser::find(1);
        $r->password = Hash::make('admin@123');
        $r->save();
    }
*/

    public function dashboard(){
        if (Auth::guard('webadmin')->check()) {
            return view ('backend.dashboard.admindashboard');
        }else{
            return redirect()->route('admin');
        }

        //return view ('backend.dashboard.admindashboard');
    }


    public function logout()
    {
        Auth::guard('webadmin')->logout();
        return redirect()->route('admin');
    }

    
}
