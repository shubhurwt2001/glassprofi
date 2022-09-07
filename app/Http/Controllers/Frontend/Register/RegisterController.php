<?php

namespace App\Http\Controllers\Frontend\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('frontend.registration.userregistration');
    }

    public function registration(Request $request){
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|min:8',
          ]
        );

        $model = new User();
        $model->f_name = $request->input('first_name');
        $model->l_name = $request->input('last_name');
        $model->email = $request->input('email');
        $model->password = Hash::make($request->input('password'));
        $model->save();

        return redirect('/');

    }
}
