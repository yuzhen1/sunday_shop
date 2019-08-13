<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    //
    protected $table = 'shop_order';
    public $timestamps = false;
    public $primaryKey = 'order_id';
}
