<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlists';
    protected $fillable = ['user_id', 'product_id', 'brand_id', 'type_id'];
}
