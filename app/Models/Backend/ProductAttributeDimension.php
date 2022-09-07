<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Backend\ProductAttributeImage;

class ProductAttributeDimension extends Model
{
    use HasFactory;

    public function productattributeimage(){
        return $this->belongsTo(ProductAttributeImage::class, 'attr_image_id');
    }

}
