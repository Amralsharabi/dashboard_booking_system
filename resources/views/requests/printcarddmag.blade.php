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
										{{-- <td style="width: 10%">{!!$id!!}</td> --}}
									</tr>
									<tr>
										<th style="width: 10%" class="th">محافظة</th>
										<td style="width: 20%">{!!$CardDamageRenewal->province->na_prov!!}</td>
										<th style="width: 10%" class="th">مديرية</th>
										<td style="width: 20%">{!!$CardDamageRenewal->directorate->na_dire!!}</td>
										<th style="width: 10%" class="th">المركز</th>
										<td style="width: 20%">{!!$CardDamageRenewal->center->na_center!!}</td>
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
							</tr>
							  <tr class="text-center tr">
								  <th colspan="6">مكان اصدار البطاقة</th>
								</tr>
								<tr>
									<td class="th">المحافظة</td>
									<td>{{$CardDamageRenewal->provinceversioncardid->na_prov}}</td>
									<td class="th">  المديرية</td>
									<td>{{$CardDamageRenewal->directorateversioncardid->directorate}}</td>
									<td class="th">  المركز</td>
									<td>{{$CardDamageRenewal->cardversioncenterid->na_center}}</td>
								</tr>
								<tr>
									<th class="th">الرقم الوطني</th>
									<td colspan="2">{{$common_data->id_card}}</td>
									<td class="th">نوع الطلب </td>
									<td colspan="2">{{$CardDamageRenewal->req_type}}</td>
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