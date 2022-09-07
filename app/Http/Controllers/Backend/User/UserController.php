<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $user_detail=[];
        $user_detail = User::simplepaginate(25);
        return view('backend.user.user_index', compact('user_detail'));
    }

    public function status(Request $request, $status, $id){
        $model = User::where('id', $id)->first();
        $model->status=$status;
        $model->save();
        $request->session()->flash('message', 'status updated');
        return redirect()->route('admin.registeruser');
}
}
