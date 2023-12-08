@extends('layouts.master')
@section('title')
	تعديل البيانات الاساسية
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
<style>
	.center1{
		display: flex;
		justify-content: center;
	}
	.nav-tabs .nav-link{
		border: 1px solid #0064e7 !important;
	}
	.nav-tabs .nav-link.active{
		border: 1px solid #ffffff !important;
	}
	.border{
		border: 1px solid #0064e7 !important;
	}.form-control{
		border: 1px solid #0064e7;
	}hr{
		background-color: #0064e7;
	}
</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل البيانات الاساسية</span>
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
		<div class="card custom-card w-100" id="tab">
			<div class="card-body">
				{{-- <div>
					<h6 class="card-title mb-1">Simple Tab Navigation</h6>
					<p class="text-muted card-sub-title">Below is a tab navigation that have only few links.</p>
				</div> --}}
				<div class="text-wrap">
					<div class="example">
						<div class="border" style="border: 1px solid #0064e7 !important;">
							<div class="modal" id="modaldemo3">
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
																<h5 style="margin-left: 5px">هل انت متاكد من رفض الطلب</h5>
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
							@foreach ($ReqChangeDataCommons as $ReqChangeDataCommon)
							<form action="{{route('commondata.update',encrypt($ReqChangeDataCommon->id))}}" method="post" autocomplete="off">
								@method('PATCH')
								@csrf
								<input type="hidden" name="encrypted_commondata_id" value="{{encrypt($ReqChangeDataCommon->user->commondata->id)}}" id="encrypted_commondata_id">
								<div class="card-body tab-content">
									<div class="tab-pane active show">
										<div class="center1">
											<div class="form-header">
												<h6 class="mb-4">طلب تعديل البيانات الاساسية</h6>
											</div>
										</div><hr>
											<table style="width: 100%; border: solid;" id="tabletd" dir="rtl">
												@foreach ($ReqChangeDataCommons as $ReqChangeDataCommon)
												<tr style="border: solid;" class="bg-primary text-center">
													<td style="width: 158px; border: rgb(0, 0, 0) solid 1px !important; color:white;">
														<label for="">نوع البيانات المطلوب تغييرها</label>
													</td>
													<td style="width: 158px; color:white;">
														<label for="">البيانات الجديدة</label>
													</td>
												</tr>
												@foreach ($ReqChangeDataCommon->reqChangeDataCommonDas as $data)
													{{-- @foreach ($ReqChangeDataCommonDa->new_data as $ReqChangeDataCommon) --}}
													<tr style="border: solid">
														<td class="td" style="border: rgb(0, 0, 0) solid 1px !important;">
															<p id="na_type_chan_show" class="text-center">{{$data->tydatareqchange->na_type_chan}}</p>
														</td>
														<td class="td">
															<p id="new_data_show" class="text-center">{{$data->new_data}}</p>
														</td>
													
												@endforeach
												<tr>
													<td colspan="2" >
															<div class="justify-content-center my-1" style="display: flex">
																<a class="btn ripple btn-danger col-md-4" data-encrypted_id="{{encrypt($ReqChangeDataCommon->id)}}"  data-effect="effect-scale" data-toggle="modal" href="#modaldemo3">رفض</a>
															</div>
													</td>
												</tr>
											@endforeach
										</table>
										<div  class="tab" id="tab-0">
											<div id="wizard" >
												<hr>
												<div class="form-header center1">
													<h6>بيانات مقدم الطلب</h6>
												</div>
											<section class="sec">
												<div class="tooltip-demo">
													<hr size="5" class="hr-m"/>
													<div class="form-row" dir="rtl">
															<label for="">
																أسم مقدم الطلب الكامل:
															</label>
															<div class="form-holder">
																
																<div class="row ">
																<div class="col-sm-3">
																	<input type="text" placeholder="الاسم الأول" class="form-control" value="{{$ReqChangeDataCommon->user->commondata->req_fore_na}}" id="req_fore_na" name="req_fore_na"/>
																</div>
																<div class="col-sm-3">
																	<input type="text" placeholder="أسم الاب" class="form-control" value="{{$ReqChangeDataCommon->user->commondata->req_second_na}}" name="req_second_na"  id="req_second_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="أسم الجد" class="form-control" value="{{$ReqChangeDataCommon->user->commondata->req_third_na}}" name="req_third_na" id="req_third_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="القب" class="form-control" value="{{$ReqChangeDataCommon->user->commondata->req_tit}}" name="req_tit" id="req_tit"/>
																</div>
																<div class="col-sm-2 " >
																	<select id="nationality_req_id" name="nationality_req_id" class="form-control">
																		<option value="{{$ReqChangeDataCommon->user->commondata->nationality_req_id}}" class="option">{{$ReqChangeDataCommon->user->commondata->nationality_req->nationality_na}}</option>
																		@foreach ($countrie_nationalits as $nationalit)
																		@if ($nationalit->id != $ReqChangeDataCommon->user->commondata->nationality_req_id)
																		<option value="{{$nationalit->id}}" class="option">{{$nationalit->nationality_na}}</option>
																		@endif
																		@endforeach
																	</select>
																</div>
															</div>	                        
														</div>
													</div>
							
													<hr size="5" class="hr-m"/>
													<div class="form-row" dir="rtl">
															<label for="">
																أسم الاب الكامل:
															</label>
															<div class="form-holder">
																<div class="row">
																<div class="col-sm-3">
																	<input type="text" placeholder="الاسم الأول" value="{{$ReqChangeDataCommon->user->commondata->father_fore_na}}" name="father_fore_na" id="father_fore_na" class="form-control"/>
																</div>
																<div class="col-sm-3">
																	<input type="text" placeholder="أسم الاب" class="form-control" value="{{$ReqChangeDataCommon->user->commondata->father_second_na}}" name="father_second_na" id="father_second_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="أسم الجد" class="form-control" value="{{$ReqChangeDataCommon->user->commondata->father_third_na}}" name="father_third_na"  id="father_third_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="القب" class="form-control" value="{{$ReqChangeDataCommon->user->commondata->father_tit}}" name="father_tit" id="father_tit"/>
																</div>
																<div class="col-sm-2 " >
																	<select id="nationality_father_id" name="nationality_father_id" class="form-control">
																		<option value="{{$ReqChangeDataCommon->user->commondata->nationality_father_id}}" class="option">{{$ReqChangeDataCommon->user->commondata->nationality_father->nationality_na}}</option>
																		@foreach ($countrie_nationalits as $nationalit)
																		@if ($nationalit->id != $ReqChangeDataCommon->user->commondata->nationality_father_id)
																		<option value="{{$nationalit->id}}" class="option">{{$nationalit->nationality_na}}</option>
																		@endif
																		@endforeach
																	</select>
																</div>
															</div>
														</div>
													</div>
							
													<hr size="5" class="hr-m"/>
													<div class="form-row" dir="rtl">
															<label for="">
																أسم الأم الكامل:
															</label>
															<div class="form-holder">
																<div class="row">
																<div class="col-sm-3">
																	<input type="text" placeholder="الاسم الأول" class="form-control" value="{{$ReqChangeDataCommon->user->commondata->mother_fore_na}}" name="mother_fore_na" id="mother_fore_na"/>
																</div>
																<div class="col-sm-3">
																	<input type="text" placeholder="أسم الاب" class="form-control" value="{{$ReqChangeDataCommon->user->commondata->mother_second_na}}" name="mother_second_na" id="mother_second_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="أسم الجد" class="form-control" value="{{$ReqChangeDataCommon->user->commondata->mother_third_na}}" name="mother_third_na" id="mother_third_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="القب" class="form-control" value="{{$ReqChangeDataCommon->user->commondata->mother_tit}}" name="mother_tit" id="mother_tit"/>
																</div>
																<div class="col-sm-2 " >
																	<select id="nationality_mother_id" name="nationality_mother_id" class="form-control" >
																		<option value="{{$ReqChangeDataCommon->user->commondata->nationality_mother_id}}" class="option">{{$ReqChangeDataCommon->user->commondata->nationality_mother->nationality_na}}</option>
																		@foreach ($countrie_nationalits as $nationalit)
																		@if ($nationalit->id != $ReqChangeDataCommon->user->commondata->nationality_mother_id)
																		<option value="{{$nationalit->id}}" class="option">{{$nationalit->nationality_na}}</option>
																		@endif
																		@endforeach
																	</select>
																</div>
															</div>
														</div>
													</div>
							
													<hr size="5" class="hr-m"/>
													<div class="col-sm-2 form-row">
														<label for="">النوع</label>
														<select id="gender" name="gender" class="form-control" >
															@if ($ReqChangeDataCommon->user->commondata->gender == 1)
															<option value="1" class="option" selected>ذكر</option>
															<option value="0" class="option">انثى</option>
															@else
															<option value="1" class="option">ذكر</option>
															<option value="0" class="option" selected>انثى</option>
															@endif
														</select>
													</div>
													<hr size="5" class="hr-m"/>
							
												</div>
											</section> 
											<div class="index-btn-wrapper justify-content-center" style="display: flex" dir="rtl">
												<div class="btn btn-primary col-md-3" onclick="run(0, 1);">التالي</div>
											</div>
											</div>
										</div>

										
										<!-- tab 1 -->
										<div  class="tab" id="tab-1">
											<div id="wizard"><hr>
												<div class="form-header center1">
													<h6>بيانات مقدم الطلب</h6>
												</div>
												<hr>
											<section class="sec">
											<div class="tooltip-demo">
												<div class="form-row" style="flex-wrap: nowrap; align-items: center;" dir="rtl">
												<label for="">
													تاريخ الميلاد الميلاد:
												</label>
												<div class="col-sm-4">
													<input type="date" value="{{$ReqChangeDataCommon->user->commondata->date_pirth_ad}}" name="date_pirth_ad" id="date_pirth_ad" class="form-control" required/>
												</div>
												<label for="" style="margin-right: 20px;">
													تاريخ الميلاد الهجري:
												</label>
												<div class="col-sm-4">
													<input type="text" value="{{$ReqChangeDataCommon->user->commondata->date_pirth_he}}" name="date_pirth_he" id="date_pirth_he" class="form-control text-ignore-validation" />
												</div>
												</div>
							
												<hr size="5" class="hr-m"/>
												<div class="form-row"  dir="rtl">
													<label for="" style="margin-left: 29px;">
														محل الميلاد:
													</label>
													{{-- <div class="row" style="flex-wrap: nowrap;"> --}}
														<div class="col-sm-2 " >
															<select name="countrie_birth_id" id="countrie_birth_id" class="form-control"  >
																<option value="{{$ReqChangeDataCommon->user->commondata->countrie_birth_id}}" class="option">{{$ReqChangeDataCommon->user->commondata->countrie_birth->countrie_na}}</option>
																@foreach ($countrie_nationalits as $countrie)
																@if ($countrie->id != $ReqChangeDataCommon->user->commondata->countrie_birth_id)
																<option value="{{$countrie->id}}" class="option">{{$countrie->countrie_na}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-sm-3 " >
															<select id="province_birth_id" name="province_birth_id" class="form-control" >
																<option value="{{$ReqChangeDataCommon->user->commondata->province_birth_id}}" class="option">{{$ReqChangeDataCommon->user->commondata->province_birth->na_prov}}</option>
																@foreach ($provinces as $province)
																@if ($province->id != $ReqChangeDataCommon->user->commondata->province_birth_id)
																<option value="{{$province->id}}" class="option">{{$province->na_prov}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-sm-2 " >
															<select name="directorate_pirth_id" id="directorate_pirth_id" class="form-control" >
																<option value="{{$ReqChangeDataCommon->user->commondata->directorate_pirth_id}}" class="option">{{$ReqChangeDataCommon->user->commondata->directorate_pirth->na_dire}}</option>
																{{-- @foreach ($directorates as $directorate)
																@if ($directorate->id != $ReqChangeDataCommon->user->commondata->directorate_pirth_id)
																<option value="{{$directorate->id}}" class="option">{{$directorate->na_dire}}</option>
																@endif
																@endforeach --}}
															</select>
														</div>
														<div class="col-sm-3">
															<input type="text" value="{{$ReqChangeDataCommon->user->commondata->village_parth}}" name="village_parth" id="village_parth" placeholder="عزلة / قرية الميلاد" class="form-control"  />
														</div>
													{{-- </div> --}}
												</div>
							
												<hr size="5" class="hr-m"/>
												<div class="form-row" style="flex-wrap: nowrap; align-items: center;" dir="rtl">
												<label for="" style="margin-left: 35px;">
													الــديــانــة:
												</label>
												<div class="col-sm-4">
													<select id="religions_id" name="religions_id" class="form-control" >
														<option value="{{$ReqChangeDataCommon->user->commondata->religions_id}}" class="option">{{$ReqChangeDataCommon->user->commondata->religions->na_relig}}</option>
															@foreach ($religions as $religion)
															@if ($religion->id != $ReqChangeDataCommon->user->commondata->religions_id)
															<option value="{{$religion->id}}" class="option">{{$religion->na_relig}}</option>
															@endif
															@endforeach
													</select>
												</div>
												</div>
											</div>
												<hr size="5" class="hr-m"/>
											</section> 
											<div class="index-btn-wrapper justify-content-center" style="display: flex" dir="rtl">
												<div class="btn btn-primary col-md-2"  data-effect="effect-scale" data-toggle="modal" href="#modaldemo2">إرسال</div>
												<div class="btn btn-outline-warning col-md-2" style="margin-right: 12px"  onclick="run(1, 0);">السابق</div>
											</div>
											</div>
										</div>
										<div class="modal" id="modaldemo2">
											<div class="modal-dialog" role="document">
												<div class="modal-content modal-content-demo">
													<div class="modal-header">
														<h6 class="modal-title">تاكيد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
													</div>
													<div class="modal-body">
														<h5>تاكيد تعديل البيانات الاساسية</h5>
													</div>
													<div class="modal-footer">
														<button class="btn ripple btn-primary" type="submit">حفظ التغييرات</button>
														<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							@endforeach
						</div>
					</div>
					<!-- Prism Precode -->
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
<script src="{{URL::asset('assets/js/moment.min.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap-hijri-datetimepickermin.js')}}"></script>
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/main.js')}}"></script>
<script src="{{URL::asset('assets/js/scr.js')}}"></script>
<script>

	
	$('#modaldemo3').on('show.bs.modal',function (event){
			var button = $(event.relatedTarget)
			var encrypted_id = button.data('encrypted_id')
			var modal = $(this)
			modal.find('.modal-body #encrypted_id').val(encrypted_id);
	});

	$(function () {
			initDefault();
		});
		function initDefault() {
			$("#date_pirth_he").hijriDatePicker({
				hijri:true,
				showSwitcher:false
			});
		}
		var date_pirth_ad = document.getElementById('date_pirth_ad');
		var hijriDateField = document.getElementById('date_pirth_he');
		date_pirth_ad.addEventListener('change', function() {
			var gregorianDate = moment(this.value);
			var hijriDate = gregorianDate.format('iYYYY/iM/iD');
			hijriDateField.value = hijriDate;
	});

	// مكان الميلاد
	$(document).ready(function() {
            // استدعاء الدول من الخادم عند تحميل الصفحة
            $.ajax({
                url: "{{ route('Location.index') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // إضافة اختيارات الدول إلى حقل الدولة
                    $.each(data, function(key, value) {
                        $('#countrie_birth_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    
                }
            });

            // استدعاء المحافظات المرتبطة بدولة الميلاد المختارة
            $('#countrie_birth_id').change(function() {
                var countrie_birth_id = $(this).val();
                if (countrie_birth_id) {
                    $.ajax({
                        url: "{{ route('getProvincesByCountryBirth') }}",
                        type: "POST",
                        data: {
                            countrie_birth_id: countrie_birth_id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            // إضافة اختيارات المحافظات إلى حقل محافظة الميلاد
                            $('#province_birth_id').empty().append('<option value="">محافظة الميلاد</option>');
                            $.each(data, function(key, value) {
                                $('#province_birth_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                            // إفراغ حقول المديرية 
                            $('#directorate_pirth_id').empty().append('<option value="">مديرية الميلاد</option>');
                        }
                    });
                } else {
                    // إفراغ جميع حقول الاختيارات
                    $('#province_birth_id').empty().append('<option value="">محافظة الميلاد</option>');
                    $('#directorate_pirth_id').empty().append('<option value="">مديرية الميلاد</option>');
                }
            });

            // استدعاء المديريات المرتبطة بمحافظة الميلاد المختارة
            $('#province_birth_id').change(function() {
                var province_birth_id = $(this).val();
                if (province_birth_id) {
                    $.ajax({
                        url: "{{ route('getDirectoratesByProvinceBirth') }}",
                        type: "POST",
                        data: {
                            province_birth_id: province_birth_id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            // إضافة اختيارات المديريات إلى حقل مديرية الميلاد
                            $('#directorate_pirth_id').empty().append('<option value="">مديرية الميلاد</option>');
                            $.each(data, function(key, value) {
                                $('#directorate_pirth_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    // إفراغ حقول المديرية 
                    $('#directorate_pirth_id').empty().append('<option value="">مديرية الميلاد</option>');
                }
            });

    });
    // نهائية مكان الميلاد


</script>
@endsection