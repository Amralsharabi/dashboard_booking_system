<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\TestMaile;
use App\Models\LogDivorce;
use App\Models\LogMarriage;
use Illuminate\Http\Request;
use App\Models\DeathStatement;
use App\Models\BirthRestriction;
use Illuminate\Support\Facades\Mail;
use App\Models\CorrectionInstRevConstr;

class RequestsRestrictionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $BirthRestrictions = BirthRestriction::all()->whereNull('time_attendees');
        $LogMarriages = LogMarriage::all()->whereNull('time_attendees');
        $LogDivorces = LogDivorce::all()->whereNull('time_attendees');
        $DeathStatements = DeathStatement::all()->whereNull('time_attendees');
        $CorrectionInstRevConstrs = CorrectionInstRevConstr::all()->whereNull('time_attendees');
        return view('requests.requests_restrictions',compact(
            'BirthRestrictions',
            'LogMarriages',
            'LogDivorces',
            'DeathStatements',
            'CorrectionInstRevConstrs',
        ));
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
    public function update(Request $request, $id)
    {
        
        $id = decrypt($request->input('id'));
        $BirthRestriction_update = BirthRestriction::find($id);
        $LogMarriage_update = LogMarriage::find($id);
        $LogDivorce_update = LogDivorce::find($id);
        $DeathStatement_update = DeathStatement::find($id);
        $CorrectionInstRevConstr_update = CorrectionInstRevConstr::find($id);
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
            return redirect('/requests/restrictions')->with('holiday', 'لايمكن ان تختار يوم الجمعة اختار يوماً اخر');
        }elseif ($dateGregorian->isThursday()) {
            return redirect('/requests/restrictions')->with('holiday', 'لايمكن ان تختار يوم الخميس اختار يوماً اخر');
        }elseif ($dateGregorian->day == 1 && $dateGregorian->month == 5) {
            return redirect('/requests/restrictions')->with('holiday', 'لايمكن ان تختار يوم 1 مايو إجازة رسمية اختار يوماً اخر');
        }elseif ($dateGregorian->day == 22 && $dateGregorian->month == 5) {
            return redirect('/requests/restrictions')->with('holiday', 'لايمكن ان تختار يوم 22 مايو إجازة رسمية اختار يوماً اخر');
        }elseif ($dateGregorian->day == 26 && $dateGregorian->month == 9) {
            return redirect('/requests/restrictions')->with('holiday', 'لايمكن ان تختار يوم 26 سبتمبر إجازة رسمية اختار يوماً اخر');
        }elseif ($dateGregorian->day == 14 && $dateGregorian->month == 10) {
            return redirect('/requests/restrictions')->with('holiday', 'لايمكن ان تختار يوم 14 أكتوبر إجازة رسمية اختار يوماً اخر');
        }elseif ($dateHijri->day == 1 && $dateHijri->month == 1) {
            return redirect('/requests/restrictions')->with('holiday', 'يصادف هذا اليوم 1 محرم سنة هجرية جديدة إجازة رسمية اختار يوماً اخر');
        }elseif ($dateHijri->day == 12 && $dateHijri->month == 3) {
            return redirect('/requests/restrictions')->with('holiday', 'يصادف هذا اليوم 12 ربيع أول مولد النبي إجازة رسمية اختار يوماً اخر');
        }elseif ($dateHijri->day >= 27 && $dateHijri->month == 9 || $dateHijri->day <= 7 && $dateHijri->month == 10) {
            return redirect('/requests/restrictions')->with('holiday', 'يصادف هذا اليوم إجازة عيد الفطر المبارك.. تستمر الإجازة الى 7 شول اختار يوماً اخر');
        }elseif ($dateHijri->day == 8 && $dateHijri->month == 12 || $dateHijri->day == 9 && $dateHijri->month == 12 || $dateHijri->day == 10 && $dateHijri->month == 12 || $dateHijri->day == 11 && $dateHijri->month == 12 || $dateHijri->day == 12 && $dateHijri->month == 12 || $dateHijri->day == 13 && $dateHijri->month == 12 || $dateHijri->day == 14 && $dateHijri->month == 12 || $dateHijri->day == 15 && $dateHijri->month == 12 || $dateHijri->day == 16 && $dateHijri->month == 12) {
            return redirect('/requests/restrictions')->with('holiday', 'يصادف هذا اليوم إجازة عيد الأضحى المبارك.. تستمر الإجازة الى 16 ذوالحجة اختار يوماً اخر');
        }elseif ($request->time_attendees < now()->format('Y-m-d')) {
            return redirect('/requests/restrictions')->with('holiday', ' لايمكن ان تختار يوم قد مضى');
        }else{

            // //////////////////////////////
            if ($request->typecard == 4) {
                $BirthRestrictions = BirthRestriction::where('time_attendees', $request->time_attendees)->where('center_id', $request->center_id)->groupBy('time_attendees')->selectRaw('count(*) as count')->get();
                foreach ($BirthRestrictions as $BirthRestriction) {
                    if ($BirthRestriction->count < 2) {
                        $BirthRestriction_update->update([
                            'time_attendees' => $request->time_attendees,
                            'time_attendees_hijri' => $request->time_attendees_hijri,
                            'request_statu_id' =>  2,
                        ]);
                        $time_attendees = request('time_attendees').'طلب قيد ميلاد - رقم الطلب:'.$id;
                        $email = User::find($BirthRestriction_update->common_data->user_id)->email;
                        Mail::to($email)->send(new TestMaile($time_attendees));
                        return redirect('/requests/restrictions')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
                        
                    } else {
                        return redirect('/requests/restrictions')->with('time_attendees_no', '('.$BirthRestriction_update->center->na_center.') يوم ('.$request->time_attendees.')');
                    }
                }
                $BirthRestriction_update->update([
                    'time_attendees' => $request->time_attendees,
                    'time_attendees_hijri' => $request->time_attendees_hijri,
                    'request_statu_id' =>  2,
                ]);
                $time_attendees = request('time_attendees').'طلب قيد ميلاد - رقم الطلب:'.$id;
                $email = User::find($BirthRestriction_update->common_data->user_id)->email;
                Mail::to($email)->send(new TestMaile($time_attendees));
                return redirect('/requests/restrictions')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
            }

            // //////////////////////////////
            if ($request->typecard == 5) {
                $LogMarriages = LogMarriage::where('time_attendees', $request->time_attendees)->where('center_id', $request->center_id)->groupBy('time_attendees')->selectRaw('count(*) as count')->get();
                foreach ($LogMarriages as $LogMarriage) {
                    if ($LogMarriage->count < 2) {
                        $LogMarriage_update->update([
                            'time_attendees' => $request->time_attendees,
                            'time_attendees_hijri' => $request->time_attendees_hijri,
                            'request_statu_id' =>  2,
                        ]);
                        $time_attendees = request('time_attendees').'طلب قيد زواج - رقم الطلب:'.$id;
                        $email = User::where('id',$LogMarriage_update->user_id)->first()->email;
                        Mail::to($email)->send(new TestMaile($time_attendees));
                        return redirect('/requests/restrictions')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
                        
                    } else {
                        return redirect('/requests/restrictions')->with('time_attendees_no', '('.$LogMarriage_update->center->na_center.') يوم ('.$request->time_attendees.')');
                    }
                }
                $LogMarriage_update->update([
                    'time_attendees' => $request->time_attendees,
                    'time_attendees_hijri' => $request->time_attendees_hijri,
                    'request_statu_id' =>  2,
                ]);
                $time_attendees = request('time_attendees').'طلب قيد زواج - رقم الطلب:'.$id;
                $email = User::find($LogMarriage_update->common_data->user_id)->email;
                Mail::to($email)->send(new TestMaile($time_attendees));
                return redirect('/requests/restrictions')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
            }

            // //////////////////////////////
            if ($request->typecard == 6) {
                $LogDivorces = LogDivorce::where('time_attendees', $request->time_attendees)->where('center_id', $request->center_id)->groupBy('time_attendees')->selectRaw('count(*) as count')->get();
                foreach ($LogDivorces as $LogDivorce) {
                    if ($LogDivorce->count < 2) {
                        $LogDivorce_update->update([
                            'time_attendees' => $request->time_attendees,
                            'time_attendees_hijri' => $request->time_attendees_hijri,
                            'request_statu_id' =>  2,
                        ]);
                        $time_attendees = request('time_attendees').'طلب قيد طلاق - رقم الطلب:'.$id;
                        $email = User::where('id',$LogDivorce_update->user_id)->first()->email;
                        Mail::to($email)->send(new TestMaile($time_attendees));
                        return redirect('/requests/restrictions')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
                        
                    } else {
                        return redirect('/requests/restrictions')->with('time_attendees_no', '('.$LogDivorce_update->center->na_center.') يوم ('.$request->time_attendees.')');
                    }
                }
                $LogDivorce_update->update([
                    'time_attendees' => $request->time_attendees,
                    'time_attendees_hijri' => $request->time_attendees_hijri,
                    'request_statu_id' =>  2,
                ]);
                $time_attendees = request('time_attendees').'طلب قيد طلاق - رقم الطلب:'.$id;
                $email = User::where('id',$LogDivorce_update->user_id)->first()->email;
                Mail::to($email)->send(new TestMaile($time_attendees));
                return redirect('/requests/restrictions')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
            }

            // //////////////////////////////
            if ($request->typecard == 7) {
                $DeathStatements = DeathStatement::where('time_attendees', $request->time_attendees)->where('center_id', $request->center_id)->groupBy('time_attendees')->selectRaw('count(*) as count')->get();
                foreach ($DeathStatements as $DeathStatement) {
                    if ($DeathStatement->count < 2) {
                        $DeathStatement_update->update([
                            'time_attendees' => $request->time_attendees,
                            'time_attendees_hijri' => $request->time_attendees_hijri,
                            'request_statu_id' =>  2,
                        ]);
                        $time_attendees = request('time_attendees').'طلب شهادة وفاة - رقم الطلب:'.$id;
                        $email = User::find($DeathStatement_update->common_data->user_id)->email;
                        Mail::to($email)->send(new TestMaile($time_attendees));
                        return redirect('/requests/restrictions')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
                        
                    } else {
                        return redirect('/requests/restrictions')->with('time_attendees_no', '('.$DeathStatement_update->center->na_center.') يوم ('.$request->time_attendees.')');
                    }
                }
                $DeathStatement_update->update([
                    'time_attendees' => $request->time_attendees,
                    'time_attendees_hijri' => $request->time_attendees_hijri,
                    'request_statu_id' =>  2,
                ]);
                $time_attendees = request('time_attendees').'طلب شهادة وفاة - رقم الطلب:'.$id;
                $email = User::find($DeathStatement_update->common_data->user_id)->email;
                Mail::to($email)->send(new TestMaile($time_attendees));
                return redirect('/requests/restrictions')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
            }

            // //////////////////////////////
            if ($request->typecard == 8) {
                $CorrectionInstRevConstrs = CorrectionInstRevConstr::where('time_attendees', $request->time_attendees)->where('center_id', $request->center_id)->groupBy('time_attendees')->selectRaw('count(*) as count')->get();
                foreach ($CorrectionInstRevConstrs as $CorrectionInstRevConstr) {
                    if ($CorrectionInstRevConstr->count < 2) {
                        $CorrectionInstRevConstr_update->update([
                            'time_attendees' => $request->time_attendees,
                            'time_attendees_hijri' => $request->time_attendees_hijri,
                            'request_statu_id' =>  2,
                        ]);
                        $time_attendees = request('time_attendees').'طلب تصحيح او تثبيت او ابطال قيد  - رقم الطلب:'.$id;
                        $email = User::find($CorrectionInstRevConstr_update->common_data->user_id)->email;
                        Mail::to($email)->send(new TestMaile($time_attendees));
                        return redirect('/requests/restrictions')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
                        
                    } else {
                        return redirect('/requests/restrictions')->with('time_attendees_no', '('.$CorrectionInstRevConstr_update->center->na_center.') يوم ('.$request->time_attendees.')');
                    }
                }
                $CorrectionInstRevConstr_update->update([
                    'time_attendees' => $request->time_attendees,
                    'time_attendees_hijri' => $request->time_attendees_hijri,
                    'request_statu_id' =>  2,
                ]);
                $time_attendees = request('time_attendees').'طلب تصحيح او تثبيت او ابطال قيد - رقم الطلب:'.$id;
                $email = User::find($CorrectionInstRevConstr_update->common_data->user_id)->email;
                Mail::to($email)->send(new TestMaile($time_attendees));
                return redirect('/requests/restrictions')->with('time_attendees', 'تم تحديد موعد الحضور بنجاح');
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
