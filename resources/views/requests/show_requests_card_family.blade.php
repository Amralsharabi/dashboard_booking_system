@extends('layouts.master')
@section('title')
	عرض طلب بطاقة عائلية
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
<link href="{{asset('assets/css/flatpickr.min.css')}}" rel="stylesheet">

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
	}.form-row{
		align-items: center;
	}.flatpickr-calendar{
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
							<h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة طلب بطاقة جديد</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
	<!-- row -->
	<div class="row">
		<!-- message success -->
		@if ($message = Session::get('success'))
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
		<!-- message success -->
		@if ($message = Session::get('warning'))
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
		@foreach ($errors->all() as $error)
			<div style="display: flex; justify-content: space-around;" class="w-100">
				<div class="alert alert-outline-danger col-md-6 col-sm-8 text-center" role="alert">
				<button aria-label="Close" class="close" data-dismiss="alert" type="button">
				<span aria-hidden="true">&times;</span></button>
				<strong>{{$error}}</strong><br>
				</div>
			</div>
		@endforeach
		<div class="card custom-card" id="tab">
			<div class="card-body">
				{{-- <div>
					<h6 class="card-title mb-1">Simple Tab Navigation</h6>
					<p class="text-muted card-sub-title">Below is a tab navigation that have only few links.</p>
				</div> --}}
				<div class="text-wrap">
					<div class="example">
						<div class="border" style="border: 1px solid #0064e7 !important;">
							<div class="card-body tab-content">
								<div class="tab-pane active show" id="tabCont1">
									<div class="center1">
										<div class="form-header">
											<h6 class="mb-4"> عرض طلب الحصول على بطاقة عائلية </h6>
										</div>
									</div>
									<form action="/requests/cards/update" method="post">
										@csrf
										@method('PATCH')
										<div class="modal" id="modaldemo2">
											<div class="modal-dialog" role="document">
												<div class="modal-content modal-content-demo">
													<div class="modal-header">
														<h6 class="modal-title">تاكيد إرسال الطلب</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
													</div>
													<div class="modal-body">
														<input type="hidden" value="{{encrypt($FamilyCard->id)}}" name="id" id="id">
														<input type="hidden" value="{{$common_data->user_id}}" name="user_id" id="user_id">
														<input type="hidden" name="typecard" value="2">
														<div class="form-group">
															<label for="">تحديد موعد الحضور</label>
															<input type="text" value="{{ old('time_attendees') }}" name="time_attendees" id="time_attendees" class="form-control text-ignore-validation" required>
															<input type="text" value="{{ old('time_attendees_hijri') }}" name="time_attendees_hijri" id="time_attendees_hijri" class="form-control" style="display: none" required>
														</div>
													</div>
													<div class="modal-footer">
														<button class="btn ripple btn-primary" type="submit">إرسال</button>
														<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
													</div>
												</div>
											</div>
										</div>

										<!-- tab 0 -->
										<div  class="tab" id="tab-0">
											<div id="wizard" >
												<div class="form-header center1">
													<h6>بيانات مقدم الطلب</h6>
												</div>
												<hr size="5" />
											<section class="sec">
												<div class="tooltip-demo">
													
													<div class="form-row" style="display: contents;" dir="rtl">
															<label for="">
																تقديم الطلب الى :
															</label>
															<div class="form-holder">
																
																<div class="row ">
																<div class="col-sm-3">
																	<select name="province_id" id="province_id" class="form-control" required data-bs-toggle='tooltip'  title='قم بإختيار عنصر من القائمة'>
																		<option value="{{$province_id}}" class="option">{{$province}}</option>
																	</select>
																</div>
																<div class="col-sm-3">
																	<select name="directorate_id" id="directorate_id" class="form-control" required data-bs-toggle='tooltip'  title='قم بإختيار عنصر من القائمة'>
																		<option value="{{$directorate_id}}" class="option">{{$directorate}}</option>
																	</select>
																</div>
																<div class="col-sm-3">
																	<select name="center_id" id="center_id" class="form-control" required data-bs-toggle='tooltip'  title='قم بإختيار عنصر من القائمة'>
																		<option value="{{$center_id}}" class="option">{{$center}}</option>
																	</select>
																</div>
																<div class="col-sm-3 " >
																	<select name="blood_type_id" id="" class="form-control" required data-bs-toggle='tooltip'  title='قم بإختيار عنصر من القائمة'>
																		<option value="{{$blood_type_id}}" class="option">{{$blood_type}}</option>
																		@foreach ($blood_types as $blood_type)
																			@if ($blood_type->id != $blood_type_id)
																				<option value="{{$blood_type->id}}" @if(old('blood_type_id') == $blood_type->id) selected @endif class="option">{{$blood_type->na_bloodty}}</option>
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
																أسم مقدم الطلب الكامل:
															</label>
															<div class="form-holder">
																
																<div class="row ">
																<div class="col-sm-3">
																	<input type="text" placeholder="الاسم الأول" value="{!!$common_data->req_fore_na!!}" class="form-control" id="req_fore_na" name="req_fore_na"/>
																</div>
																<div class="col-sm-3">
																	<input type="text" placeholder="أسم الاب" class="form-control" value="{{$common_data->req_second_na}}" name="req_second_na" id="req_second_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="أسم الجد" class="form-control" value="{{$common_data->req_third_na}}" name="req_third_na" id="req_third_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="القب" class="form-control" value="{{$common_data->req_tit}}" name="req_tit" id="req_tit"/>
																</div>
																<div class="col-sm-2 " >
																	<select id="nationality_req_id" name="nationality_req_id" class="form-control">
																		<option value="{{$common_data->nationality_req_id}}" class="option">{{$nationality_req}}</option>
																		@foreach ($countrie_nationalits as $nationalit)
																		@if ($nationalit->id != $common_data->nationality_req_id)
																			<option value="{{$nationalit->id}}" @if(old('nationality_req_id') == $nationalit->id) selected @endif class="option">{{$nationalit->nationality_na}}</option>
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
																	<input type="text" placeholder="الاسم الأول" value="{{$common_data->father_fore_na}}" name="father_fore_na" id="father_fore_na" class="form-control"/>
																</div>
																<div class="col-sm-3">
																	<input type="text" placeholder="أسم الاب" class="form-control" value="{{$common_data->father_second_na}}" name="father_second_na" id="father_second_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="أسم الجد" class="form-control" value="{{$common_data->father_third_na}}" name="father_third_na"  id="father_third_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="القب" class="form-control" value="{{$common_data->father_tit}}" name="father_tit" id="father_tit"/>
																</div>
																<div class="col-sm-2 " >
																	<select id="nationality_father_id" name="nationality_father_id" class="form-control">
																		<option value="{{$common_data->nationality_father_id}}" class="option">{{$nationality_father}}</option>
																		@foreach ($countrie_nationalits as $nationalit)
																			@if ($nationalit->id != $common_data->nationality_father_id)
																				<option value="{{$nationalit->id}}" @if(old('nationality_father_id') == $nationalit->id) selected @endif class="option">{{$nationalit->nationality_na}}</option>
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
																	<input type="text" placeholder="الاسم الأول" class="form-control" value="{{$common_data->mother_fore_na}}" name="mother_fore_na" id="mother_fore_na"/>
																</div>
																<div class="col-sm-3">
																	<input type="text" placeholder="أسم الاب" class="form-control" value="{{$common_data->mother_second_na}}" name="mother_second_na" id="mother_second_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="أسم الجد" class="form-control" value="{{$common_data->mother_third_na}}" name="mother_third_na" id="mother_third_na"/>
																</div>
																<div class="col-sm-2">
																	<input type="text" placeholder="القب" class="form-control" value="{{$common_data->mother_tit}}" name="mother_tit" id="mother_tit"/>
																</div>
																<div class="col-sm-2 " >
																	<select id="nationality_mother_id" name="nationality_mother_id" class="form-control" >
																		<option value="{{$common_data->nationality_mother_id}}" class="option">{{$nationality_mother}}</option>
																		@foreach ($countrie_nationalits as $nationalit)
																			@if ($nationalit->id != $common_data->nationality_mother_id)
																				<option value="{{$nationalit->id}}" @if(old('nationality_mother_id') == $nationalit->id) selected @endif class="option">{{$nationalit->nationality_na}}</option>
																			@endif
																		@endforeach
																	</select>
																</div>
															</div>
														</div>
													</div>
							
													<hr size="5" class="hr-m"/>
													<div class="col-sm-2">
														<select id="gender" name="gender" class="form-control" >
															@if ($common_data->gender == 1)
																<option value="1" @if(old('gender') == 1) selected @endif class="option" selected>ذكر</option>
																<option value="0" @if(old('gender') == 2) selected @endif class="option">انثى</option>
															@else
																<option value="1" @if(old('gender') == 1) selected @endif class="option" >ذكر</option>
																<option value="0" @if(old('gender') == 2) selected @endif class="option" selected>انثى</option>
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
											<div id="wizard">
												<div class="form-header center1">
													<h6>بيانات مقدم الطلب</h6>
												</div>
												<hr>
											<section class="sec">
											<div class="tooltip-demo">
												
							
												
												<div class="form-row" style="flex-wrap: nowrap; align-items: center;" dir="rtl">
													<label for="">
														محل الميلاد:
													</label>
													<div class="row" style="flex-wrap: nowrap;">
														<div class="col-sm-3 " >
															<select name="countrie_birth_id" id="countrie_birth_id" class="form-control"  >
																<option value="{{$common_data->countrie_birth_id}}" class="option"> {{$countrie_birth}}</option>
																{{-- @foreach ($countrie_nationalits as $countrie)
																	<option value="{{$countrie->id}}" @if(old('countrie_birth_id') == $countrie->id) selected @endif class="option">{{$countrie->countrie_na}}</option>
																@endforeach --}}
															</select>
														</div>
														<div class="col-sm-3 " >
															<select id="province_birth_id" name="province_birth_id" class="form-control" >
																<option value="{{$common_data->province_birth_id}}" class="option">{{$province_birth}}</option>
																@foreach ($provinces as $province)
																	<option value="{{$province->id}}" @if(old('province_birth_id') == $province->id) selected @endif class="option">{{$province->na_prov}}</option>
																@endforeach
															</select>
														</div>
														<div class="col-sm-3 " >
															<select name="directorate_pirth_id" id="directorate_pirth_id" class="form-control" >
																<option value="{{$common_data->directorate_pirth_id}}" class="option">{{$directorate_pirth}}</option>
															</select>
														</div>
														<div class="col-sm-4">
															<input type="text" value="{{$common_data->village_parth}}" name="village_parth" id="village_parth" placeholder="عزلة / قرية الميلاد" class="form-control"  />
														</div>
													</div>
												</div>
												<hr size="5" class="hr-m"/>
												<div class="form-row" style="flex-wrap: nowrap; align-items: center;" dir="rtl">
													<label for="">
														تاريخ الميلاد الميلاد:
													</label>
													<div class="col-sm-4">
														<input type="date" value="{{$common_data->date_pirth_ad}}" name="date_pirth_ad" id="date_pirth_ad" class="form-control" />
													</div>
													<label for="" style="margin-right: 20px;">
														تاريخ الميلاد الهجري:
													</label>
													<div class="col-sm-4">
														<input type="text" value="{{$common_data->date_pirth_he}}" name="date_pirth_he" id="date_pirth_he" class="form-control text-ignore-validation" />
													</div>
												</div>
												<hr size="5" class="hr-m"/>
												<div class="form-row" style="flex-wrap: nowrap; align-items: center;" dir="rtl">
												<label for="">
													الــديــانــة:
												</label>
												<div class="col-sm-4">
													<select id="religions_id" name="religions_id" class="form-control" >
														<option value="{{$common_data->religions_id}}" class="option">{{$religions}}</option>
														@foreach ($religionss as $religion)
															@if ($religion->id != $common_data->religions_id)
																<option value="{{$religion->id}}" @if(old('religions_id') == $religion->id) selected @endif class="option">{{$religion->na_relig}}</option>
															@endif
														@endforeach
													</select>
												</div>
												<label for="" style="margin-right: 20px;">
													الـحــالــة الاجــتــمـاعـيـة:
												</label>
												<div class="col-sm-5">
													<select name="social_statu_id" id="social_statu_id" class="form-control">
														<option value="{{$social_statu_id}}" class="option">{{$social_statu}}</option>
														@foreach ($social_status as $social_statu)
																@if ($social_statu->id != $social_statu_id)
																	
																<option value="{{$social_statu->id}}" class="option">{{$social_statu->na_status}}</option>
																@endif
																
														@endforeach
													</select>
												</div>
												</div>
							
												<hr size="5" class="hr-m"/>
												<div class="form-row" style="flex-wrap: nowrap; align-items: center;" dir="rtl">
												<label for="">
													الحالة التعليمية:
												</label>
												<div class="col-sm-2">
													<select name="learning_condition" id="learning_condition" class="form-control" required>
														@if ($common_data->learning_condition == 1)
															<option value="1" class="option">متعلم</option>
															<option value="0" class="option">امي</option>
														@else
															<option value="0" class="option">امي</option>
															<option value="1" class="option">متعلم</option>
														@endif
													</select>
												</div>
												<label for="" style="margin-right: 20px;">
													اسم اعلى شهادة:
												</label>
												<div class="col-sm-3">
													<select name="certificate_id" id="certificate_id" class="form-control">
														<option value="{{$certificate_id}}" class="option">{{$certificate}} </option>
														@foreach ($certificates as $certificate)
															@if ($certificate->id != $certificate_id)
																<option value="{{$certificate->id}}" class="option">{{$certificate->na_cert}}</option>
															@endif
														@endforeach
													</select>
												</div>
												<label for="" style="margin-right: 20px;">
													التخصص:
												</label>
												<div class="col-sm-3">
													<select name="specialtie_id" id="specialtie_id" class="form-control">
														<option value="{{$specialtie_id}}" class="option">{{$specialtie}} </option>
														@foreach ($specialties as $specialtie)
															@if ($specialtie->id != $specialtie_id)
																<option value="{{$specialtie->id}}" class="option">{{$specialtie->na_spec}}</option>
															@endif
														@endforeach                          
													</select>
												</div>
												</div>
							
												<hr size="5" class="hr-m"/>
												<div class="form-row" style="flex-wrap: nowrap; align-items: center;" dir="rtl">
												<label for="">
													الــــمــهـــنــة:
												</label>
												<div class="col-sm-4">
													<select name="profession_id" id="profession_id" class="form-control">
														<option value="{{$profession_id}}" class="option">{{$profession}} </option>
														@foreach ($professions as $profession)
														@if ($profession->id != $profession_id)
															<option value="{{$profession->id}}" class="option">{{$profession->na_profes}}</option>
														@endif
														@endforeach
													</select>
												</div>
												<label for="" style="margin-right: 20px;">
													جــهـــة الـــعـــمـــل:
												</label>
												<div class="col-sm-5">
													<select name="jihat_work_id" id="jihat_work_id" class="form-control">
														<option value="{{$jihat_work_id}}" class="option">{{$jihat_work}} </option>
														@foreach ($jihat_works as $jihat_work)
															@if ($jihat_work->id != $jihat_work_id)
																<option value="{{$jihat_work->id}}" class="option">{{$jihat_work->na_jihatw}}</option>
															@endif
														@endforeach
													</select>
												</div>
												</div>
							
												<hr size="5" class="hr-m"/>
												<div class="form-row" style="flex-wrap: nowrap; align-items: center;" dir="rtl">
													<label for="">
														الـــــعــنــوان:
													</label>
													<div class="form-holder">
														<div class="row mb-1">
														<div class="col-sm-3">
															<select name="countrie_accom_id" id="countrie_accom_id" class="form-control">
																<option value="{{$countrie_accom_id}}"  class="option" >{{$countrie_accom}} </option>
															</select>
														</div>
														<div class="col-sm-3">
															<select name="province_accom_id" id="province_accom_id" class="form-control">                                       
																<option value="{{$province_accom_id}}" class="option">{{$province_accom}}</option>
															</select>
														</div>
														
														<div class="col-sm-3 " >
															<select name="directorate_accom_id" id="directorate_accom_id" class="form-control">
																<option value="{{$directorate_accom_id}}" class="option">{{$directorate_accom}} </option>
															</select>
														</div>
							
														<div class="col-sm-3">
															<input type="text" placeholder="عزلة / قرية" class="form-control" value="{{$common_data->village_accom}}" name="village_accom" id="village_accom" required/>
														</div>
														</div>
							
														<div class="row">
														<div class="col-sm-3">
															<input type="text" placeholder="الحي" class="form-control" value="{{$common_data->neigh_accom}}" name="neigh_accom" id="neigh_accom" required/>
														</div>
														<div class="col-sm-3">
															<input type="text" placeholder="الشارع" class="form-control" value="{{$common_data->street_accom}}" name="street_accom" id="street_accom" required />
														</div>
														<div class="col-sm-3">
															<input type="text" placeholder="المنزل" class="form-control" value="{{$common_data->house_accom}}" name="house_accom" id="house_accom" required/>
														</div>
														<div class="col-sm-3">
															<input type="tel" placeholder="رقم التلفون" class="form-control" value="{{$common_data->num_phone}}" name="num_phone" id="num_phone" required/>
														</div>
														</div>
													</div>
												</div>
											</div>
												<hr size="5" class="hr-m"/>
											</section> 
											<div class="index-btn-wrapper justify-content-center" style="display: flex" dir="rtl">

												<div class="btn btn-primary col-md-2"  onclick="run(1, 2);">التالي</div>
												<div class="btn btn-outline-warning col-md-2" style="margin-right: 12px"  onclick="run(1, 0);">السابق</div>
											</div>
											</div>
										</div>
							
										<!-- tab 2 -->
										<div  class="tab" id="tab-2">
											<div id="wizard">
												<div class="form-header center1">
													<h6>بيانات  الشهود</h6>
												</div>
												<hr size="5" />
											<section class="sec">
												<div class="tooltip-demo">
													<div class="form-header center1">
														<h6>بيانات  الشاهد الأول</h6>
													</div>
													<hr size="5" />
							
													<div class="form-row" dir="rtl">
															<label for="">
																أسم الشاهد الكامل:
															</label>
															<div class="form-holder">
																<div class="row">
																<div class="col-sm-3">
																	<input type="text" placeholder="الاسم الأول" class="form-control" value="{!!$dataWitnesse->foreNa_witn!!}" name="foreNa_witn" required data-bs-toggle='tooltip'  title='هذ الحقل مخصص لاسم واحد فقط بالغة العربية ولايسمح بإدخال مسافة'/>
																</div>
																<div class="col-sm-3">
																	<input type="text" placeholder="أسم الاب" class="form-control" value="{!!$dataWitnesse->secondNa_witn!!}" name="secondNa_witn" required data-bs-toggle='tooltip'  title='هذ الحقل مخصص لاسم واحد فقط بالغة العربية ولايسمح بإدخال مسافة'/>
																</div>
																<div class="col-sm-3">
																	<input type="text" placeholder="أسم الجد" class="form-control" value="{!!$dataWitnesse->thirdNa_witn!!}" name="thirdNa_witn" required data-bs-toggle='tooltip'  title='هذ الحقل مخصص لاسم واحد فقط بالغة العربية ولايسمح بإدخال مسافة'/>
																</div>
																<div class="col-sm-">
																	<input type="text" placeholder="القب" class="form-control" value="{!!$dataWitnesse->tit_witn!!}" name="tit_witn" required data-bs-toggle='tooltip'  title='هذ الحقل مخصص لاسم واحد فقط بالغة العربية ولايسمح بإدخال مسافة'/>
																</div>
															</div>	                        
														</div>
													</div>
							
													<hr size="5" class="hr-m"/>
													<div class="form-row" dir="rtl">
														<label for="">
															جهة العمل:
														</label>
														<div class="col-sm-3">
															<select name="jihat_work_id" id="" class="form-control" required data-bs-toggle='tooltip'  title='يرجى إختيار عنصر من القائمة'>
																<option value="{{$jihat_work_w_id}}" class="option">{{$jihat_work_w}}</option>
																@foreach ($jihat_works as $jihat_work)
																	@if ($jihat_work->id != $jihat_work_w_id)
																		<option value="{{$jihat_work->id}}" class="option">{{$jihat_work->na_jihatw}}</option>
																	@endif
																@endforeach
															</select>
														</div>
														<label for="" style="margin-right: 20px;">
															مقر العمل:
														</label>
															<div class="col-sm-3">
																<input type="text" value="{!!$dataWitnesse->work_head_witn!!}" placeholder="مقر العمل" class="form-control" name="work_head_witn" required data-bs-toggle='tooltip' title='هذ الحقل خاص بمقر العمل يسمح بإدخال الاحرف العربية فقط '/>
															</div>
														<label for="" style="margin-right: 20px;">
															التلفون:
														</label>
															<div class="col-sm-2">
																<input type="tel" placeholder="رقم التلفون" value="{!!$dataWitnesse->phone_witn!!}" class="form-control" name="phone_witn" required data-bs-toggle='tooltip' title='هذا الحقل خاص برقم التلفون لايمكنك ادخال غير الارقم'/>
															</div>
													</div>
							
													<hr size="5" class="hr-m"/>
													<div class="form-row" dir="rtl">
														<label for="">
															بطاقة الشهاد:
														</label>
															<div class="col-sm-2">
																<select name="ty_document_witn_id" id="" class="form-control" required data-bs-toggle='tooltip'  title='يرجى إختيار عنصر من القائمة'>
																	<option value="{{$ty_document_witn_id}}" class="option">{{$ty_document_witn}}</option>
																	@foreach ($ty_documents as $ty_document)
																		@if ($ty_document->id != $ty_document_witn_id)
																		<option value="{{$ty_document->id}}" class="option">{{$ty_document->na_ty_doc}}</option>
																		@endif
																	@endforeach
																</select>
															</div>
															<label for="" style="margin-right: 20px;">
																رقم البطاقة:
															</label>
															<div class="col-sm-2">
																<input type="text" value="{!!$dataWitnesse->card_id!!}" class="form-control cardid" placeholder="رقم الــبــطاقـة" name="card_id" required data-bs-toggle='tooltip'  title='يرجى الانتباه هذا الحقل مخصص لرقم البطاقة الشخصية '/>
															</div>
															<label for="" style="margin-right: 20px;">
																محل الاصدار:
															</label>
															<div class="col-sm-2">
																<select name="card_version_center_id" id="" class="form-control" required data-bs-toggle='tooltip'  title='يرجى إختيار عنصر من القائمة'>
																	<option value="{{$card_version_center_w_id}}" class="option">{{$card_version_center_w}}</option>
																	@foreach ($card_version_centers as $card_version_center)
																		@if ($card_version_center->id != $card_version_center_w_id)
																		<option value="{{$card_version_center->id}}" class="option">{{$card_version_center->na_center}}</option>                                                
																		@endif                                                
																	@endforeach
																</select>
															</div>
													</div>
							
													<hr size="5" class="hr-m"/>
													<div class="form-row" dir="rtl">
														<label for="">
															تاريخ اصدار البطاقة:
														</label>
														<div class="col-sm-4">
															<input type="date" class="form-control" value="{!!$dataWitnesse->date_card_issuance!!}" name="date_card_issuance" required data-bs-toggle='tooltip'  title='يرجى تحديد تاريخ اصدار البطاقة'/>
														</div>
														<label for="" style="margin-right: 20px;">
															الـــعــنــوان:
														</label>
														<div class="col-sm-4">
															<input type="text" class="form-control" value="{!!$dataWitnesse->address_witn!!}" name="address_witn" required data-bs-toggle='tooltip'  title='هذ الحقل مخصص للعنوان يسمح بالغة العربية فقط '/>
														</div>
													</div>
							
													<hr size="5" class="hr-m"/>
													<div class="form-header center1">
														<br><h6>بيانات  الشاهد الثاني</h6>
													</div>
													<hr size="5" />
							
													<div class="form-row" dir="rtl">
														<label for="">
															أسم الشاهد الكامل:
														</label>
														<div class="form-holder">
															<div class="row">
															<div class="col-sm-3">
																<input type="text" placeholder="الاسم الأول" class="form-control" value="{!!$dataWitnesse2->foreNa_witn!!}" name="foreNa_witn2" required data-bs-toggle='tooltip'  title='هذ الحقل مخصص لاسم واحد فقط بالغة العربية ولايسمح بإدخال مسافة'/>
															</div>
															<div class="col-sm-3">
																<input type="text" placeholder="أسم الاب" class="form-control" value="{!!$dataWitnesse2->secondNa_witn!!}" name="secondNa_witn2" required data-bs-toggle='tooltip'  title='هذ الحقل مخصص لاسم واحد فقط بالغة العربية ولايسمح بإدخال مسافة'/>
															</div>
															<div class="col-sm-3">
																<input type="text" placeholder="أسم الجد" class="form-control" value="{!!$dataWitnesse2->thirdNa_witn!!}" name="thirdNa_witn2" required data-bs-toggle='tooltip'  title='هذ الحقل مخصص لاسم واحد فقط بالغة العربية ولايسمح بإدخال مسافة'/>
															</div>
															<div class="col-sm-3">
																<input type="text" placeholder="القب" class="form-control" value="{!!$dataWitnesse2->tit_witn!!}" name="tit_witn2" required data-bs-toggle='tooltip'  title='هذ الحقل مخصص لاسم واحد فقط بالغة العربية ولايسمح بإدخال مسافة'/>
															</div>
														</div>	                        
														</div>
													</div>
							
													<hr size="5" class="hr-m"/>
													<div class="form-row" dir="rtl">
														<label for="">
															جهة العمل:
														</label>
														<div class="col-sm-3">
															<select name="jihat_work_id2" id="" class="form-control" required data-bs-toggle='tooltip'  title='يرجى إختيار عنصر من القائمة'>
																<option value="{{$jihat_work_w_id2}}" class="option">{{$jihat_work_w2}}</option>
																@foreach ($jihat_works as $jihat_work)
																@if ($jihat_work->id != $jihat_work_w_id2)
																<option value="{{$jihat_work->id}}" class="option">{{$jihat_work->na_jihatw}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<label for="" style="margin-right: 20px;">
															مقر العمل:
														</label>
															<div class="col-sm-3">
																<input type="text" placeholder="مقر العمل" class="form-control"  value="{!!$dataWitnesse2->work_head_witn!!}" name="work_head_witn2" required data-bs-toggle='tooltip' title='هذ الحقل خاص بمقر العمل يسمح بإدخال الاحرف العربية فقط'/>
															</div>
														<label for="" style="margin-right: 20px;">
															التلفون:
														</label>
															<div class="col-sm-2">
																<input type="tel" placeholder="رقم التلفون" class="form-control" value="{!!$dataWitnesse2->phone_witn!!}" name="phone_witn2" required data-bs-toggle='tooltip' title='هذا الحقل خاص برقم التلفون لايمكنك ادخال غير الارقم'/>
															</div>
													</div>
							
													<hr size="5" class="hr-m"/>
													<div class="form-row" dir="rtl">
														<label for="">
															بطاقة الشهاد:
														</label>
															<div class="col-sm-2">
																<select name="ty_document_witn_id2" id="" class="form-control" required data-bs-toggle='tooltip'  title='يرجى إختيار عنصر من القائمة'>
																	<option value="{{$ty_document_witn_id2}}" class="option">{{$ty_document_witn2}}</option>
																	@foreach ($ty_documents as $ty_document)
																		@if ($ty_document->id != $ty_document_witn_id2)
																		<option value="{{$ty_document->id}}" class="option">{{$ty_document->na_ty_doc}}</option>
																		@endif
																	@endforeach
																</select>
															</div>
															<label for="" style="margin-right: 20px;">
																رقم البطاقة:
															</label>
															<div class="col-sm-2">
																<input type="text" class="form-control cardid" placeholder="رقم الــبــطاقـة" value="{!!$dataWitnesse2->card_id!!}" name="card_id2" required data-bs-toggle='tooltip'  title='يرجى الانتباه هذا الحقل مخصص لرقم البطاقة الشخصية '/>
															</div>
															<label for="" style="margin-right: 20px;">
																محل الاصدار:
															</label>
															<div class="col-sm-2">
																<select name="card_version_center_id2" id="" class="form-control" required data-bs-toggle='tooltip'  title='يرجى إختيار عنصر من القائمة'>
																	<option value="{{$card_version_center_w_id2}}" class="option">{{$card_version_center_w2}}</option>
																	@foreach ($card_version_centers as $card_version_center)
																		@if ($card_version_center->id != $card_version_center_w_id2)
																		<option value="{{$card_version_center->id}}" class="option">{{$card_version_center->na_center}}</option>                                                
																		@endif                                                
																	@endforeach
																</select>
															</div>
													</div>
							
													<hr size="5" class="hr-m"/>
													<div class="form-row" dir="rtl">
														<label for="">
															تاريخ اصدار البطاقة:
														</label>
														<div class="col-sm-4">
															<input type="date" class="form-control" value="{!!$dataWitnesse2->date_card_issuance!!}" name="date_card_issuance2" required data-bs-toggle='tooltip'  title='يرجى تحديد تاريخ اصدار البطاقة'/>
														</div>
														<label for="" style="margin-right: 20px;">
															الـــعــنــوان:
														</label>
														<div class="col-sm-4">
															<input type="text" class="form-control" value="{!!$dataWitnesse2->address_witn!!}" name="address_witn2" required data-bs-toggle='tooltip'  title='هذ الحقل مخصص للعنوان يسمح بالغة العربية فقط '/>
														</div>
													</div>
													<hr size="5" class="hr-m"/>
												</div>
											</section> 
											<div class="index-btn-wrapper justify-content-center" style="display: flex" dir="rtl">
												@can('تعديل الطلب')
													<div class="btn btn-primary col-md-2"  data-effect="effect-scale" data-toggle="modal" href="#modaldemo2">
														إرسال
													</div>
												@endcan
												<div class="btn btn-outline-warning col-md-2" style="margin-right: 12px" onclick="run(2, 1);">السابق</div>
											</div>
											</div>
										</div>
									</form>
								</div>
							</div>
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
<script src="{{asset('assets/js/flatpickr.js')}}"></script>
<script>

$(document).ready(function() {
		$('#req_fore_na').autocomplete({
			source: function(request, response) {
				$.ajax({
					url: '{{ route('autocomplete.names') }}',
					dataType: 'json',
					data: {
						term: request.term
					},
					success: function(data) {
						response(data);
					}
				});
			},
			minLength: 2,
			select: function(event, ui) {
				var names = ui.item.value.split(' - ');
				$('#req_fore_na').val(names[0]);
				$('#req_second_na').val(names[1]);
				$('#req_third_na').val(names[2]);
				$('#req_tit').val(names[3]);
				$('#nationality_req_id').val(ui.item.nationality_req_id);
				$('#father_fore_na').val(ui.item.father_fore_na);
				$('#father_second_na').val(ui.item.father_second_na);
				$('#father_third_na').val(ui.item.father_third_na);
				$('#father_tit').val(ui.item.father_tit);
				$('#nationality_father_id').val(ui.item.nationality_father_id);
				$('#mother_fore_na').val(ui.item.mother_fore_na);
				$('#mother_second_na').val(ui.item.mother_second_na);
				$('#mother_third_na').val(ui.item.mother_third_na);
				$('#mother_tit').val(ui.item.mother_tit);
				$('#nationality_mother_id').val(ui.item.nationality_mother_id);
				$('#gender').val(ui.item.gender);
				$('#date_pirth_ad').val(ui.item.date_pirth_ad);
				$('#date_pirth_he').val(ui.item.date_pirth_he);
				$('#countrie_birth_id').val(ui.item.countrie_birth_id);
				$('#province_birth_id').val(ui.item.province_birth_id);
				$('#directorate_pirth_id').val(ui.item.directorate_pirth_id)
				$('#village_parth').val(ui.item.village_parth);
				$('#religions_id').val(ui.item.religions_id);
				$('#social_statu_id').val(ui.item.social_statu_id);
				$('#learning_condition').val(ui.item.learning_condition);
				$('#certificate_id').val(ui.item.certificate_id);
				$('#specialtie_id').val(ui.item.specialtie_id);
				$('#profession_id').val(ui.item.profession_id);
				$('#jihat_work_id').val(ui.item.jihat_work_id);
				$('#countrie_accom_id').val(ui.item.countrie_accom_id);
				$('#province_accom_id').val(ui.item.province_accom_id);
				$('#directorate_accom_id').val(ui.item.directorate_accom_id);
				$('#village_accom').val(ui.item.village_accom);
				$('#neigh_accom').val(ui.item.neigh_accom);
				$('#street_accom').val(ui.item.street_accom);
				$('#house_accom').val(ui.item.house_accom);
				$('#num_phone').val(ui.item.num_phone);
				$('#id').val(ui.item.id);
				$('#user_id').val(ui.item.user_id);
				return false; // منع تعيين الاسم الكامل في الحقل الأول
			}
		});
	});
	// تقديم الطالب الى
	$(document).ready(function() {
            // استدعاء المحافظات من الخادم عند تحميل الصفحة
            $.ajax({
                url: "{{ route('indexprovince') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // إضافة اختيارات المحافظات إلى حقل المحافظات
                    $.each(data, function(key, value) {
                        $('#province_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });

            // استدعاء المديريات المرتبطة بالمحافظة المختارة
            $('#province_id').change(function() {
                var province_id = $(this).val();
                if (province_id) {
                    $.ajax({
                        url: "{{ route('getDirectoratesByGovernorate') }}",
                        type: "POST",
                        data: {
                            province_id: province_id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            // إضافة اختيارات المديريات إلى حقل المديرية
                            $('#directorate_id').empty().append('<option value="">مديرية</option>');
                            $.each(data, function(key, value) {
                                $('#directorate_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                            // إفراغ حقل المركز
                            $('#center_id').empty().append('<option value="">مركز</option>');
                        }
                    });
                } else {
                    // إفراغ حقول المديرية والمركز
                    $('#directorate_id').empty().append('<option value="">مديرية</option>');
                    $('#center_id').empty().append('<option value="">مركز</option>');
                }
            });

            // استدعاء المراكز المرتبطة بالمديرية المختارة
            $('#directorate_id').change(function() {
                var directorate_id = $(this).val();
                if (directorate_id) {
                    $.ajax({
                        url: "{{ route('getCentersByDirectorate') }}",
                        type: "POST",
                        data: {
                            directorate_id: directorate_id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            // إضافة اختيارات المراكز إلى حقل المركز
                            $('#center_id').empty().append('<option value="">مركز</option>');
                            $.each(data, function(key, value) {
                                $('#center_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    // إفراغ حقل المركز
                    $('#center_id').empty().append('<option value="">مركز</option>');
                }
            });
    });

	// العنوان + مكان الميلاد
	$(document).ready(function() {
            // استدعاء الدول من الخادم عند تحميل الصفحة
            $.ajax({
                url: "{{ route('Location.index') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // إضافة اختيارات الدول إلى حقل الدولة
                    $.each(data, function(key, value) {
                        $('#countrie_accom_id').append('<option value="' + key + '">' + value + '</option>');
                        $('#countrie_birth_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    
                }
            });
            
            // استدعاء المحافظات المرتبطة بدولة الاقامة المختارة
            $('#countrie_accom_id').change(function() {
                var countrie_accom_id = $(this).val();
                if (countrie_accom_id) {
                    $.ajax({
                        url: "{{ route('getGovernoratesByCountry') }}",
                        type: "POST",
                        data: {
                            countrie_accom_id: countrie_accom_id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            //  إضافة اختيارات المحافظات إلى حقل محافظة الاقامة
                            $('#province_accom_id').empty().append('<option value="">محافظة الإقامة</option>');
                            $.each(data, function(key, value) {
                                $('#province_accom_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                            // إفراغ حقول المديرية 
                            $('#directorate_accom_id').empty().append('<option value="">مديرية الإقامة</option>');
                        }
                    });
                } else {
                    // إفراغ جميع حقول الاختيارات
                    $('#province_accom_id').empty().append('<option value="">محافظة الإقامة</option>');
                    $('#directorate_accom_id').empty().append('<option value="">مديرية الإقامة</option>');
                }
            });

            // استدعاء المديريات المرتبطة بمحافظة الإقامة المختارة
            $('#province_accom_id').change(function() {
                var province_accom_id = $(this).val();
                if (province_accom_id) {
                    $.ajax({
                        url: "{{ route('getDirectoratesByProvinceAccom') }}",
                        type: "POST",
                        data: {
                            province_accom_id: province_accom_id,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            // إضافة اختيارات المديريات إلى حقل مديرية الإقامة
                            $('#directorate_accom_id').empty().append('<option value="">مديرية الإقامة</option>');
                            $.each(data, function(key, value) {
                                $('#directorate_accom_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    // إفراغ حقول مديرية الإقامة 
                    $('#directorate').empty().append('<option value="">مديرية الإقامة</option>');
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
    // نهائية العنوان + مكان الميلاد

	

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