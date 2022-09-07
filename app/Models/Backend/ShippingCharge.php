<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Backend\Country;

class ShippingCharge extends Model
{
    use HasFactory;

    public function country(){
        return $this->belongsTo(Country::class, 'countries_id', 'id');
    }
}
