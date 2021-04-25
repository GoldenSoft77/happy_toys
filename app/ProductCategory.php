<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Category;

class ProductCategory extends Model
{
    protected $table = 'product_category';

    public function products() {
        return $this->belongsTo('App\Product');
    }

    public function categories() {
        return $this->belongsTo('App\Category');
    }
}
