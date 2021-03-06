<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Category;
use App\ItemImage;

class Item extends Model
{
    use Translatable;
    protected $table = 'items';
    protected $fillable = ['price','count','new_price','real_price','vendor_name'];
    public $translatedAttributes = ['name','description'];

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function images(){
        return $this->hasMany('App\ItemImage');
    }

}
