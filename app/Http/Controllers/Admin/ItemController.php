<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Item;
use App\ItemImage;
use App\Category;
use App\CategoryItem;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
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

    //  ***** Admin Functions ***** //

    // Show all items
    public function admin() {
        $items = Item::orderBy('id','DESC')->paginate(15);
        return view('dashboard.item.item',compact('items'));
    }
    
    // Go to add new item page
    public function create() {
        $categories = Category::all();
        return view('dashboard.item.item-add',compact('categories'));
    }
    
    // Add new item
    public function store(Request $request) {

        $last_item = Item::latest('id')->first();
        if ($last_item == NULL) {
            $i = 1;
        } else {
            $i = ++$last_item->id;
        }
        $request->validate([
            'item_title' => 'required',
            'item_desc' => 'required',
            'item_count' => 'min:0',
            'item_price' => 'min:0',
            'item_price_new' => 'min:0',
            'item_price_real' => 'min:0',
            'img' => 'required',
            'category' => 'required',
            'img.*' => 'image|max:2000'
        ],
        [
            'category_title.required' => 'هذا الحقل مطلوب',
            'img.required' => 'هذا الحقل مطلوب',
            'img.*.max' => 'أقصى حجم لكل صورة 2M',
            'img.*.uploaded' => 'أقصى حجم لكل صورة 2M',
            'category' => 'هذا الحقل مطلوب'
        ]);
        
        $item_title = $request->item_title;
        $item_desc = $request->item_desc;
        $item_count = $request->item_count;
        $item_price = $request->item_price;
        $item_price_new = $request->item_price_new;
        $item_price_real = $request->item_price_real;
        $vendor_name = $request->vendor_name;

        $data = [
            'price' => $request->item_price,
            'new_price' => $request->item_price_new,
            'real_price' => $request->item_price_real,
            'count' => $request->item_count,
            'vendor_name' => $request->vendor_name,

            'ar' => [
                'name' => $item_title,
                'description' => $item_desc,
            ]
        ];

        $item = Item::create($data);

        $item_categories = $request->category;
        
        if(!$item_categories == NULL) {
            foreach($item_categories as $cat) {
                CategoryItem::insert( [
                    'category_id'=>  $cat,
                    'item_id'=> $item->id
                ]);
            }
        } 
        
        CategoryItem::insert( [
            'category_id'=>  4,
            'item_id'=> $item->id
        ]);      

        if($request->file('img')){
            $path = 'images/items/'.$i.'/';
            $files=$request->file('img');
            foreach($files as $file) {
                $name=$file->getClientOriginalName();
                $name = $path.$name;
                $file->move($path,$name);
                ItemImage::insert( [
                    'img'=>  $name,
                    'item_id'=> $item->id
                ]);
            }
        }

        return redirect('/admin/items')->with('message','تم إضافة منتج جديد بنجاح');

    }
    
    // Show all items related to spicifice category
    public function show($id) {
        $category = Category::find($id);
        $items = $category->items;
        //for categorized items 
        if ($id != 4) {
            return view('dashboard.item.item-cat',compact('items'));
        } else {
            $items_cat = CategoryItem::all();
            $items_array = $items;
            $i = 0;
            foreach ($items_array as $item) {
                $number_of_show = 0;
                foreach($items_cat as $item_cat) {
                    if ($item->id == $item_cat->item_id ) {
                        $number_of_show++;
                    }
                    if ($number_of_show > 1) {
                        unset($items[$i]);
                        break;
                    }
                }
                $i++;
            }
            return view('dashboard.item.item-cat',compact('items'));
        }
    }

    // Go to edit item page
    public function edit($id) {
        $item = Item::where('id',$id)->first();
        $categories = Category::all();
        $item_id = $item->id;
        $item_categories = CategoryItem::where('item_id',$item_id)->get();
        return view('dashboard.item.item-edit',compact('item','item_categories','categories'));
    }
    
    //Update item info
    public function update(Request $request, $id) {
        
        $item = Item::where('id',$id)->first();
        $item_id = $item->id;
        $item_categories = CategoryItem::where('item_id',$item_id)->delete();
        $last_item = Item::latest('id')->first();
        if ($last_item == NULL) {
            $i = 1;
        } else {
            $i = ++$last_item->id;
        }
        $request->validate([
            'item_title' => 'required',
            'item_desc' => 'required',
            'item_count' => 'min:0',
            'item_price' => 'min:0',
            'item_price_new' => 'min:0',
            'item_price_real' => 'min:0',
            'img.*' => 'image|max:2000',
            'category' => 'required',
        ],
        [
            'category_title.required' => 'هذا الحقل مطلوب',
            'img.*.max' => 'أقصى حجم لكل صورة 2M',
            'img.*.uploaded' => 'أقصى حجم لكل صورة 2M',
            'category.required' => 'هذا الحقل مطلوب',
        ]);
        
        $item_title = $request->item_title;
        $item_desc = $request->item_desc;
        $item_count = $request->item_count;
        $item_price = $request->item_price;
        $item_price_new = $request->item_price_new;
        $item_price_real = $request->item_price_real;
        $vendor_name = $request->vendor_name;

        $data = [
            'price' => $item_price,
            'new_price' => $item_price_new,
            'real_price' => $item_price_real,
            'count' => $item_count,
            'vendor_name' => $vendor_name,

            'ar' => [
                'name' => $item_title,
                'description' => $item_desc,
            ]
        ];

        $item->update($data);

        $item_categories = $request->category;
        if($item_categories != NULL) {
            foreach($item_categories as $cat) {
                CategoryItem::insert( [
                    'category_id'=>  $cat,
                    'item_id'=> $item->id
                ]);
            }
        } 

        if($request->file('img')){
            $path = 'images/items/'.$i.'/';
            $files=$request->file('img');
            foreach($files as $file) {
                $name=$file->getClientOriginalName();
                $name = $path.$name;
                $file->move($path,$name);
                ItemImage::insert( [
                    'img'=>  $name,
                    'item_id'=> $item->id
                ]);
            }
        }

        return redirect()->back()->with('message','تم تعديل بيانات المنتج بنجاح');
    }

    // Delete Sub image form item
    public function imagedelete($id) {
        $img = ItemImage::where('id',$id)->first();
        $item_id = $img->item_id;
        $images = ItemImage::where('item_id',$item_id)->get();
        if (count($images) > 1) {
            if(\File::exists(public_path($img->img))){
                \File::delete(public_path($img->img));
            }
            $img->delete();
            return redirect()->back()->with('message','تم حذف الصورة بنجاح');
        } else {
            return redirect()->back()->with('message','لايمكنك حذف الصورة، يجب أن يكون للمنتج صورة واحدة على الأقل');
        }
    }

    // Delete item with all images form directory
    public function destroy($id) {
        $item = Item::where('id',$id)->first();
        foreach($item->images as $img) {
            if(\File::exists(public_path($img->img))){
                \File::delete(public_path($img->img));
            }
        }
        $path = 'images/items/'.$item->id.'/';
        \File::deleteDirectory($path);   
        $item->delete();
        return redirect('/admin/items')->with('message','تم حذف المنتج بنجاح');
    }
}
