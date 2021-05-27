<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Category;
use App\Item;

class IndexController extends Controller {
    
    public function index() {
        $slides = Slider::all();
        $categories_item = Category::orderBy('id','DESC')->take(10)->get();
        $items = Item::orderBy('id','DESC')->take(16)->get();
        $categories = Category::all();
        return view('front_views.index',compact('slides','categories','items','categories_item'));

    }
    public function contact() {
        $slides = Slider::all();
        $categories_item = Category::orderBy('id','DESC')->take(10)->get();
        $items = Item::orderBy('id','DESC')->take(16)->get();
        $categories = Category::all();
        return view('front_views.contact',compact('slides','categories','items','categories_item'));

    }
    
}
