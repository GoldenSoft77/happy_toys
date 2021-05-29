


@include('dashboard.layouts.header')

<div class="page-wrapper">
	<div class="container">
		<div class="row">

			<div class="col-12">
				<h2 class="main-title">
					إضافة منتج جديد:
				</h2>
			</div>
            <form class="form-group col-12" method="POST" enctype="multipart/form-data" id="upload_image_form"
                action="javascript:void(0)">
			<!-- <form class="form-group col-12" method="POST" enctype="multipart/form-data" action="{{ url('admin/item/store') }}"> -->
				@csrf
				<div class="group">
					<label>اسم المنتج: <span class="require">*</span></label>
					<input type="text" name="item_title" required>
					@if ($errors->has('item_title'))
						<span class="text-danger">{{ $errors->first('item_title') }}</span>
					@endif
				</div>
				<div class="group">
					<label>وصف المنتج: <span class="require">*</span></label>
					<textarea name="item_desc" required></textarea>
					@if ($errors->has('item_desc'))
						<span class="text-danger">{{ $errors->first('item_desc') }}</span>
					@endif
				</div>
				<div class="group">
					<label>تصنيف المنتج: <span class="require">*</span></label>
					<ul class="radio-choices">
						@foreach ($categories as $category)
						@if ($category->id != 4)
						<li class="radio-box">
							<input type="checkbox" value="{{ $category->id }}" name="category[]">
							<span>
								{{ $category->translate('ar')->name }}
							</span>
						</li>
						@endif
						@endforeach
						@if(count($categories) == 1)
						<li class="radio-box">
							<input type="checkbox" value="{{ $categories[0]->id }}" checked disabled name="category[]">
							<span>
								{{ $categories[0]->translate('ar')->name }}
							</span>
						</li>
						@endif
					</ul>
				</div>
				<div class="group">
					<label>عدد القطع: </label>
					<input type="number" name="item_count" min="0">
					@if ($errors->has('item_count'))
						<span class="text-danger">{{ $errors->first('item_count') }}</span>
					@endif
				</div>
				<div class="group">
					<label>سعر المنتج الحالي (بدون تخفيض): <span class="require">*</span></label>
					<input type="number" name="item_price" min="0" required>
					@if ($errors->has('item_price'))
						<span class="text-danger">{{ $errors->first('item_price') }}</span>
					@endif
				</div>
				<div class="group">
					<label>سعر المنتج الجديد (بعد التخفيض): </label>
					<input type="number" name="item_price_new" min="0">
					@if ($errors->has('item_price_new'))
						<span class="text-danger">{{ $errors->first('item_price_new') }}</span>
					@endif
				</div>
				<div class="group">
					<label>سعر المنتج الحقيقي (سعر التكلفة): </label>
					<input type="number" name="item_price_real" min="0">
					@if ($errors->has('item_price_real'))
						<span class="text-danger">{{ $errors->first('item_price_real') }}</span>
					@endif
				</div>
				<div class="group">
					<label>اسم التاجر:</label>
					<input type="text" name="vendor_name">
					@if ($errors->has('vendor_name'))
						<span class="text-danger">{{ $errors->first('vendor_name') }}</span>
					@endif
				</div>
				<div class="group">
					<label>صور المنتج: <span class="require">*</span></label>
					<input type="file" name="img[]" accept="image/*" multiple required id="image">
					<small>يمكن رفع صورة واحدة أو أكثر (يجب أن يكون حجم كل صورة أقل من 2 ميغابايت)</small>
					@if ($errors->has('img'))
						<span class="text-danger">{{ $errors->first('img') }}</span>
					@endif
					@if ($errors->has('img.*'))
						<span class="text-danger">{{ $errors->first('img.*') }}</span>
					@endif
				</div>
				<div id="image_preview"></div>
				
				<div class="group">
					<button type="submit">إضافة</button>
				</div>
			</form>

		</div>
	</div>
</div>

<!-- Message -->
@if(session()->has('message'))
<p class="message-box done">
	{{ session()->get('message') }}
</p>
@endif
<!-- ./Message -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script type="text/javascript">



$("#image").change(function(){

   $('#image_preview').html("");

   var total_file=document.getElementById("image").files.length;

   for(var i=0;i<total_file;i++)

   {

	$('#image_preview').append("<img style='width:200px;height:auto;display:inline-block;margin-right:5px;margin-top:5px;' src='"+URL.createObjectURL(event.target.files[i])+"'>");

   }

});

$('#upload_image_form').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: "{{ route('admin.item.store')}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                this.reset();
                alert('تم إضافة منتج جديد بنجاح');
                $('#image_preview_container').attr('src', '/images/image-preview.jpg');
                window.location.href = "/admin/items";
            },
            error: function(data) {
                console.log(data);
            }
        });
    });


</script>	
@include('dashboard.layouts.footer')		