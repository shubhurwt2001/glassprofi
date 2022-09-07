<?php

namespace App\Http\Controllers\Backend\Siteseo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\PageSeo;
use Illuminate\Support\Facades\DB;

class SiteseoController extends Controller
{
    public function index(){
        $pageseo = [];
        $pageseo = PageSeo::get();
        return view('backend.pageseo.pageseo_index', compact('pageseo'));
    }

    public function edit(Request $request, $id) {
       $homepageseo = [];
       $homepageseo = PageSeo::where('id', '=', $id)->first();
       return view('backend.pageseo.pageseo_edit', compact('homepageseo'));
    }

    public function update(Request $request, $id){
       
       $model = PageSeo::where('id', '=', $id)->first();
       $model->meta_title= $request->input('meta_title');
       $model->meta_keywords=$request->input('meta_keywords');
       $model->meta_description=$request->input('meta_description');

       $model->save();
       return redirect()->route('admin.seo')->with('message', "Data updated successfully");

    }
}
