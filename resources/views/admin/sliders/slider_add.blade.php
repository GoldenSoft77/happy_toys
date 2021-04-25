@include('admin.layouts.header')
@include('admin.layouts.aside')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            إضافة سلايدر جديد
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
                            action="{{ url('admin/sliders/store') }}">
                            @csrf

                           
                                <label>العنوان</label>
                                <input type="text" class="form-control" name="title" required>

                                <label>الوصف</label>
                                <textarea type="text" class="form-control" name="description" required></textarea>
                            
                                <label>URL</label>
                                <input type="text" class="form-control" name="URL" required>

                                <label>صورة </label>
                                <input type="file" class="form-control" name="img" required>
                           

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