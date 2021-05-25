<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    public function index(){
        
    }

    //  ***** Admin Functions ***** //

    // Show Admin homepage
    public function admin() {
        $categories = Category::orderBy('id','DESC')->paginate(15);
        return view('dashboard.category.category',compact('categories'));
    }
    
    public function create() {
        return view('dashboard.category.category-add');
    }
    

    public function store(Request $request) {

        $category = new Category;
        $last_cat = Category::latest('id')->first();
        if ($last_cat == NULL) {
            $i = 1;
        } else {
            $i = $last_cat->id + 1;
        }
        $request->validate([
            'category_title' => 'required',
            'img' => 'required|max:2000'
        ],
        [
            'category_title.required' => 'هذا الحقل مطلوب',
            'img.required' => 'هذا الحقل مطلوب',
            'img.uploaded' => 'أقصى حجم للصورة 2M'
        ]);
        
        $category_title = $request->category_title;
        $data = [
            'ar' => [
                'name' => $category_title,
            ]
        ];
        
        if($request->file('img')){
            $file=$request->file('img');
            $path = 'images/category/';
            $name=$file->getClientOriginalName();
            $name = $path.'category_'.$i.$name;
            $file->move($path,$name);
            $data['img'] = $name;
        }

        $category->create($data);

        return redirect('/admin/categories')->with('message','تم إضافة تصنيف جديد بنجاح');

    }
    
    public function show($id) {
    }

    
    public function edit($id) {
        $category = Category::where('id',$id)->first();
        return view('dashboard.category.category-edit',compact('category'));
    }
    
    public function update(Request $request, $id) {
        
        $category = Category::where('id',$id)->first();

        $request->validate([
            'category_title' => 'required',
            'img' => 'max:2000'
        ],
        [
            'category_title.required' => 'هذا الحقل مطلوب',
            'img.uploaded' => 'أقصى حجم للصورة 2M'
        ]);
        
        $category_title = $request->category_title;
        $data = [
            'ar' => [
                'name' => $category_title,
            ]
        ];

        if($request->file('img')){
            if(\File::exists(public_path($category->img))){
                \File::delete(public_path($category->img));
            }
            $file=$request->file('img');
            $path = 'images/category/';
            $name=$file->getClientOriginalName();
            $name = $path.$name.'_category_'.$category->id;
            $file->move($path,$name);
            $data['img'] = $name;
        }

        $category->update($data);

        return redirect()->back()->with('message','تم تعديل بيانات التصنيف بنجاح');
    }

    public function destroy($id) {
        $category = Category::where('id',$id)->first();
        if(\File::exists(public_path($category->img))){
            \File::delete(public_path($category->img));
        }
        $category->delete();
        return redirect('/admin/categories')->with('message','تم حذف التصنيف بنجاح');
    }
}
