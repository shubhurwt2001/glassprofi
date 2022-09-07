<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Backend\ProductFeature;
use App\Models\Backend\ProductList;

class Productfeaturecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       //print_r($_GET);
            $product_slug = $request->get('product');
            // $data['productlist']= DB::table('product_lists')
            //                 ->join('navbars', 'product_lists.navbars_id', '=', 'navbars.id')
            //                 ->where(['product_lists.slug' => $product_slug ])
            //                 ->select('product_lists.id as product_id', 'product_lists.slug as product_slug', 'navbars.id as category_id', 'navbars.category_name')
            //                 ->orderby('product_lists.id', 'desc')
            //                 ->get();
            $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'name', 'slug')->get();
            $data['productfeature'] = ProductFeature::where('product_lists_id', '=', $data['productlist'][0]->id)
                                    //->select('id', 'category_name', 'parent_category_id')
                                    ->orderBy('id', 'desc')
                                    ->get();
            // echo "<pre>";
            // print_r($data['productfeature']);
            // die();
            return view('backend.product.productfeature.productfeature', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product_slug = $request->get('product');
       
        $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'slug')->get();
       
        return view('backend.product.productfeature.add_productfeature', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($_POST);;
        // die();
        $this->validate($request, [
            'product_feature_name'=>'required',
            'product_feature'=>'required',
           ]);
        $model = new ProductFeature;
        $model->feature_title = $request->input('product_feature_name');
        $model->feature = $request->input('product_feature');
        $model->product_lists_id = $request->input('product_id');
        $model->pro_feature_serial_no = $request->input('pro_feature_sl_no');
        $model->save();

        $product_slug= $request->input('product_slug');
        return redirect()->route('admin.productfeature.index',['product'=>$product_slug])->with('message', 'Product Feature added successfully');
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
    public function edit(Request $request, $id)
    {
        $data['product_slug'] = $request->get('product');
        //$data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'slug')->get();

        $data['product_feature'] = ProductFeature::where('id', $id)->get();
        return view('backend.product.productfeature.edit_productfeature', $data);
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
            'product_feature_name'=>'required',
            'product_feature'=>'required',
           ]);

        $model = ProductFeature::where('id', '=', $id)->first();
        $model->feature_title = $request->input('product_feature_name');
        $model->feature = $request->input('product_feature');
        $model->pro_feature_serial_no = $request->input('pro_feature_sl_no');
        $model->save();
        $product_slug= $request->input('product_slug');
        return redirect()->route('admin.productfeature.index',['product'=>$product_slug])->with('message', 'Product Feature Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       
        $model = ProductFeature::where('id', '=', $id)->first();
        $model->delete();
        $product_slug= $request->input('product_slug');
        return redirect()->route('admin.productfeature.index',['product'=>$product_slug])->with('message', 'Product Feature Deleted successfully');
    }

    public function status(Request $request, $p_slug, $status, $id){
        //echo $p_slug;
        //die();
        $model = ProductFeature::where('id', $id)->first();
        $model->feature_status=$status;
        $model->save();
        $request->session()->flash('message', 'Product feature status updated');
        //return redirect()->route('admin.productlist.index');
        return redirect()->route('admin.productfeature.index',['product'=>$p_slug]);
    }


}
