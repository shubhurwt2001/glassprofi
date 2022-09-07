<?php

namespace App\Http\Controllers\Backend\Shippingcharge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('you are here');
        $data['country'] = Country::orderBy('id', 'desc')
                                   ->get();
        return view('backend.country.country_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.country.add_country');
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
            'country_name'=>'required',
            'country_slug' => 'required|unique:App\Models\Backend\Country,country_slug,',
            
           ]);
           $model = new Country;
          
           $model->country_name = $request->input('country_name');
           $model->country_slug = $request->input('country_slug');
           
           $model->save();
           return redirect()->route('admin.country.index')->with('message', 'Country added successfully');
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
        $data['country'] = Country::where('id', '=', $id)
                                ->orderBy('id', 'desc')
                                  ->get();
      
       return view('backend.country.edit_country', $data);
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
            'country_name'=>'required',
            'country_slug' => 'required|unique:App\Models\Backend\Country,country_slug,' .base64_decode($request->input('id')),
            
           ]);
           $model = Country::where('id', '=', $id)->first();
           $model->country_name = $request->input('country_name');
           $model->country_slug = $request->input('country_slug');
           
           $model->save();
           return redirect()->route('admin.country.index')->with('message', 'Country updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Country::where('id', '=', $id)->first();
        $model->delete();

        
        return redirect()->back()->with('message', 'Country deleted successfully');
    }
}
