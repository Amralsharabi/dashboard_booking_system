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
									<td style="width: 20%">{!!$LogDivorce->province->na_prov;!!}</td>
									<th style="width: 10%" class="th">مديرية</th>
									<td style="width: 20%">{!!$LogDivorce->directorate->na_dire;!!}</td>
									<th style="width: 10%" class="th">المركز</th>
									<td style="width: 20%">{!!$LogDivorce->center->na_center;!!}</td>
								</tr>
						</thead>
						<tbody>
						<tr class="text-center tr">
							<th colspan="6">يرجى تسجيل واقعة الطلاق طبقاً للبيانات التالية</th>
						</tr>
						<tr>
							<th class="th">تاريخ الطلاق الميلادي</th>
							<td>{!!$LogDivorce->date_contract_ad!!}</td>
							<th class="th">تاريخ الطلاق الهجري</th>
							<td>{!!$LogDivorce->date_contract_he!!}</td>
							
						</tr>
						<tr>
							<th class="th">محافظة الطلاق</th>
							<td>{!!$LogDivorce->provincecontract->na_prov!!}</td>
							<th class="th">مديرية الطلاق</th>
							<td>{!!$LogDivorce->directoratecontract->na_dire!!}</td>
							<th class="th">نوع الطلاق</th>
							@if ($LogDivorce->marri_type == 1)
								<td>نافذ</td>
							@else
								<td>رجعي</td>
							@endif
						</tr>
						<tr>
							<th class="th"> سبب الطلاق</th>
							<td>{!!$LogDivorce->divorce_reason!!}</td>\
						</tr>
						<tr class="text-center tr">
							<th colspan="6">عدد المولودين احياء للمطلقة من المطلق</th>
						</tr>
						<tr>
							<th class="th">ذكور</th>
							<td>{!!$LogDivorce->no_births_levi_husw_male!!}</td>
							<th class="th">اناث</th>
							<td>{!!$LogDivorce->no_births_levi_husw_fem!!}</td>
							<th class="th">اجمالي</th>
							<td>{!!$LogDivorce->no_births_levi_husw_male+$LogDivorce->no_births_levi_husw_fem!!}</td>
							
						</tr>
						<tr class="text-center tr">
							<th colspan="6">عدد المولودين احياء للمطلقة</th>
						</tr>
						<tr>
							<th class="th">ذكور</th>
							<td>{!!$LogDivorce->no_births_live_wife_male!!}</td>
							<th class="th">اناث</th>
							<td>{!!$LogDivorce->no_births_live_wife_fem!!}</td>
							<th class="th">اجمالي</th>
							<td>{!!$LogDivorce->no_births_live_wife_male+$LogDivorce->no_births_live_wife_fem!!}</td>
							
						</tr>
						<tr>
							<th class="th">تاريخ الزواج الميلادي</th>
							<td>{!!$LogDivorce->date_marriage!!}</td>
							<th class="th">تاريخ الزواج الهجري</th>
							<td>{!!$LogDivorce->date_marriage_hj!!}</td>
							<th class="th">حالة المطلقة</th>
							<td>
								@if ($LogDivorce->status_wife_after_divo == 1)
									حامل
								@elseif ($LogDivorce->status_wife_after_divo == 2)
									غير معروف
								@elseif ($LogDivorce->status_wife_after_divo == 3)
									مرضع
								@elseif ($LogDivorce->status_wife_after_divo == 4)
									لايوجد حمل
								@endif
							</td>
							
						</tr>
						<tr>
							<th class="th">اسم المحكمة</th>
							<td>{!!$LogDivorce->Court_na!!}</td>
							<th class="th">رقم الوثيفة</th>
							<td>{!!$LogDivorce->document_no!!}</td>
							<th class="th">تاريخ الوثيقة</th>
							<td>{!!$LogDivorce->date_document!!}</td>
							
						</tr>
						
						{{-- ///////////////////////////// --}}
						<tr class="text-center tr">
							<th colspan="6">بيانات المطلق</th>
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
							<th class="th">اسم الزواج</th>
							<td>{!!$HusbandData->forena!!}</td>
							<td>{{$HusbandData->secondna}}</td>
							<td>{{$HusbandData->thirdna}}</td>
							<td>{{$HusbandData->Tit}}</td>
							<td>{{$HusbandData->nationality->nationality_na}}</td>
						</tr>
						<tr class="text-center tr">
							<th colspan="6">محل ميلاد المطلق</th>
						</tr>
							<tr>
								<td class="th">تاريخ الميلاد الميلادي</td>
								<td>{{$HusbandData->date_pirth_Ad}}</td>
								<td class="th">تاريخ الميلاد الهجري</td>
								<td>{{$HusbandData->date_pirth_hegira}}</td>
							</tr>
							<tr>
								<th class="th">دولة الميلاد</th>
								<td colspan="2">{{$HusbandData->countrieparth->countrie_na}}</td>
								<td class="th">محافطة الميلاد</td>
								<td colspan="2">{{$HusbandData->provinceparth->na_prov}}</td>
							</tr>
							<tr>
								<td class="th">مديرية الميلاد</td>
								<td colspan="2">{{$HusbandData->directorateparth->na_dire}}</td>
								<td class="th">عزلة/قرية</td>
								<td colspan="2">{{$HusbandData->village_parth}}</td>
							</tr>
					
							<tr class="text-center tr">
								<th colspan="6">محل الاقامة المعتاد</th>
							</tr>
							<tr>
								<td class="th">دولة الاقامة</td>
								<td>{{$HusbandData->countrieacom->countrie_na}}</td>
								<td class="th">محافظة الاقامة</td>
								<td>{{$HusbandData->provinceacom->na_prov}}</td>
								<td class="th">مديرية الاقامة</td>
								<td>{{$HusbandData->directorateacom->na_dire}}</td>
							</tr>
							<tr>
								<td class="th">قرية الاقامة</td>
								<td>{{$HusbandData->village_accomm}}</td>
							</tr>
							<tr class="tr"><th colspan="6"></th></tr>
							<tr>
								<td class="th">الديانة</td>
								<td>{{$HusbandData->religion->na_relig}}</td>
								<td class="th">المهنة</td>
								<td>{{$HusbandData->profession->na_profes}}</td>
								<td class="th">المستوى التعليمية</td>
								@if ($HusbandData->educational_level == 1)
								<td>متعلم</td>
								@else
								<td>امي</td>
								@endif
							</tr>
							<tr>
								<td class="th">العمر عند اول زواج</td>
								<td>{{$HusbandData->age_first_marri}}</td>
								<td class="th">عدد مرات الزواج السابق</td>
								<td>{{$HusbandData->former_no}}</td>
							</tr>
					
							<tr class="text-center tr">
								<th colspan="6">بيانات ام المطلق</th>
							</tr>
							<tr>
								<th class="th"></th>
								<th class="th">اسم الفرد</th>
								<th class="th">اسم الاب</th>
								<th class="th">اسم الجد</th>
								<th class="th">اللقب</th>
							</tr>
							<tr>
								<th class="th">اسم الام</th>
								<td>{!!$HusbandData->forena_moth!!}</td>
								<td>{{$HusbandData->secondna_moth}}</td>
								<td>{{$HusbandData->thirdna_moth}}</td>
								<td>{{$HusbandData->tit_moth}}</td>
							</tr>
							<tr class="text-center tr">
								<th colspan="6">عدد المواليد احياء السابقين</th>
							</tr>
							<tr>
								<td class="th"> ذكور</td>
								<td>{{$HusbandData->no_form_biths_live_male}}</td>
								<td class="th">اناث</td>
								<td>{{$HusbandData->no_form_biths_live_female}}</td>
								<td class="th">إجمالي</td>
								<td>{{$HusbandData->no_form_biths_live_male+$HusbandData->no_form_biths_live_female}}</td>
							</tr>
							<tr class="text-center tr">
								<th colspan="6">بيانات بطاقة المطلق</th>
							</tr>
							<tr>
								<td class="th">نوع البطاقة</td>
								<td>{{$HusbandData->ty_document->na_ty_doc}}</td>
								<td class="th">جهة الاصدار</td>
								<td>{{$HusbandData->card_version_center->na_center}}</td>
								<td class="th">الرقم الوطني</td>
								<td>{{$HusbandData->card_No}}</td>
							</tr>
							<tr>
								<td class="th">تاريخ الاصدار</td>
								<td>{{$HusbandData->date_card_version}}</td>
							</tr>
					
						{{-- ///////////////////////////// --}}
						<tr class="text-center tr">
							<th colspan="6">بيانات المطلقة</th>
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
							<th class="th">اسم الزواج</th>
							<td>{!!$WifeData->forena!!}</td>
							<td>{{$WifeData->secondna}}</td>
							<td>{{$WifeData->thirdna}}</td>
							<td>{{$WifeData->Tit}}</td>
							<td>{{$WifeData->nationality->nationality_na}}</td>
						</tr>
						<tr class="text-center tr">
							<th colspan="6">محل ميلاد المطلقة</th>
						</tr>
							<tr>
								<td class="th">تاريخ الميلاد الميلادي</td>
								<td>{{$WifeData->date_pirth_Ad}}</td>
								<td class="th">تاريخ الميلاد الهجري</td>
								<td>{{$WifeData->date_pirth_hegira}}</td>
							</tr>
							<tr>
								<th class="th">دولة الميلاد</th>
								<td colspan="2">{{$WifeData->countrieparth->countrie_na}}</td>
								<td class="th">محافطة الميلاد</td>
								<td colspan="2">{{$WifeData->provinceparth->na_prov}}</td>
							</tr>
							<tr>
								<td class="th">مديرية الميلاد</td>
								<td colspan="2">{{$WifeData->directorateparth->na_dire}}</td>
								<td class="th">عزلة/قرية</td>
								<td colspan="2">{{$WifeData->village_parth}}</td>
							</tr>
					
							<tr class="text-center tr">
								<th colspan="6">محل الاقامة المعتاد</th>
							</tr>
							<tr>
								<td class="th">دولة الاقامة</td>
								<td>{{$WifeData->countrieacom->countrie_na}}</td>
								<td class="th">محافظة الاقامة</td>
								<td>{{$WifeData->provinceacom->na_prov}}</td>
								<td class="th">مديرية الاقامة</td>
								<td>{{$WifeData->directorateacom->na_dire}}</td>
							</tr>
							<tr>
								<td class="th">قرية الاقامة</td>
								<td>{{$WifeData->village_accomm}}</td>
							</tr>
							<tr class="tr"><th colspan="6"></th></tr>
							<tr>
								<td class="th">الديانة</td>
								<td>{{$WifeData->religion->na_relig}}</td>
								<td class="th">المهنة</td>
								<td>{{$WifeData->profession->na_profes}}</td>
								<td class="th">المستوى التعليمية</td>
								@if ($WifeData->educational_level == 1)
								<td>متعلم</td>
								@else
								<td>امي</td>
								@endif
							</tr>
							<tr>
								<td class="th">العمر عند اول زواج</td>
								<td>{{$WifeData->age_first_marri}}</td>
								<td class="th">عدد مرات الزواج السابق</td>
								<td>{{$WifeData->former_no}}</td>
							</tr>
					
							<tr class="text-center tr">
								<th colspan="6">بيانات ام المطلقة</th>
							</tr>
							<tr>
								<th class="th"></th>
								<th class="th">اسم الفرد</th>
								<th class="th">اسم الاب</th>
								<th class="th">اسم الجد</th>
								<th class="th">اللقب</th>
							</tr>
							<tr>
								<th class="th">اسم الام</th>
								<td>{!!$WifeData->forena_moth!!}</td>
								<td>{{$WifeData->secondna_moth}}</td>
								<td>{{$WifeData->thirdna_moth}}</td>
								<td>{{$WifeData->tit_moth}}</td>
							</tr>
							<tr class="text-center tr">
								<th colspan="6">عدد المواليد احياء السابقين</th>
							</tr>
							<tr>
								<td class="th"> ذكور</td>
								<td>{{$WifeData->no_form_biths_live_male}}</td>
								<td class="th">اناث</td>
								<td>{{$WifeData->no_form_biths_live_female}}</td>
								<td class="th">إجمالي</td>
								<td>{{$WifeData->no_form_biths_live_male+$WifeData->no_form_biths_live_female}}</td>
							</tr>
							<tr class="text-center tr">
								<th colspan="6">بيانات بطاقة المطلقة</th>
							</tr>
							<tr>
								<td class="th">نوع البطاقة</td>
								<td>{{$WifeData->ty_document->na_ty_doc}}</td>
								<td class="th">جهة الاصدار</td>
								<td>{{$WifeData->card_version_center->na_center}}</td>
								<td class="th">الرقم الوطني</td>
								<td>{{$WifeData->card_No}}</td>
							</tr>
							<tr>
								<td class="th">تاريخ الاصدار</td>
								<td>{{$WifeData->date_card_version}}</td>
							</tr>
							{{-- </tbody> --}}
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