@extends('layouts.master')
@section('title')
	طلبت تم تحديد موعد الحضور
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الطلبات المحدد موعد الحضور</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">رقم الطلب</th>
												<th class="wd-20p border-bottom-0">نوع الطلب</th>
												{{-- <th class="wd-25p border-bottom-0">اسم مقدم الطلب</th> --}}
												<th class="wd-10p border-bottom-0">المحافظة</th>
												<th class="wd-15p border-bottom-0">المديرية</th>
												<th class="wd-15p border-bottom-0">المركز</th>
												<th class="wd-10p border-bottom-0">موعد الحضور</th>

												<th class="wd-10p border-bottom-0">العمليات</th>
												<th class="wd-10p border-bottom-0">تاريخ الطلب</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($CardPersonaNews as $CardPersonaNew)
												<tr>
													<form action="{{route('show.card.pers',encrypt($CardPersonaNew->id))}}" method="post">
														{{-- @method('PATCH') --}}
														@csrf
														<td>{{$CardPersonaNew->id}}</td>
														<td>بطاقة شخصية</td>
														{{-- <td>{{$CardPersonaNew->common_data->req_fore_na.' '.$CardPersonaNew->common_data->req_second_na.' '.$CardPersonaNew->common_data->req_third_na.' '.$CardPersonaNew->common_data->req_tit}}</td> --}}
														<td>{{$CardPersonaNew->province->na_prov}}</td>
														<td>{{$CardPersonaNew->directorate->na_dire}}</td>
														<td>{{$CardPersonaNew->center->na_center}}</td>
														<td>{{$CardPersonaNew->time_attendees}}</td>
														<td><button type="submit" class="btn btn-primary" style="margin-bottom: 7px;">طباعة</button>
															
														</td>
														<td>{{$CardPersonaNew->created_at->format('Y-m-d')}}</td>
															<input type="hidden" name="typecard" value="1">
													</form>
												</tr>
											@endforeach

											@foreach ($CardDamageRenewals as $CardDamageRenewal)
												<tr>
													<form action="{{route('CardDamagedRenewal.edit',encrypt($CardDamageRenewal->id))}}" method="get">
														{{-- @method('GET') --}}
														@csrf
														<td>{{$CardDamageRenewal->id}}</td>
														<td>بطاقة شخصية {{$CardDamageRenewal->req_type}}</td>
														{{-- <td>{{$CardDamageRenewal->common_data->req_fore_na.' '.$CardDamageRenewal->common_data->req_second_na.' '.$CardDamageRenewal->common_data->req_third_na.' '.$CardDamageRenewal->common_data->req_tit}}</td> --}}
														<td>{{$CardDamageRenewal->province->na_prov}}</td>
														<td>{{$CardDamageRenewal->directorate->na_dire}}</td>
														<td>{{$CardDamageRenewal->center->na_center}}</td>
														<td>{{$CardDamageRenewal->time_attendees}}</td>
														<td><button type="submit" class="btn btn-primary" style="margin-bottom: 7px;">طباعة</button>
															
														</td>
														<td>{{$CardDamageRenewal->created_at->format('Y-m-d')}}</td>
														<td>
															<input type="hidden" name="id" value="{{encrypt($CardDamageRenewal->id)}}">
															<input type="hidden" name="typecard" value="3">
															<input type="hidden" name="center_id" value="{{$CardDamageRenewal->center_id}}">
															<input type="hidden" class="form-control" name="time_attendees_hijri" id="time_attendees_hijri"></td>
															
														</td>
													</form>
												</tr>
											@endforeach

											@foreach ($FamilyCards as $FamilyCard)
												<tr>
													<form action="{{route('FamilyCardshow',encrypt($FamilyCard->id))}}" method="post">
														{{-- @method('PATCH') --}}
														@csrf
														<td>{{$FamilyCard->id}}</td>
														<td>بطاقة عائلية</td>
														{{-- <td>{{$FamilyCard->common_data->req_fore_na.' '.$FamilyCard->common_data->req_second_na.' '.$FamilyCard->common_data->req_third_na.' '.$FamilyCard->common_data->req_tit}}</td> --}}
														<td>{{$FamilyCard->province->na_prov}}</td>
														<td>{{$FamilyCard->directorate->na_dire}}</td>
														<td>{{$FamilyCard->center->na_center}}</td>
														<td>{{$FamilyCard->time_attendees}}</td>
														<td><button type="submit" class="btn btn-primary" style="margin-bottom: 7px;">طباعة</button>
															
														</td>
														<td>{{$FamilyCard->created_at->format('Y-m-d')}}</td>
															<input type="hidden" name="typecard" value="1">
													</form>
												</tr>
											@endforeach

											@foreach ($BirthRestrictions as $BirthRestriction)
												<tr>
													<form action="{{route('BirthRestriction',encrypt($BirthRestriction->id))}}" method="post">
														{{-- @method('PATCH') --}}
														@csrf
														<td>{{$BirthRestriction->id}}</td>
														<td>قيد ميلاد</td>
														{{-- <td>{{$BirthRestriction->common_data->req_fore_na.' '.$BirthRestriction->common_data->req_second_na.' '.$BirthRestriction->common_data->req_third_na.' '.$BirthRestriction->common_data->req_tit}}</td> --}}
														<td>{{$BirthRestriction->province->na_prov}}</td>
														<td>{{$BirthRestriction->directorate->na_dire}}</td>
														<td>{{$BirthRestriction->center->na_center}}</td>
														<td>{{$BirthRestriction->time_attendees}}</td>
														<td><button type="submit" class="btn btn-primary" style="margin-bottom: 7px;">طباعة</button>
															
														</td>
														<td>{{$BirthRestriction->created_at->format('Y-m-d')}}</td>
															<input type="hidden" name="typecard" value="1">
													</form>
												</tr>
											@endforeach

											@foreach ($LogMarriages as $LogMarriage)
												<tr>
													<form action="{{route('LogMarriage',encrypt($LogMarriage->id))}}" method="post">
														{{-- @method('PATCH') --}}
														@csrf
														<td>{{$LogMarriage->id}}</td>
														<td>قيد زواج</td>
														{{-- <td>{{$LogMarriage->common_data->req_fore_na.' '.$LogMarriage->common_data->req_second_na.' '.$LogMarriage->common_data->req_third_na.' '.$LogMarriage->common_data->req_tit}}</td> --}}
														<td>{{$LogMarriage->province->na_prov}}</td>
														<td>{{$LogMarriage->directorate->na_dire}}</td>
														<td>{{$LogMarriage->center->na_center}}</td>
														<td>{{$LogMarriage->time_attendees}}</td>
														<td><button type="submit" class="btn btn-primary" style="margin-bottom: 7px;">طباعة</button>
															
														</td>
														<td>{{$LogMarriage->created_at->format('Y-m-d')}}</td>
															<input type="hidden" name="typecard" value="1">
													</form>
												</tr>
											@endforeach

											@foreach ($LogDivorces as $LogDivorce)
												<tr>
													<form action="{{route('LogDivorce',encrypt($LogDivorce->id))}}" method="post">
														{{-- @method('PATCH') --}}
														@csrf
														<td>{{$LogDivorce->id}}</td>
														<td>قيد طلاق</td>
														{{-- <td>{{$LogDivorce->common_data->req_fore_na.' '.$LogDivorce->common_data->req_second_na.' '.$LogDivorce->common_data->req_third_na.' '.$LogDivorce->common_data->req_tit}}</td> --}}
														<td>{{$LogDivorce->province->na_prov}}</td>
														<td>{{$LogDivorce->directorate->na_dire}}</td>
														<td>{{$LogDivorce->center->na_center}}</td>
														<td>{{$LogDivorce->time_attendees}}</td>
														<td><button type="submit" class="btn btn-primary" style="margin-bottom: 7px;">طباعة</button>
															
														</td>
														<td>{{$LogDivorce->created_at->format('Y-m-d')}}</td>
															<input type="hidden" name="typecard" value="1">
													</form>
												</tr>
											@endforeach

											@foreach ($DeathStatements as $DeathStatement)
												<tr>
													<form action="{{route('DeathStatement',encrypt($DeathStatement->id))}}" method="post">
														{{-- @method('PATCH') --}}
														@csrf
														<td>{{$DeathStatement->id}}</td>
														<td>شهادة وفاة</td>
														{{-- <td>{{$DeathStatement->common_data->req_fore_na.' '.$DeathStatement->common_data->req_second_na.' '.$DeathStatement->common_data->req_third_na.' '.$DeathStatement->common_data->req_tit}}</td> --}}
														<td>{{$DeathStatement->province->na_prov}}</td>
														<td>{{$DeathStatement->directorate->na_dire}}</td>
														<td>{{$DeathStatement->center->na_center}}</td>
														<td>{{$DeathStatement->time_attendees}}</td>
														<td><button type="submit" class="btn btn-primary" style="margin-bottom: 7px;">طباعة</button>
															
														</td>
														<td>{{$DeathStatement->created_at->format('Y-m-d')}}</td>
															<input type="hidden" name="typecard" value="1">
													</form>
												</tr>
											@endforeach

											@foreach ($CorrectionInstRevConstrs as $CorrectionInstRevConstr)
												<tr>
													<form action="{{route('show.card.pers',encrypt($CorrectionInstRevConstr->id))}}" method="post">
														{{-- @method('PATCH') --}}
														@csrf
														<td>{{$CorrectionInstRevConstr->id}}</td>
														<td>تصحيح او ابطال قيد</td>
														{{-- <td>{{$CorrectionInstRevConstr->common_data->req_fore_na.' '.$CorrectionInstRevConstr->common_data->req_second_na.' '.$CorrectionInstRevConstr->common_data->req_third_na.' '.$CorrectionInstRevConstr->common_data->req_tit}}</td> --}}
														<td>{{$CorrectionInstRevConstr->province->na_prov}}</td>
														<td>{{$CorrectionInstRevConstr->directorate->na_dire}}</td>
														<td>{{$CorrectionInstRevConstr->center->na_center}}</td>
														<td>{{$CorrectionInstRevConstr->time_attendees}}</td>
														<td><button type="submit" class="btn btn-primary" style="margin-bottom: 7px;">طباعة</button>
															
														</td>
														<td>{{$CorrectionInstRevConstr->created_at->format('Y-m-d')}}</td>
															<input type="hidden" name="typecard" value="1">
													</form>
												</tr>
											@endforeach

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
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
@endsection