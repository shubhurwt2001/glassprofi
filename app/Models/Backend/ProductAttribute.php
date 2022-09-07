<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Backend\ProductList;
use App\Models\Backend\ProductAttributeImage;

class ProductAttribute extends Model
{
    use HasFactory;

    public function productattribute(){
        return $this->belongsTo(ProductList::class, 'product_lists_id');
    }

    public function productattributeimage(){
        return $this->hasMany(ProductAttributeImage::class, 'attr_id', 'id');
    }
}
