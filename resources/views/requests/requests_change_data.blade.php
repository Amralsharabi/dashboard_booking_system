@extends('layouts.master')
@section('title')
	طلبات تغيير البيانات الاساسية
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
	


	<style>
		@media (min-width: 992px){
			.modal-lg, .modal-xl {
				max-width: 1000px !important;
		}
		}
		.input-border input{
			border: solid;
		}
		.input-border select{
			border: solid;
		}
		.input-border hr{
			border: solid 1px;
		}
	</style>
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طلبات تغيير البيانات الاساسية</span>
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<!-- message rejected -->
					@if ($message = Session::get('rejected'))
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
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-2p border-bottom-0">رقم الطلب</th>
												<th class="wd-25p border-bottom-0">اسم مقدم الطلب</th>
												<th class="wd-12p border-bottom-0">عدد الطلبات السابقة</th>
												<th class="wd-10p border-bottom-0">تاريخ الطلب</th>
												<th class="wd-20p border-bottom-0 text-center">العمليات</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($ReqChangeDataCommons as $ReqChangeDataCommon)
												<tr>
													<td>{{$ReqChangeDataCommon->id}}</td>
													<td>{{$ReqChangeDataCommon->user->commondata->req_fore_na.' '.$ReqChangeDataCommon->user->commondata->req_second_na.' '.$ReqChangeDataCommon->user->commondata->req_third_na.' '.$ReqChangeDataCommon->user->commondata->req_tit}}</td>
													<td>
														@foreach ($ReqChangeDataCommons1 as $ReqChangeDataCommon1)
															@if ($ReqChangeDataCommon->user_id == $ReqChangeDataCommon1->user_id)
																	{{$ReqChangeDataCommon1->count-- -1}}
															@endif
														@endforeach
													</td>
													<td>{{$ReqChangeDataCommon->created_at}}</td>
													<td><a class="btn btn-primary" href="{{route('commondata.edit',encrypt($ReqChangeDataCommon->id))}}">تعديل</a>
														<a class="btn btn-danger"  
															data-fullname="{!!$ReqChangeDataCommon->user->commondata->req_fore_na.' '.$ReqChangeDataCommon->user->commondata->req_second_na.' '.$ReqChangeDataCommon->user->commondata->req_third_na.' '.$ReqChangeDataCommon->user->commondata->req_tit!!}"
															data-encrypted_id="{{encrypt($ReqChangeDataCommon->id)}}"   
															data-id_show="{{$ReqChangeDataCommon->id}}"
															data-effect="effect-scale"
															data-toggle="modal" href="#modaldemo2">رفض</a></td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- Basic modal 2-->
					<div class="modal" id="modaldemo2">
						<form action="{{ url('/' . $page='req/change/data/common/update') }}" method="post">
							@csrf
							@method('PATCH')
							<div class="modal-dialog" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">رفض الطلب</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<input type="hidden" name="encrypted_id" id="encrypted_id">
										<div class="container">
											<table>
												<tr>
													<td>
														<h5 style="margin-left: 5px">هل انت متاكد من رفض الطلب رقم : </h5>
													</td>
													<td>
														<h5 id="id_show"></h5>
													</td>
												</tr>
											</table><hr>
											<table>
												<tr>
													<td>
														<h6 style="margin-left: 5px">اسم مقدم الطلب: </h6>
													</td>
													<td>
														<h6 id="fullname"></h6>
													</td>
												</tr>
											</table>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn ripple btn-danger" type="submit" >رفض</button>
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
			var id_show = button.data('id_show')
			var encrypted_id = button.data('encrypted_id')
			var fullname = button.data('fullname')
			var modal = $(this)
			modal.find('.modal-body #id_show').html(id_show);
			modal.find('.modal-body #encrypted_id').val(encrypted_id);
			modal.find('.modal-body #fullname').html(fullname);
		});
		// $(function () {
		// 	initDefault();
		// });
		// function initDefault() {
		// 	$("#date_pirth_he").hijriDatePicker({
		// 		hijri:true,
		// 		showSwitcher:false
		// 	});
		// }
		// var date_pirth_ad = document.getElementById('date_pirth_ad');
		// var hijriDateField = document.getElementById('date_pirth_he');
		// date_pirth_ad.addEventListener('change', function() {
		// 	var gregorianDate = moment(this.value);
		// 	var hijriDate = gregorianDate.format('iYYYY/iM/iD');
		// 	hijriDateField.value = hijriDate;
		// });
	</script>
@endsection