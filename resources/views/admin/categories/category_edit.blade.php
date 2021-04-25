@include('admin.layouts.header')
@include('admin.layouts.aside')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          تعديل صنف
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
                            action="{{ url('admin/categories/update/'.$category->id) }}">
                            @csrf

                           
                                <label>الصنف</label>
                                <input type="text" class="form-control" name="name" value="{{ $category->name }}"required>
                            
                                <div class="form-group">
                <label for="exampleInputFile">صورة الصنف</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input form-control"  name="img" accept="image/*">
                    <label class="custom-file-label">الرجاء رفع صورة</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">الصورة الحالية</span>
                  </div>
                </div>
                <div>
                  <img src="{{ asset($category->img) }}" class="img-fluid small-img" style="width:400px;height:400px;">
                </div>
                  @if ($errors->has('slide_img'))
                    <span class="text-danger">{{ $errors->first('slide_img') }}</span>
                  @endif
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