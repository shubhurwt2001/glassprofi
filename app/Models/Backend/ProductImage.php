<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\ProductList;

class ProductImage extends Model
{
    use HasFactory;

    public function productlist(){
        return $this->belongsTo(ProductList::class, 'product_lists_id', 'id');
    }
}
