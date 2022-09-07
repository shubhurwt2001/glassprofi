<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Backend\ShippingCharge;

class Country extends Model
{
    use HasFactory;

    public function shippingcharge(){
        return $this->hasMany(ShippingCharge::class, 'countries_id', 'id');
    }
}
