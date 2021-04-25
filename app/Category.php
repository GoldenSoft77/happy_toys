<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','img'];


    public function products(){
        return $this->hasMany('App\Product');
    }
}
