<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Backend\ProductAttribute;
use App\Models\Backend\ProductList;
use App\Models\Backend\ProductAttributeImage;
use App\Models\Backend\ProductAttributeDimension;
use App\Models\Step;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product_slug = $request->get('product');
        $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'name', 'slug')->get();
        $data['productattribute'] = ProductAttribute::where('product_lists_id', '=', $data['productlist'][0]->id)
            ->orderBy('id', 'asc')
            ->get();

        foreach ($data['productattribute'] as $d) {
            $d->step_detail = Step::where('id', $d->step)->first();
        }
        // echo "<pre>";
        // print_r($data['productlist']);
        // die();
        return view('backend.product.productattribute.productattribute', $data);
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
        $data['steps'] = Step::where('product_id', '=', $data['productlist'][0]->id)->orderBy('id', 'asc')->get();
        return view('backend.product.productattribute.add_productattribute', $data);
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
            'attribute_name' => 'required',
            'step' => 'required'
        ]);
        $model = new ProductAttribute;
        $model->attribute_name = $request->input('attribute_name');
        $model->product_lists_id = $request->input('product_id');
        $model->step = $request->input('step');
        $model->required = $request->input('required');
        $model->repeat = $request->input('repeat');
        $model->repeat_button_text = $request->input('repeat_button_text');
        $model->save();
        $product_slug = $request->input('product_slug');
        return redirect()->route('admin.productattribute.index', ['product' => $product_slug])->with('message', 'Product attribute added successfully');
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
        $product = ProductList::where('slug', '=', $data['product_slug'])->first();
        $data['productattribute'] = ProductAttribute::where('id', $id)->get();
        $data['steps'] = Step::where('product_id', '=', $product->id)->orderBy('id', 'asc')->get();
        return view('backend.product.productattribute.edit_productattribute', $data);
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
            'attribute_name' => 'required',
            'step' => 'required',
        ]);
        $model = ProductAttribute::where('id', '=', $id)->first();
        $model->attribute_name = $request->input('attribute_name');
        $model->step = $request->input('step');
        $model->required = $request->input('required');
        $model->repeat = $request->input('repeat');
        $model->repeat_button_text = $request->input('repeat_button_text');
        $model->save();
        $product_slug = $request->input('product_slug');
        return redirect()->route('admin.productattribute.index', ['product' => $product_slug])->with('message', 'Product attribute Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = ProductAttribute::where('id', '=', $id)->first();
        $model->delete();
        $product_slug = $request->input('product_slug');
        return redirect()->route('admin.productattribute.index', ['product' => $product_slug])->with('message', 'Product attribute deleted successfully');
    }

    public function status(Request $request, $p_slug, $status, $id)
    {

        $model = ProductAttribute::where('id', $id)->first();
        $model->attribute_status = $status;
        $model->save();
        $request->session()->flash('message', 'Product image status updated');
        return redirect()->route('admin.productattribute.index', ['product' => $p_slug]);
    }

    public function create_attribute_image(Request $request, $id,  $p_slug)
    {
        $id = base64_decode($id);
        $product_slug = $p_slug;
        $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'name', 'slug')->get();
        $data['productattribute'] = ProductAttribute::where('id', '=', $id)
            ->orderBy('id', 'desc')
            ->get();
        return view('backend.product.attributeimage.add_attribute_image', $data);
    }

    public function store_attribute_image(Request $request)
    {

        $this->validate($request, [
            'image_name' => 'required',
            'price_from' => 'required|min:0',
            'product_attribute_image' => 'required',
        ]);

        $model = new ProductAttributeImage;
        $model->attr_image_name = $request->input('image_name');
        $model->attr_price_from = $request->input('price_from');
        $model->attr_id = $request->input('product_attribute_id');

        if ($request->hasfile('product_attribute_image')) {
            $request->validate([
                'product_attribute_image' => 'mimes:jpeg,jpg,png,webp',
            ]);

            $ext = $request->product_attribute_image->extension();
            $filename = time() . '_' . rand(11111, 99999) . '.' . $ext;
            //$destinationPath = 'public/products/'.$model->product_lists_id;
            $destinationPath = 'public/products/';
            $request->product_attribute_image->storeAs($destinationPath, $filename);
            $model->attr_image = $filename;
        }
        $model->save();
        $product_slug = $request->input('product_slug');
        return redirect()->route('admin.productattribute.index', ['product' => $product_slug])->with('message', 'Product attribute image added successfully');
    }

    public function manage_attribute_image(Request $request, $id,  $p_slug)
    {
        $id = base64_decode($id);
        $product_slug = $p_slug;
        $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'name', 'slug')->get();
        $data['productattribute'] = ProductAttribute::where('id', '=', $id)
            ->orderBy('id', 'desc')
            ->get();
        $data['productattribute_image'] = ProductAttributeImage::where('attr_id', '=', $data['productattribute'][0]->id)
            ->orderBy('id', 'desc')
            ->get();
        // echo "<pre>";
        // print_r($data['productattribute_image']);
        // die();
        return view('backend.product.attributeimage.manage_attribute_image', $data);
    }


    public function edit_attribute_image(Request $request, $attr_image_id,  $p_slug, $attr_id)
    {
        //dd('you are in attr image edit');
        $attr_id = base64_decode($attr_id);
        $attr_image_id = base64_decode($attr_image_id);

        $product_slug = $p_slug;
        $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'name', 'slug')->get();
        $data['productattribute'] = ProductAttribute::where('id', '=', $attr_id)
            ->orderBy('id', 'desc')
            ->get();
        $data['productattribute_image'] = ProductAttributeImage::where('id', '=', $attr_image_id)
            ->orderBy('id', 'desc')
            ->get();

        // echo "<pre>";
        // print_r($data['productattribute_image']);
        // die();
        return view('backend.product.attributeimage.edit_attribute_image', $data);
    }

    public function update_attribute_image(Request $request)
    {
        // echo "<pre>";
        // print_r($_POST);
        // die();

        $this->validate($request, [
            'image_name' => 'required',
            'price_from' => 'required|min:0',

        ]);

        $model = ProductAttributeImage::where('id', '=', $request->input('product_attribute_image_id'))->first();
        $model->attr_image_name = $request->input('image_name');
        $model->attr_price_from = $request->input('price_from');
        //$model->attr_id = $request->input('product_attribute_id');

        if ($request->hasfile('product_attribute_image')) {
            $request->validate([
                'product_attribute_image' => 'mimes:jpeg,jpg,png,webp',
            ]);

            $ext = $request->product_attribute_image->extension();
            $filename = time() . '_' . rand(11111, 99999) . '.' . $ext;
            //$destinationPath = 'public/products/'.$model->product_lists_id;
            $destinationPath = 'public/products/';
            $request->product_attribute_image->storeAs($destinationPath, $filename);
            $model->attr_image = $filename;
        }
        $model->save();
        $p_slug = $request->input('product_slug');
        $attr_id = $request->input('product_attribute_id');
        //return redirect()->route('admin.productattribute.index',['product'=>$product_slug])->with('message', 'Product attribute image updated successfully');
        return redirect()->route('admin.productattribute.manage.image', ['id' => base64_encode($attr_id), 'product' => $p_slug])->with('message', 'Product attribute image updated successfully');
    }


    public function destroy_attribute_image(Request $request, $id)
    {
        $id = base64_decode($id);
        $model = ProductAttributeImage::where('id', '=', $id)->first();
        if ($model->attr_image_status != "") {
            if (Storage::exists('public/products/' . $model->attr_image_status)) {
                Storage::delete('public/products/' . $model->attr_image_status);
            }
        }
        $model->delete();
        $product_slug = $request->input('product_slug');
        return redirect()->route('admin.productattribute.index', ['product' => $product_slug])->with('message', 'Product attribute image deleted successfully');
    }

    public function attr_image_status(Request $request, $p_slug, $status, $attr_img_id, $attr_id)
    {
        //dd('you are in attr image status');
        $model = ProductAttributeImage::where('id', $attr_img_id)->first();
        $model->attr_image_status = $status;
        $model->save();
        $request->session()->flash('message', 'Product attribute image status updated');
        return redirect()->route('admin.productattribute.manage.image', ['id' => base64_encode($attr_id), 'product' => $p_slug]);
    }

    public function create_attribute_dimensions(Request $request, $attr_image_id,  $p_slug, $attr_id)
    {
        $attr_image_id = base64_decode($attr_image_id);
        $product_slug = $p_slug;
        $attr_id = base64_decode($attr_id);
        $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'name', 'slug')->get();
        $data['productattribute'] = ProductAttribute::where('id', '=', $attr_id)
            ->orderBy('id', 'desc')
            ->get();
        $data['productattribute_image'] = ProductAttributeImage::where('id', '=', $attr_image_id)
            ->orderBy('id', 'desc')
            ->get();

        $data['dropdown'] = ['a', 'b', 'c', 'd'];
        foreach ($data['dropdown'] as $key => $drop) {
            if (ProductAttributeDimension::where(['attr_image_id' => $data['productattribute_image'][0]->id, 'side' => $drop])->first()) {
                unset($data['dropdown'][$key]);
            }
        }
        // echo "<pre>";
        // print_r($data['productattribute']);
        // die();
        return view('backend.product.attributeimagedimensions.add_attribute_dimension', $data);
    }

    public function store_attribute_dimensions(Request $request)
    {

        $this->validate($request, [
            'dimension_name' => 'required',
            'dimension_description' => 'required',
            'side' => 'required'
        ]);
        // echo "<pre>";
        // print_r($_POST);
        // die();
        $model = new ProductAttributeDimension;
        $model->dim_name = $request->input('dimension_name');
        $model->dim_description = $request->input('dimension_description');
        $model->dim_start = $request->input('dimension_start_point');
        $model->dim_end = $request->input('dimension_end_point');
        $model->side = $request->input('side');
        $model->attr_image_id = $request->input('product_attribute_image_id');
        $model->save();
        $product_slug = $request->input('product_slug');
        $id = base64_encode($request->input('product_attribute_id'));

        return redirect()->route('admin.productattribute.manage.image', ['id' => $id, 'product' => $product_slug])->with('message', 'Product attribute image dimension added successfully');
    }

    public function manage_attribute_dimension(Request $request, $attr_image_id,  $p_slug, $attr_id)
    {
        $attr_image_id = base64_decode($attr_image_id);
        $product_slug = $p_slug;
        $attr_id = base64_decode($attr_id);
        $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'name', 'slug')->get();
        $data['productattribute'] = ProductAttribute::where('id', '=', $attr_id)
            ->orderBy('id', 'desc')
            ->get();
        $data['productattribute_image'] = ProductAttributeImage::where('id', '=', $attr_image_id)
            ->orderBy('id', 'desc')
            ->get();
        $data['productattribute_dimension'] = ProductAttributeDimension::where('attr_image_id', '=', $data['productattribute_image'][0]->id)
            ->orderBy('id', 'asc')
            ->get();

        return view('backend.product.attributeimagedimensions.manage_attribute_dimension', $data);
    }

    public function edit_attribute_dimension(Request $request, $attr_dimension_id, $attr_image_id,  $p_slug, $attr_id)
    {
        //dd('you are in edit attribute dimension');

        $attr_id = base64_decode($attr_id);
        $attr_image_id = base64_decode($attr_image_id);
        $attr_dimension_id = base64_decode($attr_dimension_id);

        $product_slug = $p_slug;
        $data['productlist'] = ProductList::where('slug', '=', $product_slug)->select('id', 'name', 'slug')->get();
        $data['productattribute'] = ProductAttribute::where('id', '=', $attr_id)
            ->orderBy('id', 'desc')
            ->get();
        $data['productattribute_image'] = ProductAttributeImage::where('id', '=', $attr_image_id)
            ->orderBy('id', 'desc')
            ->get();
        $data['productattribute_dimension'] = ProductAttributeDimension::where('id', '=', $attr_dimension_id)
            ->orderBy('id', 'desc')
            ->get();


        $data['dropdown'] = ['a', 'b', 'c', 'd'];
        foreach ($data['dropdown'] as $key => $drop) {
            if ($data['productattribute_dimension'][0]->side == $drop) {
                continue;
            }
            if (ProductAttributeDimension::where(['attr_image_id' => $data['productattribute_image'][0]->id, 'side' => $drop])->first()) {
                unset($data['dropdown'][$key]);
            }
        }
        return view('backend.product.attributeimagedimensions.edit_attribute_dimension', $data);
    }

    public function update_attribute_dimension(Request $request)
    {
        //    echo "<pre>";
        //    print_r($_POST);
        //    die();
        $this->validate($request, [
            'dimension_name' => 'required',
            'dimension_description' => 'required',
            'side' => 'required'
        ]);

        $model = ProductAttributeDimension::where('id', '=', $request->input('product_attribute_dimension_id'))->first();
        $model->dim_name = $request->input('dimension_name');
        $model->dim_description = $request->input('dimension_description');
        $model->dim_start = $request->input('dimension_start_point');
        $model->dim_end = $request->input('dimension_end_point');
        $model->side = $request->input('side');
        $model->save();
        //$attr_image_id,  $p_slug, $attr_id
        //$attr_dimension_id = $request->input('product_attribute_dimension_id');
        $attr_image_id = base64_encode($request->input('product_attribute_image_id'));
        $p_slug = $request->input('product_slug');
        $attr_id = base64_encode($request->input('product_attribute_id'));
        return redirect()->route('admin.productattribute.manage.dimension', ['attr_image_id' => $attr_image_id, 'product' => $p_slug, 'attr_id' => $attr_id])->with('message', 'Product attribute dimension updated successfully');
    }

    public function destroy_attribute_dimension(Request $request, $id)
    {
        $id = base64_decode($id);
        $model = ProductAttributeDimension::where('id', '=', $id)->first();
        $model->delete();
        //$product_slug= $request->input('product_slug');
        //return redirect()->route('admin.productattribute.index',['product'=>$product_slug])->with('message', 'Product attribute image deleted successfully');

        $attr_image_id = base64_encode($request->input('product_attribute_image_id'));
        $p_slug = $request->input('product_slug');
        $attr_id = base64_encode($request->input('product_attribute_id'));
        return redirect()->route('admin.productattribute.manage.dimension', ['attr_image_id' => $attr_image_id, 'product' => $p_slug, 'attr_id' => $attr_id])->with('message', 'Product attribute dimension deleted successfully');
    }


    public function attr_dimension_status(Request $request, $p_slug, $status, $attr_dimension_id, $attr_id, $attr_image_id)
    {

        //dd('you are in attr dimension status');
        $attr_dimension_id = base64_decode($attr_dimension_id);
        $model = ProductAttributeDimension::where('id', $attr_dimension_id)->first();
        $status = base64_decode($status);
        $model->attr_dim_status = $status;
        $model->save();
        $p_slug = base64_decode($p_slug);


        return redirect()->route('admin.productattribute.manage.dimension', ['attr_image_id' => $attr_image_id, 'product' => $p_slug, 'attr_id' => $attr_id])->with('message', 'Product attribute dimension status updated successfully');
    }
}
