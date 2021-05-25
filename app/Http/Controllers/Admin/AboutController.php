<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\About;
use App\Category;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $about = About::all()->first();
        $categories = Category::all();
        return view('front_views.about',compact('about','categories'));
    }

    //  ***** Admin Functions ***** //

    // Show About edit page   
    public function show() {
        $about = About::all()->first();
        return view('dashboard.about.about',compact('about'));

    }
    
    public function update(Request $request) {
        
        $about = About::all()->first();

        $request->validate([
            'about_desc' => 'required',
            'about_img' => 'max:2000'
        ],
        [
            'about_desc.required' => 'هذا الحقل مطلوب',
            'about_img.uploaded' => 'أقصى حجم للصورة 2M'
        ]);
        
        $about_desc = $request->about_desc;
        $data = [
            'ar' => [
                'description' => $about_desc,
            ]
        ];

        if($request->file('about_img')){
            if(\File::exists(public_path($about->img))){
                \File::delete(public_path($about->img));
            }
            $file=$request->file('about_img');
            $path = 'images/about/';
            $name=$file->getClientOriginalName();
            $name = $path.$name;
            $file->move($path,$name);
            $data['img'] = $name;
        }

        $about->update($data);

        return redirect()->back()->with('message','تم تعديل بيانات صفحة من نحن بنجاح');
    }

}
