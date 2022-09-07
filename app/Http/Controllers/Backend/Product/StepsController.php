<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductAttribute;
use App\Models\Backend\ProductList;
use App\Models\Step;
use Illuminate\Http\Request;

class StepsController extends Controller
{
    public function index(Request $request)
    {
        $product_slug = $request->get('product');
        $data = ProductList::where('slug', '=', $product_slug)->select('id', 'name', 'slug')->first();
        $data->steps = Step::where('product_id', '=', $data->id)->orderBy('id', 'asc')->get();
        return view('backend.product.steps.steps', compact('data'));
    }

    public function create(Request $request)
    {
        $product_slug = $request->get('product');
        $data = ProductList::where('slug', '=', $product_slug)->select('id', 'name', 'slug')->first();
        return view('backend.product.steps.create', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $model = new Step();
        $model->name = $request->input('name');
        $model->product_id = $request->input('product_id');
        $model->status = 1;
        $model->save();

        $product_slug = $request->input('product_slug');
        return redirect()->route('admin.productstep.index', ['product' => $product_slug])->with('message', 'Product step added successfully');
    }

    public function edit(Request $request, $id)
    {
        $data = Step::where('id', $id)->first();
        $data->product_slug = $request->get('product');
        return view('backend.product.steps.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $model = Step::where('id', '=', $id)->first();
        $model->name = $request->input('name');
        $model->save();
        $product_slug = $request->input('product_slug');
        return redirect()->route('admin.productstep.index', ['product' => $product_slug])->with('message', 'Product step Updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $product_slug = $request->input('product_slug');
        if (ProductAttribute::where('step', $id)->first()) {
            return redirect()->route('admin.productstep.index', ['product' => $product_slug])->with('message', 'This step has one or more product attributes mapped to it. Change the step or delete the attributes.');
        }
        $model = Step::where('id', '=', $id)->first();
        $model->delete();

        return redirect()->route('admin.productstep.index', ['product' => $product_slug])->with('message', 'Product step deleted successfully');
    }
}
