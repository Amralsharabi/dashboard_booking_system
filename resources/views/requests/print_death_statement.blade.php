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
									<td style="width: 20%">{!!$death_statements->province->na_prov!!}</td>
									<th style="width: 10%" class="th">مديرية</th>
									<td style="width: 20%">{!!$death_statements->directorate->na_dire!!}</td>
									<th style="width: 10%" class="th">المركز</th>
									<td style="width: 20%">{!!$death_statements->center->na_center!!}</td>
								</tr>
							</thead>
							<tbody>
								<tr class="text-center tr">
									<th colspan="6">بيانات المتوفي</th>
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
									<th class="th">اسم المتوفي بالكامل</th>
									<td>{!!$death_statements->common_data->req_fore_na!!}</td>
									<td>{{$death_statements->common_data->req_second_na}}</td>
									<td>{{$death_statements->common_data->req_third_na}}</td>
									<td>{{$death_statements->common_data->req_tit}}</td>
									@if ($death_statements->common_data->gender == 1)
										<td>ذكر</td>
									@else
										<td>انثى</td>
									@endif
								</tr>
								<tr>
									<th class="th">اسم الام</th>
									<td>{{$death_statements->common_data->mother_fore_na}}</td>
									<td>{{$death_statements->common_data->mother_second_na}}</td>
									<td>{{$death_statements->common_data->mother_third_na}}</td>
									<td>{{$death_statements->common_data->mother_tit}}</td>
								</tr>
								<tr>
									<td class="th">تاريخ الوفاة</td>
									<td>{{$death_statements->date_death}}</td>
									<td class="th">نوع البطاقة</td>
									<td>{{$death_statements->ty_document->na_ty_doc}}</td>
								</tr>
								<tr>
									<td class="th">رقم البطاقة</td>
									<td>{{$death_statements->card_No_decea}}</td>
									<td class="th"> تاريخ اصدار البطاقة</td>
									<td>{{$death_statements->date_card_issuance_dec}}</td>
									<td class="th"> جهة اصدار البطاقة</td>
									<td>{{$death_statements->card_version_center->na_center}}</td>
								</tr>
							</tbody>
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