<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails';
    protected $fillable = ['ordered_id', 'user_id', 'product_id', 'quantity', 'price'];
}
