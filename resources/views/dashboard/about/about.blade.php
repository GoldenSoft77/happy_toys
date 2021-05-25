


@include('dashboard.layouts.header')

<div class="page-wrapper">
	<div class="container">
		<div class="row">
			
			<div class="col-12">
				<h2 class="main-title">
					تعديل بيانات صفحة من نحن:
				</h2>
			</div>


			<form class="form-group col-12" method="POST" enctype="multipart/form-data" action="{{ url('admin/about/update') }}">
				@csrf
				<div class="group">
					<label>صورة صفحة من نحن:</label>
					<input type="file" name="about_img" accept="image/*">
					@if ($errors->has('about_img'))
						<span class="text-danger">{{ $errors->first('about_img') }}</span>
					@endif
					<br>
					<div>
						<p>الصورة الحالية:</p>
						<img src="{{ asset($about->img) }}" class="img-fluid about-img">
					</div>
				</div>
				<div class="group">
					<label>الوصف: <span class="require">*</span></label>
					<textarea name="about_desc" required>{{ $about->translate('ar')->description }}</textarea>
					@if ($errors->has('about_desc'))
						<span class="text-danger">{{ $errors->first('about_desc') }}</span>
					@endif
				</div>
				
				<div class="group">
					<button type="submit">حفظ</button>
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
		
@include('dashboard.layouts.footer')		