<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Navbar;
use GrahamCampbell\Markdown\Facades\Markdown;

use App\Models\Backend\ProductAttribute;
use App\Models\Backend\ProductImage;

class ProductList extends Model
{
    use HasFactory;
    //protected $fillable = [ ];
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // public function navbar()
    // {
    //     return $this->belongsTo(Navbar::class, 'navbars_id');
    // }

    public function navbar()
    {
        return $this->belongsTo(Navbar::class, 'navbars_id', 'id');
    }

    public function getExcerptHtmlAttribute($value){
        
        return $this->desc ? Markdown::convertToHtml(e($this->desc)):NULL;
    }

    public function getShortExcerptHtmlAttribute($value){
        
        return $this->short_desc ? Markdown::convertToHtml(e($this->short_desc)):NULL;
    }

    public function productattribute(){
        return $this->hasMany(ProductAttribute::class, 'product_lists_id', 'id');
    }

    public function productimage(){
        return $this->hasMany(ProductImage::class, 'product_lists_id', 'id');
    }
}
