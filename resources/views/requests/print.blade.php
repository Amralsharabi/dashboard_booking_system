@extends('layouts.master')
@section('title')
	طباعة التقرير
@endsection
@section('css')
<style>
	.table-bordered thead td {
    background-color: #fff !important;
}.img-head{
            width: 100%;
            max-height: 120px;
        }
</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طباعة</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<!--div-->
					<div id="" class="container bg-white" style="margin-top: 210px; padding:10px 8px 10px 8px; ">
						<button class="bx bx-printer display-1   bg-transparent text-black" style="border: 0px;font-size: 41px;" id="print-button" onclick="printDiv()"></button>
						</div>
						<div id="mydivs" class="container bg-white mydiv " style=" margin-bottom:50px; padding:10px 8px 10px 8px; ">
							<table class="table table-sm table-bordered bg-white" style="margin-top: 5px !important;"  dir="rtl">
								<thead>
									<tr>
										<th colspan="6">
											<img src="{{asset('assets/img/head2.png')}}" class="img-head" ><br><br>
										</th>
									</tr>
									<tr>
										<td style="width: 10%" class="th">رقم الطلب</td>
										<td style="width: 10%">{!!$id!!}</td>
									</tr>
									<tr>
										<th style="width: 10%" class="th">محافظة</th>
										<td style="width: 20%">{!!$province!!}</td>
										<th style="width: 10%" class="th">مديرية</th>
										<td style="width: 20%">{!!$directorate!!}</td>
										<th style="width: 10%" class="th">المركز</th>
										<td style="width: 20%">{!!$center!!}</td>
									</tr>
							</thead>
							<tbody>
							<tr class="text-center tr">
								<th colspan="6">بيانات مقدم الطلب</th>
							  </tr>
							  <tr>
								  <th class="th"></th>
								  <th class="th">اسم الفرد</th>
								<th class="th">اسم الاب</th>
								<th class="th">اسم الجد</th>
								<th class="th">اللقب</th>
								<th class="th">الجنسية</th>
								
							</tr>
							  <tr>
								<th class="th">مقدم الطلب</th>
								<td>{!!$common_data->req_fore_na!!}</td>
								<td>{{$common_data->req_second_na}}</td>
								<td>{{$common_data->req_third_na}}</td>
								<td>{{$common_data->req_tit}}</td>
								<td>{{$nationality_req}}</td>
							</tr>
							<tr>
								<th class="th">اسم الاب</th>
								<td>{{$common_data->father_fore_na}}</td>
								<td>{{$common_data->father_second_na}}</td>
								<td>{{$common_data->father_third_na}}</td>
								<td>{{$common_data->father_tit}}</td>
								<td>{{$nationality_father}}</td>
							</tr>
							<tr>
								<th class="th">اسم الام</th>
								<td>{{$common_data->mother_fore_na}}</td>
								<td>{{$common_data->mother_second_na}}</td>
								<td>{{$common_data->mother_third_na}}</td>
								<td>{{$common_data->mother_tit}}</td>
								<td>{{$nationality_mother}}</td>
							  </tr>
							  <tr class="text-center tr">
								  <th colspan="6">محل الميلاد</th>
								</tr>
								<tr>
									<th class="th">النوع</th>
									@if ($common_data->gender == 1)
											<td>ذكر</td>
											@else
										<td>انثى</td>
									@endif
									<td class="th">تاريخ الميلاد الميلادي</td>
									<td>{{$common_data->date_pirth_ad}}</td>
									<td class="th">تاريخ الميلاد الهجري</td>
									<td>{{$common_data->date_pirth_he}}</td>
								</tr>
								<tr>
									<th class="th">دولة الميلاد</th>
									<td colspan="2">{{$countrie_birth}}</td>
									<td class="th">محافطة الميلاد</td>
									<td colspan="2">{{$province_birth}}</td>
								</tr>
								<tr>
									<td class="th">مديرية الميلاد</td>
									<td colspan="2">{{$directorate_pirth}}</td>
									<td class="th">عزلة/قرية</td>
									<td colspan="2">{{$common_data->village_parth}}</td>
								</tr>
							  <tr class="tr"><th colspan="6"></th></tr>
								<tr>
									<td class="th">الديانة</td>
									<td>{{$religions}}</td>
									<td class="th">الحالة الاجتماعية</td>
									<td>{{$social_statu}}</td>
									<td class="th">فصيلة الدم</td>
									<td>{!!$blood_type!!}</td>
								</tr>
								<tr>
									<td class="th">الحالة التعليمية</td>
									@if ($common_data->learning_condition == 1)
										<td>متعلم</td>
										@else
										<td>امي</td>
										@endif
									<td class="th">اسم اعلى شهادة</td>
									<td>{{$certificate}}</td>
									<td class="th">التخصص</td>
									<td>{{$specialtie}}</td>
								</tr>
								<tr>
									<td class="th">المهنة</td>
									<td colspan="2">{{$profession}}</td>
									<td class="th">جهة العمل</td>
									<td colspan="2">{{$jihat_work}}</td>
								</tr>
								<tr class="text-center tr">
									<th colspan="6">العنوان</th>
								</tr>
								<tr>
									<td class="th">دولة الاقامة</td>
									<td>{{$countrie_accom}}</td>
									<td class="th">محافظة الاقامة</td>
									<td>{{$province_accom}}</td>
									<td class="th">مديرية الاقامة</td>
									<td>{{$directorate_accom}}</td>
								</tr>
								<tr>
									<td class="th">عزلة/قرية</td>
									<td>{{$common_data->village_accom}}</td>
									<td class="th">الحي</td>
									<td>{{$common_data->neigh_accom}}</td>
									<td class="th">الشارع</td>
									<td>{{$common_data->street_accom}}</td>
								</tr>
								<tr>
									<td class="th">المنزل</td>
									<td colspan="2">{{$common_data->house_accom}}</td>
									<td class="th">رقم التلفون</td>
									<td colspan="2">{{$common_data->num_phone}}</td>
								</tr>
								{{-- </tbody> --}}
							</table>
							<table class="table table-sm table-bordered bg-white" dir="rtl">
								<tr>
									<td colspan="4"><b>الاقرار:</b> اقر بأن جميع البيانات الواردة اعلاه صحيحة وانه لم يسبق لي الحصول على بطاقة شخصية من قبل وعلى مسئوليتي</td>
								</tr>
								<tr>
									<th class="th">تاريخ الطلب</th>
									<td style="width: 40%">{{$cardPersonaNew->created_at}}</td>
									<th class="th">توقيع مقدم الطلب</th>
									<td style="width: 40%"></td>
								</tr>
							</table>
							<table class="table table-sm table-bordered bg-white" dir="rtl">
								<tr>
									<td colspan="6"><b>الشهود: </b>نشهد نحن الموقعين على هذا بان الاخ/{!!'<b>'.$common_data->req_fore_na.' '.$common_data->req_second_na.' '.$common_data->req_third_na.' '.$common_data->req_tit.'</b>'!!} والمرفقة صورته اعلاه معروف لدينا وان جميع البيانات اعلاه  صحيحة وانه متمتع بالجنسية اليمنية وعلى مسئوليتنا</td>
								</tr>
								<tr class="text-center tr">
									<th colspan="6">الشاهد الاول</th>
								</tr>
								<tr>
									<th style="width: 10%" class="th">الاسم</th>
									<td style="width: 20%">{!!$dataWitnesse->foreNa_witn.' '.$dataWitnesse->secondNa_witn.' '.$dataWitnesse->thirdNa_witn.' '.$dataWitnesse->tit_witn!!}</td>
									<th style="width: 10%" class="th">جهة العمل</th>
									<td style="width: 10%">{{$jihat_work_w}}</td>
									<th style="width: 10%" class="th">مقر العمل</th>
									<td style="width: 20%">{!!$dataWitnesse->work_head_witn!!}</td>
								</tr>
								<tr>
									<th style="width: 10%" class="th">رقم التلفون</th>
									<td style="width: 10%">{!!$dataWitnesse->phone_witn!!}</td>
									<th style="width: 10%" class="th">نوع البطاقة</th>
									<td style="width: 20%">{{$ty_document_witn}}</td>
									<th style="width: 10%" class="th">رقمها</th>
									<td style="width: 10%">{!!$dataWitnesse->card_id!!}</td>
								</tr>
								<tr>
									<th style="width: 10%" class="th">محل صدورها</th>
									<td style="width: 10%">{{$card_version_center_w}}</td>
									<th style="width: 10%" class="th">تاريخ صدورها</th>
									<td style="width: 10%">{!!$dataWitnesse->date_card_issuance!!}</td>
									<th style="width: 10%" class="th">عنوان السكن</th>
									<td style="width: 20%">{!!$dataWitnesse->address_witn!!}</td>
								</tr>
								<th style="width: 10%" class="th">التوقيع</th>
									<td style="width: 20%" colspan="2"></td>
									<th style="width: 10%" class="th">البصمة</th>
									<td style="width: 20%" colspan="2"></td>
								<tr>
						
								</tr>
								<tr class="text-center tr">
									<th colspan="6">الشاهد الثاني</th>
								</tr>
								<tr>
									<th style="width: 10%" class="th">الاسم</th>
									<td style="width: 20%">{!!$dataWitnesse2->foreNa_witn.' '.$dataWitnesse2->secondNa_witn.' '.$dataWitnesse2->thirdNa_witn.' '.$dataWitnesse2->tit_witn!!}</td>
									<th style="width: 10%" class="th">جهة العمل</th>
									<td style="width: 10%">{{$jihat_work_w2}}</td>
									<th style="width: 10%" class="th">مقر العمل</th>
									<td style="width: 20%">{!!$dataWitnesse2->work_head_witn!!}</td>
								</tr>
								<tr>
									<th style="width: 10%" class="th">رقم التلفون</th>
									<td style="width: 10%">{!!$dataWitnesse2->phone_witn!!}</td>
									<th style="width: 10%" class="th">نوع البطاقة</th>
									<td style="width: 20%">{{$ty_document_witn2}}</td>
									<th style="width: 10%" class="th">رقمها</th>
									<td style="width: 10%">{!!$dataWitnesse2->card_id!!}</td>
								</tr>
								<tr>
									<th style="width: 10%" class="th">محل صدورها</th>
									<td style="width: 10%">{{$card_version_center_w2}}</td>
									<th style="width: 10%" class="th">تاريخ صدورها</th>
									<td style="width: 10%">{!!$dataWitnesse2->date_card_issuance!!}</td>
									<th style="width: 10%" class="th">عنوان السكن</th>
									<td style="width: 20%">{!!$dataWitnesse2->address_witn!!}</td>
								</tr>
								<tr>
									<th style="width: 10%" class="th">التوقيع</th>
									<td style="width: 20%" colspan="2"></td>
									<th style="width: 10%" class="th">البصمة</th>
									<td style="width: 20%" colspan="2"></td>
						
								</tr>
							</table>
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
<script type="text/javascript">
	function printDiv() {
		var printContents = document.getElementById('mydivs').innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}

</script>
@endsection