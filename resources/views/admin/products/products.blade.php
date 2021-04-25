@include('admin.layouts.header')
@include('admin.layouts.aside')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            المنتجات

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">عرض المنتجات</h3>
                <a href="{{ url('admin/products/add') }}" style="float:left;">
                    <i class="fa fa-plus"></i>
                    إضافة منتج جديد
                </a>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="form-group" style="direction:rtl;">
                        @if(count($products) == 0)
                        <div class="alert alert-info col-12" role="alert">
                            لا يوجد أي منتجات لعرضها
                        </div>
                        @endif
                        @foreach ($products as $product)
                        <div class="col-sm-4 col-12">

                            <div class="guide-block">

                                <img src="{{ asset($product->img) }}" class="img-fluid" style="width:100%;">

                                <h3>{{ $product->name }}</h3>

							

                                <ul>
                                    <li>
                                        <a href="{{ url('admin/products/edit/'.$product->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <button data-toggle="modal" data-target="{{'#exampleModal'.$product->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </li>
                                    

                                </ul>
                            </div>

                        </div>
                        @endforeach

                    </div><!-- /.form-group -->

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.box-body -->

</div><!-- /.box -->

@foreach ($products as $product)
	<!-- Delete Modal -->
	<div class="modal fade" id="{{'exampleModal'.$product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">حذف منتج</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('admin/products/delete/'.$product->id)}}">
						@csrf
						@method('DELETE')
						<p>هل تريد تأكيد الحذف؟</p>
						<button type="submit">نعم</button>
						<button type="button" data-dismiss="modal" aria-label="Close">
							لا
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- ./Delete Modal -->
	@endforeach




@include('admin.layouts.footer')