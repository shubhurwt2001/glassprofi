<?php

namespace App\Http\Controllers\Backend\Shippingcharge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Backend\ShippingCharge;
use App\Models\Backend\Country;
use Illuminate\Support\Facades\DB;

class ShippingchargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $data['shippingcharge'] = ShippingCharge::orderBy('id', 'desc')
        //                            ->get();
        $data['shippingcharge'] = DB::table('shipping_charges')
                                    ->join('countries', 'shipping_charges.countries_id', '=', 'countries.id')
                                    ->select('shipping_charges.*', 'countries.country_name')
                                    //->orderBy('id', 'desc')
                                    ->get();
       
        return view('backend.shippingcharge.shippingcharge_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['country'] = Country::orderBy('id', 'asc')
                                   ->get();
        return view('backend.shippingcharge.add_shippingcharge', $data);
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
            'postal_code' => 'required|unique:App\Models\Backend\ShippingCharge,postal_code,',
            'shipping_charge'=> 'required',
            
           ]);
           $model = new ShippingCharge;
          
           $model->countries_id = $request->input('country_name');
           $model->postal_code = $request->input('postal_code');
           $model->shipping_charge = $request->input('shipping_charge');
           $model->shipping_status = '1';
           
           $model->save();
           return redirect()->route('admin.shippingcharge.index')->with('message', 'Shipping charge added successfully');
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
        $data['shippingcharge'] = ShippingCharge::where('id', '=', $id)
                                ->orderBy('id', 'desc')
                                  ->get();
        $data['country'] = Country::orderBy('id', 'asc')
                                  ->get();
       return view('backend.shippingcharge.edit_shippingcharge', $data);
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
            'postal_code' => 'required|unique:App\Models\Backend\ShippingCharge,postal_code,'.base64_decode($request->input('id')),
            'shipping_charge'=> 'required',
            
           ]);
           
           $model = ShippingCharge::where('id', '=', $id)->first();
           $model->countries_id = $request->input('country_name');
           $model->postal_code = $request->input('postal_code');
           $model->shipping_charge = $request->input('shipping_charge');
           
           
           $model->save();
           return redirect()->route('admin.shippingcharge.index')->with('message', 'Shipping charge updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ShippingCharge::where('id', '=', $id)->first();
        $model->delete();

        
        return redirect()->back()->with('message', 'Shipping charge deleted successfully');
    }


    public function status(Request $request, $status, $id){
        $model = ShippingCharge::where('id', $id)->first();
        $model->shipping_status=$status;
        $model->save();
        $request->session()->flash('message', 'status updated');
        return redirect()->route('admin.shippingcharge.index');
    }
}
