<?php

namespace App\Http\Controllers;

use App\Models\BirthRestriction;
use App\Models\FamilyCard;
use Illuminate\Http\Request;
use App\Models\CardPersonaNew;
use App\Models\CardDamageRenewal;
use App\Models\DeathStatement;
use App\Models\LogDivorce;
use App\Models\LogMarriage;

use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // $chartjs = app()->chartjs
        // ->name('barChartTest')
        // ->type('bar')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['طلبات تم تحديد موعد الحضور', 'طلبات ملغية'])
        // ->datasets([
        //     [
        //         "label" => "نسبة الطلبات الملغية",
        //         'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
        //         'data' => [69, 59]
        //     ],
        //     [
        //         "label" => "تسبة الطلبات تم تحديد موعد الحضور",
        //         'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],
        //         'data' => [65, 12]
        //     ]
        // ])
        // ->options([]);
        public function index()
    {
        // $CardPersonaNewsok = CardPersonaNew::where('request_statu_id',1);
        $cardPersonaNewsProcessing = CardPersonaNew::where('request_statu_id', 1)->count();
        $cardPersonaNewsOk = CardPersonaNew::where('request_statu_id', 2)->count();
        $cardPersonaNewsCanceled = CardPersonaNew::onlyTrashed()->count();

        $familyCardProcessing = FamilyCard::where('request_statu_id', 1)->count();
        $familyCardOk = FamilyCard::where('request_statu_id', 2)->count();
        $familyCardCanceled = FamilyCard::onlyTrashed()->count();

        $monthlyRequests = CardPersonaNew::selectRaw('MONTH(created_at) AS month, COUNT(*) AS total')
    ->withTrashed() // تشمل الصفوف المحذوفة أيضًا
    ->groupBy('month')
    ->pluck('total', 'month');
        
        // $CardPersonaNews = CardPersonaNew::count();
        // $CardPersonaNewst = CardPersonaNew::onlyTrashed()->count();
        // $FamilyCards = FamilyCard::count();
        // $FamilyCardst = FamilyCard::onlyTrashed()->count();
        // $BirthRestrictions = BirthRestriction::count();
        // $BirthRestrictionst = BirthRestriction::onlyTrashed()->count();
        // $LogMarriages = LogMarriage::count();
        // $LogMarriagest = LogMarriage::onlyTrashed()->count();
        // $LogDivorces = LogDivorce::count();
        // $LogDivorcest = LogDivorce::onlyTrashed()->count();
        // $DeathStatements = DeathStatement::count();
        // $DeathStatementst = DeathStatement::onlyTrashed()->count();
        // $CardDamageRenewals = CardDamageRenewal::count();
        
        $chartJs = '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';

        // بيانات الرسم البياني
        $labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
        $data = [12, 19, 3, 5, 2, 3];
        $backgroundColor = 'rgba(255, 99, 132, 0.2)';
        $borderColor = 'rgba(255, 99, 132, 1)';
        $aa= 50;
        // بناء كود الرسم البياني
        $chartJsCode = "
        <script>
        // استدعاء البيانات الخاصة بالرسم البياني
        var data = {
            labels: ['الطلبات الملغية', 'تم تحديد موعد الحضور', 'قيد المعالجة'],
            datasets: [{
                label: 'عدد الطلبات',
                data: [$cardPersonaNewsCanceled+$familyCardCanceled, $cardPersonaNewsOk+$familyCardOk, $cardPersonaNewsProcessing+$familyCardProcessing],
                backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'],
                hoverOffset: 4
            }]
        };
    
        // إنشاء الرسم البياني الدائري
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: data
        });
    </script>
        ";
        
        // return view('home',compact(
        //     'CardPersonaNews',
        //     'FamilyCards',
        //     'FamilyCardst',
        //     'CardDamageRenewals',
        //     'CardPersonaNewst',
        //     'BirthRestrictions',
        //     'BirthRestrictionst',
        //     'LogMarriages',
        //     'LogMarriagest',
        //     'LogDivorces',
        //     'LogDivorcest',
        //     'DeathStatements',
        //     'DeathStatementst',
        // ));

        $chartData = [];
        foreach ($monthlyRequests as $month => $total) {
            $chartData[] = $total;
        }
    //     $chartJsCode2 = "
    //     <script>
    //     // استدعاء البيانات الخاصة بالتقرير السنوي
    //     var data = {
    //         labels: ['يناير', 'فبرير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسمبر'],
    //         datasets: [{
    //             label: 'عدد الطلبات',
    //             data: [
    //                 json_encode($chartData)
    //             ],
    //             backgroundColor: 'rgb(54, 162, 235)',
    //             hoverOffset: 4
    //         }]
    //     };
    
    //     // إنشاء الرسم البياني الخطي
    //     var ctx = document.getElementById('myChart2').getContext('2d');
    //     var myChart = new Chart(ctx, {
    //         type: 'line',
    //         data: data,
    //         options: {
    //             scales: {
    //                 y: {
    //                     beginAtZero: true
    //                 }
    //             }
    //         }
    //     });
    // </script>";

        return view('home', compact('chartJs', 'chartJsCode','monthlyRequests','chartData'));

    }// return view('home', compact('chartjs'));

        
}
