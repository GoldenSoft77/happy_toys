<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductImage extends Model
{
    protected $table = 'product_imgs';

    public function products() {
        return $this->belongsTo('App\Product');
    }
}
