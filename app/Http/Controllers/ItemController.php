<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Item;
use App\ItemImage;
use App\Category;
use App\CategoryItem;

class ItemController extends Controller
{
   
    public function index(){
        $items = Item::orderBy('id','DESC')->paginate(15);
        $categories = Category::all();
        return view('front_views.products',compact('items','categories'));
    }

    public function item($id) {
        $category = Category::find($id);
        $items = $category->items;
        $categories = Category::all();
        return view('front_views.products-cat',compact('items','categories'));
    }

    public function single($id) {
        $pro = Item::where('id',$id)->first();
        $items = Item::orderBy('id','DESC')->take(10)->get();
        $categories = Category::all();
        return view('front_views.single-product',compact('pro','items','categories'));
    }

  
}
