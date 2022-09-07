<?php

namespace App\Http\Controllers\Backend\Clientsays;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Collection;
use App\Models\Backend\ClientSay;
use Illuminate\Support\Facades\Storage;

class Clientsays extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('you are here');
        //$data['productlist'] = collect([]);
        $data['clientsays'] = ClientSay::orderBy('id', 'desc')
                                   ->get();
        return view('backend.clientsays.clientsays_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.clientsays.add_clientsays');
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
            'client_name'=>'required',
            'client_quote' => 'required|min:20|max:200',
            'client_image'=>'required|mimes:jpeg,jpg,png,webp',
           ]);
           $model = new ClientSay;
           $model->client_name = $request->input('client_name');
           $model->client_quote = $request->input('client_quote');
           $model->status = '1';
   
           if($request->hasfile('client_image')){
               $request->validate([
                   'client_image'=> 'mimes:jpeg,jpg,png,webp',
               ]);
                 $ext = $request->client_image->extension();
                 $filename=time().'_'.rand(11111, 99999).'.'.$ext;
                 //$destinationPath = 'public/products/'.$model->product_lists_id;
                 $destinationPath = 'public/clientsays/';
                 $request->client_image->storeAs($destinationPath,$filename); 
                 $model->client_image= $filename;
           }
   
   
           $model->save();
           return redirect()->route('admin.clientsays.index')->with('message', 'Client quote added successfully');
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
        $data['clientsays'] = ClientSay::where('id', '=', $id)
                                ->orderBy('id', 'desc')
                                  ->get();
      
       return view('backend.clientsays.edit_clilentsays', $data);
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
            'client_name'=>'required',
            'client_quote' => 'required|min:20|max:200',
            //'client_image'=>'required|mimes:jpeg,jpg,png,webp',
           ]);
           $model = ClientSay::where('id', '=', $id)->first();
           $model->client_name = $request->input('client_name');
           $model->client_quote = $request->input('client_quote');
           $model->status = '1';
   
           if($request->hasfile('client_image')){
               $request->validate([
                   'client_image'=> 'mimes:jpeg,jpg,png,webp',
               ]);
                if($model->client_image !=""){
                    if(Storage::exists('public/clientsays/'.$model->client_image))
                    {
                        Storage::delete('public/clientsays/'.$model->client_image);
                    }
                }
                 $ext = $request->client_image->extension();
                 $filename=time().'_'.rand(11111, 99999).'.'.$ext;
                 //$destinationPath = 'public/products/'.$model->product_lists_id;
                 $destinationPath = 'public/clientsays/';
                 $request->client_image->storeAs($destinationPath,$filename); 
                 $model->client_image= $filename;
           }
   
   
           $model->save();
           return redirect()->route('admin.clientsays.index')->with('message', 'Client quote updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ClientSay::where('id', '=', $id)->first();
        if($model->client_image !=""){
            if(Storage::exists('public/clientsays/'.$model->client_image))
            {
                Storage::delete('public/clientsays/'.$model->client_image);
            }
        }
        $model->delete();

        
        return redirect()->route('admin.clientsays.index')->with('message', 'Client quote deleted successfully');
    }

    public function status(Request $request, $status, $id){
        $model = ClientSay::where('id', $id)->first();
        $model->status=$status;
        $model->save();
        $request->session()->flash('message', 'status updated');
        return redirect()->route('admin.clientsays.index');
    }
}
