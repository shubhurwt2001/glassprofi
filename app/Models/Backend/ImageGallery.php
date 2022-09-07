<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    use HasFactory;
    //protected $fillable = [ ];
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
