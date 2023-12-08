<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\TestMaile;
use App\Models\BirthRestriction;
use App\Models\FamilyCard;
use Illuminate\Http\Request;
use App\Models\CardPersonaNew;
use App\Models\CardDamageRenewal;
use App\Models\CorrectionInstRevConstr;
use App\Models\DeathStatement;
use App\Models\LogDivorce;
use App\Models\LogMarriage;
use Illuminate\Support\Facades\Mail;

class RequestsCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CardPersonaNews = CardPersonaNew::all()->whereNull('time_attendees');
        $FamilyCards = FamilyCard::all()->whereNull('time_attendees');
        $CardDamageRenewals = CardDamageRenewal::all()->whereNull('time_attendees');
        return view('requests.requests_cards',compact('CardPersonaNews','FamilyCards','CardDamageRenewals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $id = decrypt($request->input('id'));
        $CardPersonaNew_update = CardPersonaNew::find($id);
        $CardDamageRenewal_update = CardDamageRenewal::find($id);
        $FamilyCard_update = FamilyCard::find($id);
        
        $this->validate($request,[
            'time_attendees' => 'required|date',
            // 'time_attendees_hijri' => 'required',
        ],[
            'time_attendees.required' => 'خطاء يرجى  ادخال تاريخ الموعد',
            'time_attendees_hijri.required' => ' خطاء يرجى  ادخال تاريخ الموعد الهجري',
        ]);
        $dateGregorian = Carbon::parse($request->input('time_attendees'));
        $dateHijri = Carbon::parse($request->input('time_attendees_hijri'));
        if ($dateGregorian->isFriday()) {
            return redirect('/requests/cards')->with('holiday', 'لايمكن ان تختار يوم الجمعة اختار يوماً اخر');
        }elseif ($dateGregorian->isThursday()) {
            return redirect('/requests/cards')->with('holiday', 'لايمكن ان تختار يوم الخميس اختار يوماً اخر');
        }elseif ($dateGregorian->day == 1 && $dateGregorian->month == 5) {
            return redirect('/requests/cards')->with('holiday', 'لايمكن ان تختار يوم 1 مايو إجازة رسمية اختار يوماً اخر');
        }elseif ($dateGregorian->day == 22 && $dateGregorian->month == 5) {
            return redirect('/requests/cards')->with('holiday', 'لايمكن ان تختار يوم 22 مايو إجازة رسمية اختار يوماً اخر');
        }elseif ($dateGregorian->day == 26 && $dateGregorian->month == 9) {
            return redirect('/requests/cards')->with('holiday', 'لايمكن ان تختار يوم 26 سبتمبر إجازة رسمية اختار يوماً اخر');
        }elseif ($dateGregorian->day == 14 && $dateGregorian->month == 10) {
            return redirect('/requests/cards')->with('holiday', 'لايمكن ان تختار يوم 14 أكتوبر إجازة رسمية اختار يوماً اخر');
        }elseif ($dateHijri->day == 1 && $dateHijri->month == 1) {
            return redirect('/requests/cards')->with('holiday', 'يصادف هذا اليوم 1 محرم سنة هجرية جديدة إجازة رسمية اختار يوماً اخر');
        }elseif ($dateHijri->day == 12 && $dateHijri->month == 3) {
            return redirect('/requests/cards')->with('holiday', 'يصادف هذا اليوم 12 ربيع أول مولد النبي إجازة رسمية اختار يوماً اخر');
        }elseif ($dateHijri->day >= 27 && $dateHijri->month == 9 || $dateHijri->day <= 7 && $dateHijri->month == 10) {
            return redirect('/requests/cards')->with('holiday', 'يصادف هذا اليوم إجازة عيد الفطر المبارك.. تستمر الإجازة الى 7 شول اختار يوماً اخر');
        }elseif ($dateHijri->day == 8 && $dateHijri->month == 12 || $dateHijri->day == 9 && $dateHijri->month == 12 || $dateHijri->day == 10 && $dateHijri->month == 12 || $dateHijri->day == 11 && $dateHijri->month == 12 || $dateHijri->day == 12 && $dateHijri->month == 12 || $dateHijri->day == 13 && $dateHijri->month == 12 || $dateHijri->day == 14 && $dateHijri->month == 12 || $dateHijri->day == 15 && $dateHijri->month == 12 || $dateHijri->day == 16 && $dateHijri->month == 12) {
            return redirect('/requests/cards')->with('holiday', 'يصادف هذا اليوم إجازة عيد الأضحى المبارك.. تستمر الإجازة الى 16 ذوالحجة اختار يوماً اخر');
        }elseif ($request->time_attendees < now()->format('Y-m-d')) {
            return redirect('/requests/cards')->with('holiday', ' لايمكن ان تختار يوم قد مضى');
        }else{
            /////////////////////////
            if ($request->typecard == 1) {
                $CardPersonaNews = CardPersonaNew::where('time_attendees', $request->time_attendees)->where('center_id', $request->center_id)->groupBy('time_attendees')->selectRaw('count(*) as count')->get();
                foreach ($CardPersonaNews as $CardPersonaNew) {
                    if ($CardPersonaNew->count < 2) {
                        $CardPersonaNew_update->update([
                            'time_attendees' => $request->time_attendees,
                            'time_attendees_hijri' => $request->time_attendees_hijri,
                            'request_statu_id' =>  2,
                        ]);
                        $time_attendees = request('time_attendees').'طلب بطاقة شخصية - رقم الطلب:'.$id;
                        $email = User::find($CardPersonaNew_update->common_data->user_id)->email;
                        Mail::to($email)->send(new TestMaile($time_attendees));
                        return redirect('/requests/cards')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
                        
                    } else {
                        return redirect('/requests/cards')->with('time_attendees_no', '('.$CardPersonaNew_update->center->na_center.') يوم ('.$request->time_attendees.')');
                    }
                }
                $CardPersonaNew_update->update([
                    'time_attendees' => $request->time_attendees,
                    'time_attendees_hijri' => $request->time_attendees_hijri,
                    'request_statu_id' =>  2,
                ]);
                $time_attendees = request('time_attendees').'طلب بطاقة شخصية - رقم الطلب:'.$id;
                $email = User::find($CardPersonaNew_update->common_data->user_id)->email;
                Mail::to($email)->send(new TestMaile($time_attendees));
                return redirect('/requests/cards')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
            }

            // //////////////////////////////
            if ($request->typecard == 2) {
                $FamilyCards = FamilyCard::where('time_attendees', $request->time_attendees)->where('center_id', $request->center_id)->groupBy('time_attendees')->selectRaw('count(*) as count')->get();
                foreach ($FamilyCards as $FamilyCard) {
                    if ($FamilyCard->count < 2) {
                        $FamilyCard_update->update([
                            'time_attendees' => $request->time_attendees,
                            'time_attendees_hijri' => $request->time_attendees_hijri,
                            'request_statu_id' =>  2,
                        ]);
                        $time_attendees = request('time_attendees').'طلب بطاقة عائلية - رقم الطلب:'.$id;
                        $email = User::find($FamilyCard_update->common_data->user_id)->email;
                        Mail::to($email)->send(new TestMaile($time_attendees));
                        return redirect('/requests/cards')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
                        
                    } else {
                        return redirect('/requests/cards')->with('time_attendees_no', '('.$FamilyCard_update->center->na_center.') يوم ('.$request->time_attendees.')');
                    }
                }
                $FamilyCard_update->update([
                    'time_attendees' => $request->time_attendees,
                    'time_attendees_hijri' => $request->time_attendees_hijri,
                    'request_statu_id' =>  2,
                ]);
                $time_attendees = request('time_attendees').'طلب بطاقة عائلية - رقم الطلب:'.$id;
                $email = User::find($FamilyCard_update->common_data->user_id)->email;
                Mail::to($email)->send(new TestMaile($time_attendees));
                return redirect('/requests/cards')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
            }
            
            ////////////
            if ($request->typecard == 3) {
                $CardDamageRenewals = CardDamageRenewal::where('time_attendees', $request->time_attendees)->where('center_id', $request->center_id)->groupBy('time_attendees')->selectRaw('count(*) as count')->get();
                foreach ($CardDamageRenewals as $CardDamageRenewal) {
                    if ($CardDamageRenewal->count < 2) {
                        $CardDamageRenewal_update->update([
                            'time_attendees' => $request->time_attendees,
                            'time_attendees_hijri' => $request->time_attendees_hijri,
                            'request_statu_id' =>  2,
                        ]);
                        $time_attendees = request('time_attendees').'طلب بطاقة شخصية - '.$CardDamageRenewal_update->req_type.' - رقم الطلب:'.$id;
                        $email = User::find($CardDamageRenewal_update->common_data->user_id)->email;
                        Mail::to($email)->send(new TestMaile($time_attendees));
                        return redirect('/requests/cards')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
                        
                    } else {
                        return redirect('/requests/cards')->with('time_attendees_no', '('.$CardPersonaNew_update->center->na_center.') يوم ('.$request->time_attendees.')');
                    }
                }
                $CardDamageRenewal_update->update([
                    'time_attendees' => $request->time_attendees,
                    'time_attendees_hijri' => $request->time_attendees_hijri,
                    'request_statu_id' =>  2,
                ]);
                $time_attendees = request('time_attendees').'طلب بطاقة شخصية - '.$CardDamageRenewal_update->req_type.' - رقم الطلب:'.$id;
                $email = User::find($CardDamageRenewal_update->common_data->user_id)->email;
                Mail::to($email)->send(new TestMaile($time_attendees));
                return redirect('/requests/cards')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
            } 
            return "خطاء نوع الطلب غير موجود";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
