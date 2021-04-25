@include('admin.layouts.header')
@include('admin.layouts.aside')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
              تعديل منتج
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-group col-12" method="POST" enctype="multipart/form-data"
                            action="{{ url('admin/product/update/'.$product->id) }}">
                            @csrf


                            <label>اسم المنتج</label>
                            <input type="text" class="form-control" name="name" required value="{{$product->name}}">
                            <label>الوصف</label>
                            <textarea type="text" class="form-control" name="description" required>{{$product->description}}</textarea>

                            <div class="group">
		<label>تصنيف المنتج</label>
			<select name="category_id" class="form-control" required Multiple>
			@foreach($categories as $category)
			@if($category->id == $product->category_id)
                <option value="{{$category->id}}" selected>{{$category->name}} </option>
                  @else
                <option value="{{$category->id}}" >{{$category->name}} </option>
                 @endif
                @endforeach

			</select>
		</div>
							<label>سعر المنتج</label>
                                <input type="text" class="form-control" name="price" required value="{{$product->price}}">
								<label>سعر المنتج القديم </label>
                                <input type="text" class="form-control" name="old_price" required value="{{$product->old_price}}">
                            <label>صورة المنتج الرئيسية</label>
                            <input type="file" class="form-control" name="img" required>

                            <div class="group">
                                <label>الصور الثانوية للمنتج</label>
                                <small>يمكنك تحميل أكثر من صورة</small>
                                <input type="file" class="form-control" name="images[]" multiple>
                            </div>
                            <div class="box-footer with-border">
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>
                        </form>

                        <!-- Message -->
                        @if(session()->has('message'))
                        <p class="message-box done">
                            {{ session()->get('message') }}
                        </p>
                        @endif
                        <!-- ./Message -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('admin.layouts.footer')