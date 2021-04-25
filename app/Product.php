<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductImage;
use App\Category;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','description','price','old_price','img'];

    public function images() {
        return $this->hasMany('App\ProductImage');
    }  

    public function Category() {
        return $this->belongsTo('App\Category');
    }
}
