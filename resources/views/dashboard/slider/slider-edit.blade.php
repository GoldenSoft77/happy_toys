


@include('dashboard.layouts.header')

<div class="page-wrapper">
	<div class="container">
		<div class="row">

			<div class="col-12">
				<h2 class="main-title">
					تعديل بيانات السلايد:
				</h2>
			</div>
			<form class="form-group col-12" method="POST" enctype="multipart/form-data"  id="upload_image_form" action="javascript:void(0)">

			<!-- <form class="form-group col-12" method="POST" enctype="multipart/form-data" action="{{ url('admin/slider/update/'.$slide->id) }}"> -->
				@csrf
				<div class="group">
					<label>عنوان السلايد: <span class="require">*</span></label>
					<input type="text" name="slider_title" value="{{ $slide->translate('ar')->title}}" required>
					@if ($errors->has('slider_title'))
						<span class="text-danger">{{ $errors->first('slider_title') }}</span>
					@endif
				</div>
				<div class="group">
					<label>وصف السلايد: <span class="require">*</span></label>
					<input type="text" name="slider_desc" value="{{ $slide->translate('ar')->description}}" required>
					@if ($errors->has('slider_desc'))
						<span class="text-danger">{{ $errors->first('slider_desc') }}</span>
					@endif
				</div>
				<div class="group">
					<label>رابط السلايد:</label>
					<input type="text" name="slider_link" value="{{ $slide->link}}">
					@if ($errors->has('slider_link'))
						<span class="text-danger">{{ $errors->first('slider_link') }}</span>
					@endif
				</div>
				<div class="group">
					<label>صورة السلايد:</label>
					<input type="file" name="img" accept="image/*" id="image">
					@if ($errors->has('img'))
						<span class="text-danger">{{ $errors->first('img') }}</span>
					@endif
					<!-- <img src="{{ asset($slide->img) }}" class="small-img"> -->
				</div>
				<div class="col-md-12 mb-2">
                    <div>
                        <label for="exampleInputFile">عرض الصورة</label>
                        <div class="input-group">
                            <img src="{{ asset($slide->img) }}" class="img-fluid small-img"
                                id="image_preview_container">
                        </div>
                    </div>
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
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script type="text/javascript">
     
    $(document).ready(function (e) {
  
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        $('#image').change(function(){
          
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#image_preview_container').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
 
        });
 
        $('#upload_image_form').submit(function(e) {
            e.preventDefault();
 
            var formData = new FormData(this);
 
            $.ajax({
                type:'POST',
                url: "{{ route('admin.slider.update',$slide->id)}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    alert('تم تعديل بيانات السلايد بنجاح');
                    $('#image_preview_container').attr('src','/images/image-preview.jpg'); 
                    window.location.href ="/admin/slider";
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    });
 
</script>				
@include('dashboard.layouts.footer')		