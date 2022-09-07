<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use  App\Models\Backend\ProductList;

use GrahamCampbell\Markdown\Facades\Markdown;

class Navbar extends Model
{
    use HasFactory;
    //protected $fillable = [];
    //protected $guarded =[];

     public function childs() {
         return $this->hasMany('App\Models\Backend\Navbar','parent_category_id','id') ;
     }

     public function parent() {
        return $this->hasone('App\Models\Backend\Navbar', 'id', 'parent_category_id') ;
    }

     
     public function productlist()
    {
        return $this->hasMany(ProductList::class, 'navbars_id', 'id')->where('sample_product', '=', 'No');
    }

    public function getNavShortDescriptionAttribute($value){
        
        return $this->nav_short_desc ? Markdown::convertToHtml(e($this->nav_short_desc)):NULL;
      }

    public function getNavDescriptionAttribute($value){
        
        return $this->nav_desc ? Markdown::convertToHtml(e($this->nav_desc)):NULL;
      }

    
}
