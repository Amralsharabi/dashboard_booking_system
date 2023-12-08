@extends('layouts.master')
@section('title')
	عرض طلب قيد وشهادة ميلاد
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
											<h6 class="mb-4"> عرض طلب الحصول قيد وشهادة ميلاد </h6>
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
														<input type="hidden" value="{{encrypt($BirthRestriction->id)}}" name="id" id="id">
														<input type="hidden" value="{{$common_data->user_id}}" name="user_id" id="user_id">
														<input type="hidden" name="typecard" value="4">
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