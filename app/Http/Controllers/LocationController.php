<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Directorate;
use Illuminate\Http\Request;
use App\Models\CardVersionCenter;
use App\Models\CountrieNationalit;

class LocationController extends Controller
{
    // استرداد كل الدول
    public function index()
    {
        $countries = CountrieNationalit::pluck('countrie_na', 'id');
        return response()->json($countries);
    }
    
    // استرداد كل المحافظات
    public function indexprovince()
    {
        $province = Province::pluck('na_prov', 'id');
        return response()->json($province);
    }
    
    
    // استرداد المحافظات المرتبطة بدولة الإقامة المحددة
    public function getGovernoratesByCountry(Request $request)
    {
        $province = Province::where('countrie_nationalit_id', $request->countrie_accom_id)
        ->pluck('na_prov', 'id');
        return response()->json($province);
    }
    
    // استرداد المحافظات المرتبطة بدولة الميلاد المحددة
    public function getProvincesByCountryBirth(Request $request)
    {
        $province = Province::where('countrie_nationalit_id', $request->countrie_birth_id)
                                    ->pluck('na_prov', 'id');
        return response()->json($province);
    }

    // استرداد المديريات المرتبطة بمحافظة الحجز المحددة
    public function getDirectoratesByGovernorate(Request $request)
    {
        $directorates = Directorate::where('province_id', $request->province_id)
        ->pluck('na_dire', 'id');
        return response()->json($directorates);
    }
    
    // استرداد المديريات المرتبطة بمحافظة الميلاد المحددة
    public function getDirectoratesByProvinceBirth(Request $request)
    {
        $directorates = Directorate::where('province_id', $request->province_birth_id)
                                    ->pluck('na_dire', 'id');
        return response()->json($directorates);
    }

    //  استرداد المديريات المرتبطة بمحافظة الإقامة المحددة  
    public function getDirectoratesByProvinceAccom(Request $request)
    {
        $directorates = Directorate::where('province_id', $request->province_accom_id)
                                    ->pluck('na_dire', 'id');
        return response()->json($directorates);
    }

    // استرداد المراكز المرتبطة بمديرية الحجز المحددة
    public function getCentersByDirectorate(Request $request)
    {
        $centers = CardVersionCenter::where('directorate_id', $request->directorate_id)
                            ->pluck('na_center', 'id');
        return response()->json($centers);
    }
    // استرداد المديريات المرتبطة بمحافظة الحجز المحددة
    public function getDirectoratesByGovernorateVersion(Request $request)
    {
        $directorates = Directorate::where('province_id', $request->province_version_card_id)
        ->pluck('na_dire', 'id');
        return response()->json($directorates);
    }
     // استرداد المراكز المرتبطة بمديرية الحجز المحددة
     public function getCentersByDirectorateVersion(Request $request)
     {
         $centers = CardVersionCenter::where('directorate_id', $request->directorate_version_card_id)
                             ->pluck('na_center', 'id');
         return response()->json($centers);
     }
}
