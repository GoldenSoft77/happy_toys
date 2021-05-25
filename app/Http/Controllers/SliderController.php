<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Illuminate\Support\Str;

class SliderController extends Controller
{

    public function index() {
        
    }

    
    //  ***** Admin Functions ***** //

    // Show Admin homepage
    public function admin() {
        $slides = Slider::orderBy('id','DESC')->paginate(15);
        return view('dashboard.slider.slider',compact('slides'));
    }
    
    public function create() {
        return view('dashboard.slider.slider-add');
    }
    

    public function store(Request $request) {

        $slide = new Slider;
        $last_slide = Slider::latest('id')->first();
        if ($last_slide == NULL) {
            $i = 1;
        } else {
            $i = $last_slide->id + 1;
        }
        $request->validate([
            'slider_title' => 'required',
            'slider_desc' => 'required',
            'img' => 'required|max:2000'
        ],
        [
            'slider_title.required' => 'هذا الحقل مطلوب',
            'slider_desc.required' => 'هذا الحقل مطلوب',
            'img.required' => 'هذا الحقل مطلوب',
            'img.uploaded' => 'أقصى حجم للصورة 2M'
        ]);
        
        $slider_title = $request->slider_title;
        $slider_desc = $request->slider_desc;
        $slider_link = $request->slider_link;
        $data = [
            'link' => $slider_link,
            'ar' => [
                'title' => $slider_title,
                'description' => $slider_desc,
            ]
        ];
        
        if($request->file('img')){
            $file=$request->file('img');
            $path = 'images/slider/';
            $name=$file->getClientOriginalName();
            $name = $path.'slider_'.$i.$name;
            $file->move($path,$name);
            $data['img'] = $name;
        }

        $slide->create($data);

        return redirect('/admin/slider')->with('message','تم إضافة سلايد جديد بنجاح');

    }
    
    public function show($id) {
    }

    
    public function edit($id) {
        $slide = Slider::where('id',$id)->first();
        return view('dashboard.slider.slider-edit',compact('slide'));
    }
    
    public function update(Request $request, $id) {
        
        $slide = Slider::where('id',$id)->first();

        $request->validate([
            'slider_title' => 'required',
            'slider_desc' => 'required',
            'img' => 'max:2000'
        ],
        [
            'slider_title.required' => 'هذا الحقل مطلوب',
            'slider_desc.required' => 'هذا الحقل مطلوب',
            'img.uploaded' => 'أقصى حجم للصورة 2M'
        ]);
        
        $slider_title = $request->slider_title;
        $slider_desc = $request->slider_desc;
        $slider_link = $request->slider_link;
        $data = [
            'link' => $slider_link,
            'ar' => [
                'title' => $slider_title,
                'description' => $slider_desc,
            ]
        ];

        if($request->file('img')){
            if(\File::exists(public_path($slide->img))){
                \File::delete(public_path($slide->img));
            }
            $file=$request->file('img');
            $path = 'images/slider/';
            $name=$file->getClientOriginalName();
            $name = $path.$name.'_slider_'.$slide->id;
            $file->move($path,$name);
            $data['img'] = $name;
        }

        $slide->update($data);

        return redirect()->back()->with('message','تم تعديل بيانات السلايد بنجاح');
    }

    public function destroy($id) {
        $slide = Slider::where('id',$id)->first();
        if(\File::exists(public_path($slide->img))){
            \File::delete(public_path($slide->img));
        }
        $slide->delete();
        return redirect('/admin/slider')->with('message','تم حذف السلايد بنجاح');
    }
    
}
