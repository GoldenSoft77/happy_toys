@include('dashboard.layouts.header')

<div class="page-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-12">
                <h2 class="main-title">
                    إضافة تصنيف جديد:
                </h2>
            </div>
            <form class="form-group col-12" method="POST" enctype="multipart/form-data" id="upload_image_form"
                action="javascript:void(0)">
                @csrf
                <div class="group">
                    <label>اسم التصنيف: <span class="require">*</span></label>
                    <input type="text" name="category_title" required>
                    @if ($errors->has('category_title'))
                    <span class="text-danger">{{ $errors->first('category_title') }}</span>
                    @endif
                </div>
                <div class="group">
                    <label>صورة التصنيف: <span class="require">*</span></label>
                    <input type="file" name="img" accept="image/*" id="image" required>
                    @if ($errors->has('img'))
                    <span class="text-danger">{{ $errors->first('img') }}</span>
                    @endif
                </div>
                <div class="col-md-12 mb-2">
                    <div>
                        <label for="exampleInputFile">عرض الصورة</label>
                        <div class="input-group">
                            <img src="{{ asset('/images/image-preview.jpg') }}" class="img-fluid small-img"
                                id="image_preview_container">
                        </div>
                    </div>
                </div>

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
$(document).ready(function(e) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#image').change(function() {

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
            type: 'POST',
            url: "{{ route('admin.category.store')}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                this.reset();
                alert('تم إضافة تصنيف جديد بنجاح');
                $('#image_preview_container').attr('src', '/images/image-preview.jpg');
                window.location.href = "/admin/categories";
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
});
</script>
@include('dashboard.layouts.footer')