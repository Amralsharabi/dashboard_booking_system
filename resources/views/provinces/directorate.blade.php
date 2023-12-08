@extends('layouts.master')
@section('title')
	المديريات
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الإعدادت</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة مديرية</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<!-- message add -->
					@if ($message = Session::get('add'))
						<div style="display: flex; justify-content: space-around;" class="w-100">
							<div class="alert alert-outline-success col-md-6 col-sm-8 text-center" role="alert">
								<button aria-label="Close" class="close" data-dismiss="alert" type="button">
								<span aria-hidden="true">&times;</span></button>
								<strong>
									{{$message}}
								</strong>
							</div>
						</div>
					@endif
					<!-- message errors -->
					@foreach ($errors->all() as $error)
						<div style="display: flex; justify-content: space-around;" class="w-100">
							<div class="alert alert-outline-danger col-md-6 col-sm-8 text-center" role="alert">
							<button aria-label="Close" class="close" data-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span></button>
							<strong>{{$error}}</strong><br>
							</div>
						</div>
                    @endforeach
					<!-- message updated -->
					@if ($message = Session::get('updated'))
						<div style="display: flex; justify-content: space-around;" class="w-100">
							<div class="alert alert-outline-success col-md-6 col-sm-8 text-center" role="alert">
								<button aria-label="Close" class="close" data-dismiss="alert" type="button">
								<span aria-hidden="true">&times;</span></button>
								<strong>
									{{$message}}
								</strong>
							</div>
						</div>
					@endif
					<!-- message deleted -->
					@if ($message = Session::get('deleted'))
						<div style="display: flex; justify-content: space-around;" class="w-100">
							<div class="alert alert-outline-danger col-md-6 col-sm-8 text-center" role="alert">
								<button aria-label="Close" class="close" data-dismiss="alert" type="button">
								<span aria-hidden="true">&times;</span></button>
								<strong>
									{{$message}}
								</strong>
							</div>
						</div>
					@endif
					<div class="col-xl-12">
						<div class="card">

							@can('اضافة مديرية')
								<div class="card-header pb-0">
									<div class="">
										<a class="modal-effect btn btn-outline-primary btn-block col-md-3 col-sm-12" data-effect="effect-scale" data-toggle="modal" href="#modaldemo1"><i class="bx bx-plus"></i> إضافة مديرية</a>
									</div>
								</div>
							@endcan
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">رقم المديرية</th>
												<th class="wd-20p border-bottom-0">اسم المديرية</th>
												<th class="wd-20p border-bottom-0">اسم الحافضة</th>
												<th class="wd-20p border-bottom-0 text-center">العمليات</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($directorates as $directorate)
												<tr>
													<td>{{$directorate->id}}</td>
													<td>{{$directorate->na_dire}}</td>
													<td>{{$directorate->province->na_prov}}</td>
													<td style="text-align: center">
														@can('تعديل مديرية')
															<a class="btn btn-primary" data-effect="effect-scale" 
															data-id="{{$directorate->id}}" 
															data-na_dire ="{{$directorate->na_dire}}" 
															data-na_prov ="{{$directorate->province_id}}"
															data-toggle="modal" href="#modaldemo2">تعديل</a>
														@endcan
														@can('اضافة مديرية')
															<a class="btn btn-danger"  data-id="{{$directorate->id}}" data-na_dire ="{{$directorate->na_dire}}" data-toggle="modal" href="#modaldemo3">حذف</a>
														@endcan
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- Basic modal 1 create -->
					<div class="modal" id="modaldemo1">
						<form action="{{route('directorate.store')}}" method="post">
							@csrf
							<div class="modal-dialog" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">اضافة مديرية</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<div class="container">
											<div class="form-group">
												<label for="">المحافظة</label>
												<select class="custom-select" name="province_id" id="province_id">
													<option value="">-- يرجى اختيار محافظة --</option>
													@foreach ($provinces as $province)
													<option value="{{$province->id}}">{{$province->na_prov}}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
											<label for="">المديرية</label>
											<input type="text" name="na_dire" id="na_dire" class="form-control" placeholder="" aria-describedby="helpId" required>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn ripple btn-success" type="submit">حفظ</button>
										<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<!-- Basic modal 2 update -->
					<div class="modal" id="modaldemo2">
						<form action="directorate/update" method="post" autocomplete="off">
							@method('PATCH')
							@csrf
							<div class="modal-dialog" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">تعديل المديرية</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<div class="container">
											<div class="form-group">
												<label for="">المحافظة</label>
												<select class="custom-select" name="province_id" id="na_prov" required>
													@foreach ($provinces as $province)
													<option value="{{$province->id}}">{{$province->na_prov}}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
											<input type="hidden" name="id" id="id">
											<label for="">اسم المديرية</label>
											<input type="text" name="na_dire" id="na_dire" class="form-control" placeholder="" aria-describedby="helpId" required>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn ripple btn-primary" type="submit">تعديل</button>
										<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<!-- Basic modal 3 delete -->
					<div class="modal" id="modaldemo3">
						<form action="directorate/destroy" method="post" autocomplete="off">
							@method('DELETE')
							@csrf
							<div class="modal-dialog" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">حذف المديرية</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<div class="container">
											<div class="form-group">
											<input type="hidden" name="id" id="id">
											<label for="">اسم المديرية</label>
											<input type="text" name="na_dire" id="na_dire" class="form-control" placeholder="" aria-describedby="helpId" required>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn ripple btn-danger" type="submit">حذف</button>
										<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
									</div>
								</div>
							</div>
						</form>
					</div>

				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
	$('#modaldemo2').on('show.bs.modal',function (event){
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var na_dire = button.data('na_dire')
		var na_prov = button.data('na_prov')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #na_dire').val(na_dire);
		modal.find('.modal-body #na_prov').val(na_prov);

	})
	$('#modaldemo3').on('show.bs.modal',function (event){
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var na_dire = button.data('na_dire')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #na_dire').val(na_dire);

	})
</script>
@endsection