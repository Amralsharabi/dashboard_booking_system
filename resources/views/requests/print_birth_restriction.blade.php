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
								<th colspan="6">بيانات المولود</th>
							</tr>
							<tr>
								<th class="th"></th>
								<th class="th">اسم الفرد</th>
								<th class="th">اسم الاب</th>
								<th class="th">اسم الجد</th>
								<th class="th">اللقب</th>
								<th class="th">النوع</th>
								
							</tr>
							<tr>
								<th class="th">المولود</th>
								<td>{!!$common_data->req_fore_na!!}</td>
								<td>{{$common_data->req_second_na}}</td>
								<td>{{$common_data->req_third_na}}</td>
								<td>{{$common_data->req_tit}}</td>
								@if ($common_data->gender == 1)
										<td>ذكر</td>
										@else
									<td>انثى</td>
								@endif
							</tr>
							<tr>
								<td class="th">نوع الولادة</td>
								<td>{{$BirthRestriction->birthtyp->birth_ty_na}}</td>
								<td class="th">تاريخ الميلاد الميلادي</td>
								<td>{{$common_data->date_pirth_ad}}</td>
								<td class="th">تاريخ الميلاد الهجري</td>
								<td>{{$common_data->date_pirth_he}}</td>
							</tr>
							<tr class="text-center tr">
								<th colspan="6">محل الميلاد</th>
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
							<tr>
								<td class="th">صفة من قام بتوليد</td>
								<td colspan="2">{{$BirthRestriction->generatedwho->na_generwho}}</td>
								<td class="th">مكان الولادة</td>
								<td colspan="2">{{$BirthRestriction->placebirth->na_place}}</td>
							</tr>
					
							{{-- ////////////////////////////////////// --}}
							<tr class="text-center tr">
								<th colspan="6">بيانات الاب</th>
							</tr>
							<tr>
								<th class="th"></th>
								<th class="th">اسم الفرد</th>
								<th class="th">اسم الاب</th>
								<th class="th">اسم الجد</th>
								<th class="th">اللقب</th>
								<td class="th">الجنسية</td>
								
							</tr>
							<tr>
								<th class="th">اسم الاب</th>
								<td>{{$common_data->father_fore_na}}</td>
								<td>{{$common_data->father_second_na}}</td>
								<td>{{$common_data->father_third_na}}</td>
								<td>{{$common_data->father_tit}}</td>
								<td>{{$nationality_father}}</td>
							</tr>
							<tr class="text-center tr">
								<th colspan="6">محل ميلاد الاب</th>
							</tr>
							<tr>
								<th class="th">دولة الميلاد</th>
								<td>{{$BirthRestriction->countrieparthfather->countrie_na}}</td>
								<td class="th">محافطة الميلاد</td>
								<td>{{$BirthRestriction->provinceparthfather->na_prov}}</td>
								<td class="th">تاريخ الميلاد الميلادي</td>
								<td>{{$BirthRestriction->date_pirth_Ad_father}}</td>
							</tr>
							<tr>
								<td class="th">مديرية الميلاد</td>
								<td>{{$BirthRestriction->directorateparthfather->na_dire}}</td>
								<td class="th">عزلة/قرية</td>
								<td>{{$BirthRestriction->village_parth_father}}</td>
								<td class="th">تاريخ الميلاد الهجري</td>
								<td>{{$BirthRestriction->date_pirth_hegira_father}}</td>
							</tr>
							<tr class="text-center tr">
								<th colspan="6">محل الاقامة المعتاد للاب</th>
							</tr>
							<tr>
								<td class="th">دولة الاقامة</td>
								<td>{{$BirthRestriction->countrieaccomfather->countrie_na}}</td>
								<td class="th">محافظة الاقامة</td>
								<td>{{$BirthRestriction->provinceaccomfather->na_prov}}</td>
								<td class="th">مديرية الاقامة</td>
								<td>{{$BirthRestriction->directorateaccomfather->na_dire}}</td>
							</tr>
							<tr>
								<td class="th">عزلة/قرية</td>
								<td>{{$BirthRestriction->village_accomm_father}}</td>
							</tr>
							<tr class="tr"><th colspan="6"></th></tr>
							<tr>
								<td class="th">الديانة</td>
								<td>{{$BirthRestriction->religionsfath->na_relig}}</td>
								<td class="th">المهنة</td>
								<td>{{$BirthRestriction->professionfather->na_profes}}</td>
								<td class="th">المستوى التعليمية</td>
								@if ($BirthRestriction->educa_level_fath == 1)
									<td>متعلم</td>
								@else
									<td>امي</td>
								@endif
							</tr>
							<tr>
								<td class="th">العمر عند اول زواج</td>
								<td>{{$BirthRestriction->fath_age_first_marri}}</td>
							</tr>
							<tr class="text-center tr">
								<th colspan="6">بيانات بطاقة الاب</th>
							</tr>
							<tr>
								<td class="th">نوع البطاقة</td>
								<td>{{$BirthRestriction->tydocumentfath->na_ty_doc}}</td>
								<td class="th">جهة الاصدار</td>
								<td>{{$BirthRestriction->cardverscentfath->na_center}}</td>
								<td class="th">الرقم الوطني</td>
								<td>{{$BirthRestriction->card_id_fath}}</td>
							</tr>
					
							{{-- ////////////////////////////////////// --}}
							<tr class="text-center tr">
								<th colspan="6">بيانات الام</th>
							</tr>
							<tr>
								<th class="th"></th>
								<th class="th">اسم الفرد</th>
								<th class="th">اسم الاب</th>
								<th class="th">اسم الجد</th>
								<th class="th">اللقب</th>
								<td class="th">الجنسية</td>
								
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
								<th colspan="6">محل ميلاد الام</th>
							</tr>
							<tr>
								<th class="th">دولة الميلاد</th>
								<td>{{$BirthRestriction->countrieparthmother->countrie_na}}</td>
								<td class="th">محافطة الميلاد</td>
								<td>{{$BirthRestriction->provinceparthmoth->na_prov}}</td>
								<td class="th">تاريخ الميلاد الميلادي</td>
								<td>{{$BirthRestriction->date_pirth_ad_moth}}</td>
							</tr>
							<tr>
								<td class="th">مديرية الميلاد</td>
								<td>{{$BirthRestriction->directorateparthmoth->na_dire}}</td>
								<td class="th">عزلة/قرية</td>
								<td>{{$BirthRestriction->village_parth_moth}}</td>
								<td class="th">تاريخ الميلاد الهجري</td>
								<td>{{$BirthRestriction->date_pirth_he_moth}}</td>
							</tr>
							<tr class="text-center tr">
								<th colspan="6">محل الاقامة المعتاد للام</th>
							</tr>
							<tr>
								<td class="th">دولة الاقامة</td>
								<td>{{$BirthRestriction->countrieaccommoth->countrie_na}}</td>
								<td class="th">محافظة الاقامة</td>
								<td>{{$BirthRestriction->provinceaccommoth->na_prov}}</td>
								<td class="th">مديرية الاقامة</td>
								<td>{{$BirthRestriction->directorateaccommoth->na_dire}}</td>
							</tr>
							<tr>
								<td class="th">عزلة/قرية</td>
								<td>{{$BirthRestriction->village_accomm_moth}}</td>
							</tr>
							<tr class="tr"><th colspan="6"></th></tr>
							<tr>
								<td class="th">الديانة</td>
								<td>{{$BirthRestriction->religionsmoht->na_relig}}</td>
								<td class="th">المهنة</td>
								<td>{{$BirthRestriction->professionmoth->na_profes}}</td>
								<td class="th">المستوى التعليمية</td>
								@if ($BirthRestriction->educa_level_moth == 1)
									<td>متعلم</td>
								@else
									<td>امي</td>
								@endif
							</tr>
							<tr>
								<td class="th">العمر عند اول زواج</td>
								<td>{{$BirthRestriction->moth_age_first_marri}}</td>
							</tr>
							<tr class="text-center tr">
								<th colspan="6">بيانات بطاقة الام</th>
							</tr>
							<tr>
								<td class="th">نوع البطاقة</td>
								<td>{{$BirthRestriction->tydocumentmoth->na_ty_doc}}</td>
								<td class="th">جهة الاصدار</td>
								<td>{{$BirthRestriction->cardverscentmoth->na_center}}</td>
								<td class="th">الرقم الوطني</td>
								<td>{{$BirthRestriction->card_id_moth}}</td>
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