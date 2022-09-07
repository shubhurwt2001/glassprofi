<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Backend\ProductAttribute;
use App\Models\Backend\ProductAttributeDimension;

class ProductAttributeImage extends Model
{
    use HasFactory;

    public function productattribute(){
        return $this->belongsTo(ProductAttribute::class, 'attr_id');
    }


    public function productattributedimension(){
        return $this->hasMany(ProductAttributeDimension::class, 'attr_image_id', 'id');
    }
}
