<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    //

    public function shipping_address()
    {
        return $this->hasOne('App\ShippingAddress','shipping_address_id');
    }
}
