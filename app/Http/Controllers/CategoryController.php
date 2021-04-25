<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
     //  Show All categories
     public function index() {
        $categories = Category::all();
        return view('admin.categories.categories',compact('categories'));
    }


      // Create View
      public function create() {
        return view ('admin.categories.category_add');
    }

      // Add New Category
      public function store(Request $request) {
      
        $data = [
           
            'name' => $request->name
         
        ];
        if($request->file('img')){
            $file=$request->file('img');
            $path = 'images/categories/';
            $name=$file->getClientOriginalName();
            $name = $path.$name;
            $file->move($path,$name);
            $data['img'] = $name;
        }
        $cat = Category::create($data);
        return redirect('admin/categories')->with('message', 'New category has been added successfully');
    }

    // Edit View
    public function edit($id) {
    $category = Category::where('id',$id)->first();
    return view ('admin.categories.category_edit',compact('category'));
        }


    // Update Category
    public function update(Request $request, $id) {
        $category = Category::where('id',$id)->first();
       
        $data = [
           
                'name' =>$request->name
           
        ];
        if($request->file('img')){
            $file=$request->file('img');
            $path = 'images/categories/';
            $name=$file->getClientOriginalName();
            $name = $path.$name;
            $file->move($path,$name);
            $data['img'] = $name;
        }

        $category->update($data);
        return redirect()->back()->with('message', 'Category has been updated successfully');
    }


    // Delete Category
    public function destroy($id) {
        $category = Category::where('id',$id)->delete();
        return redirect()->back()->with('message', 'Category has been removed successfully');
    }
}
