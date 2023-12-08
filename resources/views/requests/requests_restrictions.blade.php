@extends('layouts.master')
@section('title')
	طلبات القيود
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/flatpickr.min.css')}}" rel="stylesheet">
<style>
	.flatpickr-calendar{
      direction: rtl;
	  font-family: Arial, Helvetica, sans-serif !important;
    }
</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  طلبات القيود</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
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
					<!-- message time attendees -->
					@if ($message = Session::get('time_attendees'))
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
					<!-- message time attendees -->
					@if ($message = Session::get('aja'))
						<div style="display: flex; justify-content: space-around;" class="w-100">
							<div class="alert alert-danger col-md-6 col-sm-8 text-center" role="alert">
								<button aria-label="Close" class="close" data-dismiss="alert" type="button">
								<span aria-hidden="true">&times;</span></button>
								<strong>
									{{$message}}
								</strong>
							</div>
						</div>
					@endif
					<!-- message time attendees no -->
					@if ($message = Session::get('time_attendees_no'))
						<div style="display: flex; justify-content: space-around;" class="w-100">
							<div class="alert alert-outline-danger col-md-9 col-sm-8 text-center" role="alert">
								<button aria-label="Close" class="close" data-dismiss="alert" type="button">
								<span aria-hidden="true">&times;</span></button>
									<strong>اكتمل عدد الطلبات المسموح بها لل<span style="color: black; margin: 0px 5px 0px 5px;">{{$message}}</span>     حدد يوماً اخراً     </strong>
							</div>
						</div>
					@endif
					@if ($message = Session::get('holiday'))
						<div style="display: flex; justify-content: space-around;" class="w-100">
							<div class="alert alert-outline-danger col-md-8 col-sm-7 text-center" role="alert">
								<button aria-label="Close" class="close" data-dismiss="alert" type="button">
								<span aria-hidden="true">&times;</span></button>
								<strong>{{$message}}</strong>
							</div>
						</div>
					@endif
					<div class="col-xl-12">
						<div class="card">
							@can('اضافة طلب بطاقة جديد')
								<div class="card-header pb-0">
									<div class="">
										<a class="modal-effect btn btn-outline-primary btn-block col-md-3 col-sm-12" href="{{ url('/' . $page='newRequestsRestrictions') }}"><i class="bx bx-plus"></i> إضافة طلب جديد</a>
									</div>
								</div>
							@endcan
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">رقم الطلب</th>
												<th class="wd-10p border-bottom-0">نوع الطلب</th>
												{{-- <th class="wd-25p border-bottom-0">اسم مقدم الطلب</th> --}}
												<th class="wd-15p border-bottom-0">تاريخ الطلب</th>
												<th class="wd-10p border-bottom-0">المحافظة</th>
												<th class="wd-15p border-bottom-0">المديرية</th>
												<th class="wd-15p border-bottom-0">المركز</th>
												<th class="wd-20p border-bottom-0"> تحديد موعد الحضور</th>
												<th class="wd-10p border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($BirthRestrictions as $BirthRestriction)
												<tr>
													<form action="/requests/restrictions/update" method="post">
														@method('PATCH')
														@csrf
														<td>{{$BirthRestriction->id}}</td>
														<td>قيد ميلاد</td>
														{{-- <td>{{$BirthRestriction->common_data->req_fore_na.' '.$BirthRestriction->common_data->req_second_na.' '.$BirthRestriction->common_data->req_third_na.' '.$BirthRestriction->common_data->req_tit}}</td> --}}
														<td>{{$BirthRestriction->created_at->format('Y-m-d')}}</td>
														<td>{{$BirthRestriction->province->na_prov}}</td>
														<td>{{$BirthRestriction->directorate->na_dire}}</td>
														<td>{{$BirthRestriction->center->na_center}}</td>
														<td>
															<input type="hidden" name="id" value="{{encrypt($BirthRestriction->id)}}">
															<input type="hidden" name="typecard" value="4">
															<input type="hidden" name="center_id" value="{{$BirthRestriction->center_id}}">
															<input type="date" class="form-control" name="time_attendees" id="time_attendees">
															<input type="hidden" class="form-control" name="time_attendees_hijri" id="time_attendees_hijri"></td>
														<td><button type="submit" class="btn btn-primary" >ارسال</button>
															{{-- @can('عرض الطلب')
																<a href="{{route('BirthRestriction.show',encrypt($BirthRestriction->id))}}" class="btn btn-warning">عــرض</a>
															@endcan --}}
														</td>
													</form>
												</tr>
											@endforeach

											@foreach ($LogMarriages as $LogMarriage)
												<tr>
													<form action="/requests/restrictions/update" method="post">
														@method('PATCH')
														@csrf
														<td>{{$LogMarriage->id}}</td>
														<td>قيد زواج</td>
														{{-- <td>{{$LogMarriage->common_data->req_fore_na.' '.$LogMarriage->common_data->req_second_na.' '.$LogMarriage->common_data->req_third_na.' '.$LogMarriage->common_data->req_tit}}</td> --}}
														<td>{{$LogMarriage->created_at->format('Y-m-d')}}</td>
														<td>{{$LogMarriage->province->na_prov}}</td>
														<td>{{$LogMarriage->directorate->na_dire}}</td>
														<td>{{$LogMarriage->center->na_center}}</td>
														<td>
															<input type="hidden" name="id" value="{{encrypt($LogMarriage->id)}}">
															<input type="hidden" name="typecard" value="5">
															<input type="hidden" name="center_id" value="{{$LogMarriage->center_id}}">
															<input type="date" class="form-control" name="time_attendees" id="time_attendees">
															<input type="hidden" class="form-control" name="time_attendees_hijri" id="time_attendees_hijri"></td>
														<td><button type="submit" class="btn btn-primary">ارسال</button>
															{{-- @can('عرض الطلب')
																<a href="{{route('FamilyCard.show',encrypt($LogMarriage->id))}}" class="btn btn-warning">عــرض</a>
															@endcan --}}
														</td>
													</form>
												</tr>
											@endforeach

											@foreach ($LogDivorces as $LogDivorce)
												<tr>
													<form action="/requests/restrictions/update" method="post">
														@method('PATCH')
														@csrf
														<td>{{$LogDivorce->id}}</td>
														<td>قيد طلاق</td>
														{{-- <td>{{$LogDivorce->common_data->req_fore_na.' '.$LogDivorce->common_data->req_second_na.' '.$LogDivorce->common_data->req_third_na.' '.$LogDivorce->common_data->req_tit}}</td> --}}
														<td>{{$LogDivorce->created_at->format('Y-m-d')}}</td>
														<td>{{$LogDivorce->province->na_prov}}</td>
														<td>{{$LogDivorce->directorate->na_dire}}</td>
														<td>{{$LogDivorce->center->na_center}}</td>
														<td>
															<input type="hidden" name="id" value="{{encrypt($LogDivorce->id)}}">
															<input type="hidden" name="typecard" value="6">
															<input type="hidden" name="center_id" value="{{$LogDivorce->center_id}}">
															<input type="date" class="form-control" name="time_attendees" id="time_attendees">
															<input type="hidden" class="form-control" name="time_attendees_hijri" id="time_attendees_hijri"></td>
														<td><button type="submit" class="btn btn-primary">ارسال</button>
															{{-- @can('عرض الطلب')
																<a href="{{route('CardDamagedRenewal.show',encrypt($LogDivorce->id))}}" class="btn btn-warning">عــرض</a>
															@endcan --}}
														</td>
													</form>
												</tr>
											@endforeach

											@foreach ($DeathStatements as $DeathStatement)
												<tr>
													<form action="/requests/restrictions/update" method="post">
														@method('PATCH')
														@csrf
														<td>{{$DeathStatement->id}}</td>
														<td>شهادة وفاة</td>
														{{-- <td>{{$DeathStatement->common_data->req_fore_na.' '.$DeathStatement->common_data->req_second_na.' '.$DeathStatement->common_data->req_third_na.' '.$DeathStatement->common_data->req_tit}}</td> --}}
														<td>{{$DeathStatement->created_at->format('Y-m-d')}}</td>
														<td>{{$DeathStatement->province->na_prov}}</td>
														<td>{{$DeathStatement->directorate->na_dire}}</td>
														<td>{{$DeathStatement->center->na_center}}</td>
														<td>
															<input type="hidden" name="id" value="{{encrypt($DeathStatement->id)}}">
															<input type="hidden" name="typecard" value="7">
															<input type="hidden" name="center_id" value="{{$DeathStatement->center_id}}">
															<input type="date" class="form-control" name="time_attendees" id="time_attendees">
															<input type="hidden" class="form-control" name="time_attendees_hijri" id="time_attendees_hijri"></td>
														<td><button type="submit" class="btn btn-primary">ارسال</button>
															{{-- @can('عرض الطلب')
																<a href="{{route('CardDamagedRenewal.show',encrypt($DeathStatement->id))}}" class="btn btn-warning">عــرض</a>
															@endcan --}}
														</td>
													</form>
												</tr>
											@endforeach

											@foreach ($CorrectionInstRevConstrs as $CorrectionInstRevConstr)
												<tr>
													<form action="/requests/restrictions/update" method="post">
														@method('PATCH')
														@csrf
														<td>{{$CorrectionInstRevConstr->id}}</td>
														<td>تصحيح او ابطال قيد</td>
														{{-- <td>{{$CorrectionInstRevConstr->common_data->req_fore_na.' '.$CorrectionInstRevConstr->common_data->req_second_na.' '.$CorrectionInstRevConstr->common_data->req_third_na.' '.$CorrectionInstRevConstr->common_data->req_tit}}</td> --}}
														<td>{{$CorrectionInstRevConstr->created_at->format('Y-m-d')}}</td>
														<td>{{$CorrectionInstRevConstr->province->na_prov}}</td>
														<td>{{$CorrectionInstRevConstr->directorate->na_dire}}</td>
														<td>{{$CorrectionInstRevConstr->center->na_center}}</td>
														<td>
															<input type="hidden" name="id" value="{{encrypt($CorrectionInstRevConstr->id)}}">
															<input type="hidden" name="typecard" value="8">
															<input type="hidden" name="center_id" value="{{$CorrectionInstRevConstr->center_id}}">
															<input type="date" class="form-control" name="time_attendees" id="time_attendees">
															<input type="hidden" class="form-control" name="time_attendees_hijri" id="time_attendees_hijri"></td>
														<td><button type="submit" class="btn btn-primary">ارسال</button>
															{{-- @can('عرض الطلب')
																<a href="{{route('CardDamagedRenewal.show',encrypt($CorrectionInstRevConstr->id))}}" class="btn btn-warning">عــرض</a>
															@endcan --}}
														</td>
													</form>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
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
<script src="{{asset('assets/js/flatpickr.js')}}"></script>
<script>

	var gregorianDateField = document.getElementById('time_attendees');
	var hijriDateField = document.getElementById('time_attendees_hijri');
	gregorianDateField.addEventListener('change', function() {
		var gregorianDate = moment(this.value);
		var hijriDate = gregorianDate.format('iYYYY/iM/iD');
		hijriDateField.value = hijriDate;
	});
	flatpickr.localize({firstDayOfWeek:6});
    flatpickr("#time_attendees", {
    // تعيين خيارات العرض والتنسيق
    dateFormat: "Y-m-d",
    disableMobile: true,
    
    // تعيين التواريخ التي يتم تعطيلها
    disable: [
        function(date) {
            return (date.getMonth() === 4 && date.getDate() === 1) || (date.getMonth() === 4 && date.getDate() === 22) || (date.getMonth() === 8 && date.getDate() === 26) || (date.getMonth() === 9 && date.getDate() === 14) || (date.getMonth() === 10 && date.getDate() === 30) || (date.getDay() === 5 || date.getDay() === 4);
        }
    ]
    });
</script>
@endsection