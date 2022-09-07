<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\ProductDocument;
use App\Models\Backend\ProductList;
use Illuminate\Support\Facades\Storage;

class ProductdocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $product_slug = $request->get('product');
         $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'slug')->get();
         $data['productdocument'] = ProductDocument::where('product_lists_id', '=', $data['productlist'][0]->id)
                                  ->orderBy('id', 'desc')
                                  ->get();
         return view('backend.product.productdocument.productdocument', $data);
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
        return view('backend.product.productdocument.add_productdocument', $data);
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
            'product_document_name'=>'required',
            'product_document'=>'required|mimes:pdf|max:10000',
           ]);
        $model = new ProductDocument;
        $model->document_title = $request->input('product_document_name');
        $model->product_lists_id = $request->input('product_id');

        if($request->hasfile('product_document')){
            $request->validate([
                'product_document'=> 'mimes:pdf',
            ]);

            if(Storage::exists('public/products/'.$model->document))
              {
               Storage::delete('public/products/'.$model->document);
               
              }
              $ext = $request->product_document->extension();
              $filename=time().'_'.rand(11111, 99999).'.'.$ext;
              $destinationPath = 'public/products/';
              $request->product_document->storeAs($destinationPath,$filename); 
              $model->document= $filename;
              //die();
        }


        $model->save();

        $product_slug= $request->input('product_slug');
        return redirect()->route('admin.productdocument.index',['product'=>$product_slug])->with('message', 'Product document added successfully');
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
    public function edit(Request $request,$id)
    {
        $data['product_slug'] = $request->get('product');
        $data['product_document'] = ProductDocument::where('id', $id)->get();
        return view('backend.product.productdocument.edit_productdocument', $data);
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
            'product_document_name'=>'required',
            //'product_document'=>'required|mimes:pdf|max:10000',
           ]);

        $model = ProductDocument::where('id', '=', $id)->first();
        $model->document_title = $request->input('product_document_name');

        if($request->hasfile('product_document')){
            $request->validate([
                'product_document'=> 'mimes:pdf',
            ]);

            if(Storage::exists('public/products/'.$model->document))
              {
               Storage::delete('public/products/'.$model->document);
               
              }
              $ext = $request->product_document->extension();
              $filename=time().'_'.rand(11111, 99999).'.'.$ext;
              $destinationPath = 'public/products';
              $request->product_document->storeAs($destinationPath,$filename); 
              $model->document= $filename;
              //die();
        }
        
        $model->save();
        $product_slug= $request->input('product_slug');
        return redirect()->route('admin.productdocument.index',['product'=>$product_slug])->with('message', 'Product Document Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = ProductDocument::where('id', '=', $id)->first();
        if($model->document !=""){
            if(Storage::exists('public/products/'.$model->document))
            {
                Storage::delete('public/products/'.$model->document);
            }
        }
        $model->delete();
        $product_slug= $request->input('product_slug');
        return redirect()->route('admin.productdocument.index',['product'=>$product_slug])->with('message', 'Product document deleted successfully');
    }

    public function status(Request $request, $p_slug, $status, $id){
        
        $model = ProductDocument::where('id', $id)->first();
        $model->document_status=$status;
        $model->save();
        $request->session()->flash('message', 'Product document status updated');
        return redirect()->route('admin.productdocument.index',['product'=>$p_slug]);
    }



}
