<?php

namespace App\Http\Controllers\Frontend\Sampleproduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\SampleProduct;
use App\Models\Backend\ProductList;

class SampleProductController extends Controller
{
    public function user_test_samples(){
        //return view('frontend.samples.testsamples');
        //$data['sample_product'] = SampleProduct::where('pro_status', '=', '1')->get();
        $data['sample_product'] = ProductList::where(['pro_status'=>'1', 'sample_product'=>'Yes'])->get();
       //dd($data['sample_product']);
        return view('frontend.samples.sample_list', $data);
    }

    public function user_samples_details(Request $request, $sample_product_slug){
        $slug = base64_decode($sample_product_slug);
        //$data['sample_product_detail'] = SampleProduct::where('slug', '=', $slug)->get();
        $data['sample_product_detail'] = ProductList::where(['slug'=> $slug,'pro_status'=>'1', 'sample_product'=>'Yes'])->get();
        //dd($data['sample_product_detail']);
        return view('frontend.samples.sample_list_details', $data);
    }
}
