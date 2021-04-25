<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\ProductCategory;
use App\Category;

class ProductController extends Controller
{
     // All Products 
     public function index() {
        $products = Product::all();
        return view('admin.products.products',compact('products'));
    }

     // Show Products Category
     public function productsCategory($id) {
        $products = Product::where('category_id',$id)->get();
        $categories = Category::where('id',$id)->first();
        return view('products-category',compact('products','categories'));
    }
      // Add New Product
      public function create() {
        $categories = Category::all();
        return view('admin.products.product_add',compact('categories'));
    }

     // New Product Save
     public function store(Request $request) {

       
        $data = [
            'name' => $request->name,
           'description' => $request->description,
           'price' => $request->price,
           'old_price' => $request->old_price,
              
           ];
      
        // Product Main Image
        if($request->file('img')){
            $file = $request->file('img');
            $path = 'images/product/';
            $name = $file->getClientOriginalName();
            $name = $path.$name;
            $file -> move($path,$name);
            $data['img'] = $name;
        }
       
        $product = Product::create($data);

        $categories = $request->category_id;
         foreach ($categories as $category) {
            ProductCategory::insert( [
                'category_id'=>  $category,
                'product_id'=> $product->id
            ]);
         }
         
         if($request->file('images')){
            $files = $request->file('images');
           
            foreach($files as $file){
                $path = 'images/'.$product->name.'/';
                $name=$file->getClientOriginalName();
                $name = $path.$name;
                $file->move($path,$name);
                ProductImage::insert( [
                    'img'=>  $name,
                    'product_id'=> $product->id
                ]);
                $images[]=$name;
            }
        }

        return redirect('admin/products')->with('message', 'The Product has been added successfully');

    }
    

    // Edit Product View
    public function edit($id) {
        $product = Product::where('id',$id)->first();
        $categories = Category::all();
        return view('admin.products.product_edit',compact('product','categories'));
    }
    

    // Save Edit Product
    public function update(Request $request, $id) {

        $product = Product::where('id',$id)->first();

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
           
        ];


        // Product Main Image
        if($request->file('img')){
            $file = $request->file('img');
            $path = 'images/product/';
            $name = $file->getClientOriginalName();
            $name = $path.$name;
            $file -> move($path,$name);
            $data['main_img'] = $name;
        }
        $categories = $request->category_id;
        foreach ($categories as $category) {
         $data['category_id'] = $category;
         $product->update($data);
        }
        
        // Product Secondary Images
        if($request->file('images')){
            $files = $request->file('images');
            foreach($files as $file){
                $path = 'images/'.$product->name.'/';
                $name=$file->getClientOriginalName();
                $name = $path.$name;
                $file->move($path,$name);
                ProductImage::insert( [
                    'img'=>  $name,
                    'product_id'=> $product->id
                ]);
                $images[]=$name;
            }
        }

        $product->update($data);
        return redirect()->back()->with('message', 'Product has been updated successfully');
        
    }
    

    // Delete Product
    public function destroy($id) {
        $product = Product::where('id',$id)->delete();
        return redirect()->back()->with('message', 'Product has been removed successfully');

    }
}
