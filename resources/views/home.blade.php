@extends('layouts.master')
@section('title')
    لوحة التحكم-نظام الحجز الإلكتروني لمصلحة الأحوال المدنية
@endsection
@section('css')
<!--  Owl-carousel css-->
<link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
{!! $chartJs !!}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            {{-- <div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
						  <p class="mg-b-0">Sales monitoring dashboard template.</p>
						</div> --}}
        </div>
        {{-- <div class="main-dashboard-header-right">
						<div>
							<label class="tx-13">Customer Ratings</label>
							<div class="main-star">
								<i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(14,873)</span>
							</div>
						</div>
						<div>
							<label class="tx-13">Online Sales</label>
							<h5>563,275</h5>
						</div>
						<div>
							<label class="tx-13">Offline Sales</label>
							<h5>783,675</h5>
						</div>
					</div> --}}
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">طلبات البطاقة الشخصية </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{-- {{ $CardPersonaNews + $CardPersonaNewst }} --}}
                                </h4>
                            </div>
                            {{-- <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> +427</span>
										</span> --}}
                        </div>
                    </div>
                </div>
                {{-- <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span> --}}
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">طلبات البطاقة العائلية</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                {{-- <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$FamilyCards}}</h4> --}}
                                {{-- <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $FamilyCards + $FamilyCardst }}</h4> --}}
                                {{-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> --}}
                            </div>
                            {{-- <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> -23.09%</span>
										</span> --}}
                        </div>
                    </div>
                </div>
                {{-- <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span> --}}
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">طلبات قيد وشهادة ميلاد</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{-- {{ $BirthRestrictions + $BirthRestrictionst }}</h4> --}}
                                {{-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> --}}
                            </div>
                            {{-- <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> 52.09%</span>
										</span> --}}
                        </div>
                    </div>
                </div>
                {{-- <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span> --}}
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">طلبات قيد زواج</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                {{-- <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $LogMarriages + $LogMarriagest }}</h4> --}}
                                {{-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> --}}
                            </div>
                            {{-- <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> -152.3</span>
										</span> --}}
                        </div>
                    </div>
                </div>
                {{-- <span id="compositeline4" class="pt-1">5,9,5,6,4,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span> --}}
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">طلبات قيد طلاق</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                {{-- <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $LogDivorces + $LogDivorcest }}</h4> --}}
                                {{-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> --}}
                            </div>
                            {{-- <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> -152.3</span>
										</span> --}}
                        </div>
                    </div>
                </div>
                {{-- <span class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12<canvas width="214" height="30" style="display: inline-block; width: 214px; height: 30px; vertical-align: top;"></canvas></span> --}}
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">طلبات شهادة وفاة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
									{{-- @foreach ($monthlyRequests as $month => $total)
										<p>Month: {{ $month }}, Total Requests: {{ $total }}</p>
									@endforeach --}}
                                    {{-- {{ $DeathStatements + $DeathStatementst }} --}}
                                </h4>
                                {{-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> --}}
                            </div>
                            {{-- <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> 52.09%</span>
										</span> --}}
                        </div>
                    </div>
                </div>
                {{-- <span id="compositeline" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span> --}}
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">تقرير سنوي</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 text-muted mb-0">عرض مستوى الطلبات خلال سنة كاملة</p>
                </div>
                <div class="card-body">
                    <canvas id="myChart2"></canvas>
					{{-- {!! $chartJsCode2 !!} --}}
					{{-- {!! $chartjs->render() !!} --}}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-5">
            <div class="card card-dashboard-map-one">
                <label class="main-content-label">تقرير احصائي للطلبات</label>
                <span class="d-block mg-b-20 text-muted tx-12">رسم بياني يعرض كمية جميع الطلبات</span>
                <div class="">
					<canvas id="myChart"></canvas>
					{!! $chartJsCode !!}
				</div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- /row -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
	{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
	{{-- {!! $chartJs !!} --}}
{{-- <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'My Dataset',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script> --}}

<script>
    // استدعاء البيانات الخاصة بالتقرير السنوي
    var data = {
        labels: ['يناير', 'فبرير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسمبر'],
        datasets: [{
            label: 'عدد الطلبات',
            data: {!! json_encode($chartData) !!},
            backgroundColor: [
                'rgb(54, 162, 235, 0.7)',
                'rgb(255, 99, 132, 0.7)',
                'rgb(255, 205, 86, 0.7)',
                'rgb(75, 192, 192, 0.7)',
                'rgb(153, 102, 255, 0.7)',
                'rgb(255, 159, 64, 0.7)',
                'rgb(54, 162, 235, 0.7)',
                'rgb(255, 99, 132, 0.7)',
                'rgb(255, 205, 86, 0.7)',
                'rgb(75, 192, 192, 0.7)',
                'rgb(153, 102, 255, 0.7)',
                'rgb(255, 159, 64, 0.7)'
            ],
            hoverOffset: 4,
        }]
    };

    // إنشاء الرسم البياني الشريطي
    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
{{-- <script>
    // استدعاء البيانات الخاصة بالتقرير السنوي
    var data = {
        labels: [ @foreach ($monthlyRequests as $month => $total)
                '{{ $month }}',
            @endforeach],
        datasets: [{
            label: 'عدد الطلبات',
            data: {!! json_encode($chartData) !!},
            backgroundColor: 'rgb(54, 162, 235)',
            hoverOffset: 4
        }]
    };

    // إنشاء الرسم البياني الخطي
    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script> --}}
@endsection
