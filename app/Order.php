<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order_details()
    {
        return $this->hasOne('App\OrderDetails','order_details_id');
    }

}
