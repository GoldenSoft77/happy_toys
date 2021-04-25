<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{
     //  Show All slider
     public function index() {
        $sliders = Slider::all();
        return view('admin.sliders.sliders',compact('sliders'));
    }


      // Create View
      public function create() {
        return view ('admin.sliders.slider_add');
    }

      // Add New Slider
      public function store(Request $request) {
      
        $data = [
           
            'title' => $request->title,
            'description' => $request->description,
            'URL' => $request->URL
         
        ];
        if($request->file('img')){
            $file=$request->file('img');
            $path = 'images/sliders/';
            $name=$file->getClientOriginalName();
            $name = $path.$name;
            $file->move($path,$name);
            $data['img'] = $name;
        }
        $slider = Slider::create($data);
        return redirect('admin/sliders')->with('message', 'New Slider has been added successfully');
    }

    // Edit View
    public function edit($id) {
    $slider = Slider::where('id',$id)->first();
    return view ('admin.sliders.slider_edit',compact('slider'));
        }


    // Update Category
    public function update(Request $request, $id) {
        $slider = Slider::where('id',$id)->first();
       
        $data = [
           
            'title' => $request->title,
            'description' => $request->description,
            'URL' => $request->URL
         
        ];
        if($request->file('img')){
            $file=$request->file('img');
            $path = 'images/sliders/';
            $name=$file->getClientOriginalName();
            $name = $path.$name;
            $file->move($path,$name);
            $data['img'] = $name;
        }

        $slider->update($data);
        return redirect()->back()->with('message', 'Slider has been updated successfully');
    }


    // Delete Category
    public function destroy($id) {
        $slider = Slider::where('id',$id)->delete();
        return redirect()->back()->with('message', 'Slider has been removed successfully');
    }
}
