<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\TestMaile;
use App\Models\CommonData;
use App\Models\DataWitnesse;
use Illuminate\Http\Request;
use App\Models\CardPersonaNew;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NewRequestsCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = DB::table('provinces')->get();
        $directorates = DB::table('directorates')->get();
        $blood_types = DB::table('blood_types')->get();
        $card_version_centers = DB::table('card_version_centers')->get();
        $countrie_nationalits = DB::table('countrie_nationalits')->get();
        $religions = DB::table('religions')->get();
        $social_status = DB::table('social_status')->get();
        $certificates = DB::table('certificates')->get();
        $specialties = DB::table('specialties')->get();
        $professions = DB::table('professions')->get();
        $jihat_works = DB::table('jihat_works')->get();
        $ty_documents = DB::table('ty_documents')->get();

        return view('requests.new_requests_cards', compact(
            'provinces',
            'directorates',
            'blood_types',
            'card_version_centers',
            'countrie_nationalits',
            'social_status',
            'certificates',
            'specialties',
            'professions',
            'jihat_works',
            'religions',
            'ty_documents',
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
        $this->validate($request,[
            'req_fore_na' => 'required|max:255',
            'req_second_na' => 'required|max:255',
            'req_third_na' => 'required|max:255',
            'req_tit' => 'required|max:255',
            'nationality_req_id' => 'required|max:255',
            'father_fore_na' => 'required|max:255',
            'father_second_na' => 'required|max:255',
            'father_third_na' => 'required|max:255',
            'father_tit' => 'required|max:255',
            'nationality_father_id' => 'required|max:255',
            'mother_fore_na' => 'required|max:255',
            'mother_second_na' => 'required|max:255',
            'mother_third_na' => 'required|max:255',
            'mother_tit' => 'required|max:255',
            'nationality_mother_id' => 'required|max:255',
            'gender' => 'required|max:255',
            'date_pirth_ad' => 'required|max:255',
            'date_pirth_he' => 'required|max:255',
            'countrie_birth_id' => 'required|max:255',
            'province_birth_id' => 'required|max:255',
            'directorate_pirth_id' => 'required|max:255',
            'village_parth' => 'required|max:255',
            'religions_id' => 'required|max:255',
            'time_attendees' => 'required|max:255',
            'time_attendees_hijri' => 'required|max:255',

        ],[
            'required'=> 'خطاء يرجى تعبئة كل الحقول',
        ]);
        // $req_fore_na = request('req_fore_na');
        // $req_second_na = request('req_second_na');
        // $req_third_na = request('req_third_na');
        // $req_tit = request('req_tit');
        // if (CommonData::where('req_fore_na', $req_fore_na)->where('req_second_na', $req_second_na)->where('req_third_na', $req_third_na)->where('req_tit', $req_tit)->where('id','!=',request('id'))->count() > 0) {
        //     // return back()->withInput()->withErrors(['message'=>'تم رفض  الطلب هناك نفس هذا الاسم بالفعل. ']);
        //     return back()->withErrors(['error'=>' تم رفض الطلب هناك نفس هذا الاسم بالفعل.']);
        // }else{
            
            
            
            $dateGregorian = Carbon::parse($request->input('time_attendees'));
            $dateHijri = Carbon::parse($request->input('time_attendees_hijri'));
            if ($dateGregorian->isFriday()) {
                return back()->withInput()->withErrors(['message'=>'لايمكن ان تختار يوم الجمعة اختار يوماً اخر']);
                return redirect('/newRequestsCards')->with('holiday');
            }elseif ($dateGregorian->isThursday()) {
                return redirect('/newRequestsCards')->with('holiday', 'لايمكن ان تختار يوم الخميس اختار يوماً اخر');
            }elseif ($dateGregorian->day == 1 && $dateGregorian->month == 5) {
                return redirect('/newRequestsCards')->with('holiday', 'لايمكن ان تختار يوم 1 مايو إجازة رسمية اختار يوماً اخر');
            }elseif ($dateGregorian->day == 22 && $dateGregorian->month == 5) {
                return redirect('/newRequestsCards')->with('holiday', 'لايمكن ان تختار يوم 22 مايو إجازة رسمية اختار يوماً اخر');
            }elseif ($dateGregorian->day == 26 && $dateGregorian->month == 9) {
                return redirect('/newRequestsCards')->with('holiday', 'لايمكن ان تختار يوم 26 سبتمبر إجازة رسمية اختار يوماً اخر');
            }elseif ($dateGregorian->day == 14 && $dateGregorian->month == 10) {
                return redirect('/newRequestsCards')->with('holiday', 'لايمكن ان تختار يوم 14 أكتوبر إجازة رسمية اختار يوماً اخر');
            }elseif ($dateHijri->day == 1 && $dateHijri->month == 1) {
                return redirect('/newRequestsCards')->with('holiday', 'يصادف هذا اليوم 1 محرم سنة هجرية جديدة إجازة رسمية اختار يوماً اخر');
            }elseif ($dateHijri->day == 12 && $dateHijri->month == 3) {
                return redirect('/newRequestsCards')->with('holiday', 'يصادف هذا اليوم 12 ربيع أول مولد النبي إجازة رسمية اختار يوماً اخر');
            }elseif ($dateHijri->day >= 27 && $dateHijri->month == 9 || $dateHijri->day <= 7 && $dateHijri->month == 10) {
                return redirect('/newRequestsCards')->with('holiday', 'يصادف هذا اليوم إجازة عيد الفطر المبارك.. تستمر الإجازة الى 7 شول اختار يوماً اخر');
            }elseif ($dateHijri->day == 8 && $dateHijri->month == 12 || $dateHijri->day == 9 && $dateHijri->month == 12 || $dateHijri->day == 10 && $dateHijri->month == 12 || $dateHijri->day == 11 && $dateHijri->month == 12 || $dateHijri->day == 12 && $dateHijri->month == 12 || $dateHijri->day == 13 && $dateHijri->month == 12 || $dateHijri->day == 14 && $dateHijri->month == 12 || $dateHijri->day == 15 && $dateHijri->month == 12 || $dateHijri->day == 16 && $dateHijri->month == 12) {
                return redirect('/newRequestsCards')->with('holiday', 'يصادف هذا اليوم إجازة عيد الأضحى المبارك.. تستمر الإجازة الى 16 ذوالحجة اختار يوماً اخر');
            }elseif ($request->time_attendees < now()->format('Y-m-d')) {
                return redirect('/newRequestsCards')->with('holiday', ' لايمكن ان تختار يوم قد مضى');
            }else{
                $user = User::find(request('user_id'))->cardpersonanew;
        if(CardPersonaNew::where('user_id', request('user_id'))->count()){
            $now = Carbon::now();
            $expiresAt = Carbon::parse($user->max('created_at'))->addDay();
            $diff = $now->diff($expiresAt);
            $remainingTime = $diff->invert ? '00:00:00' : $diff->format(' %H ساعة |%I دقيقة |%S ثانية');
            if($remainingTime == '00:00:00'){
                DB::beginTransaction();
                try {
                    
                    $user = User::find(request('user_id'))->commondata;
                    $card = new CardPersonaNew;
                    $card->user_id = request('user_id');
                    $card->common_data_id = request('id');
                    $card->province_id = request('province_id');
                    $card->directorate_id = request('directorate_id');
                    $card->center_id = request('center_id');
                    $card->blood_type_id = request('blood_type_id');
                    $card->request_statu_id = '2';
                    $card->time_attendees = request('time_attendees');
                    $card->time_attendees_hijri = request('time_attendees_hijri');
                    $card->save();

                    $user->req_fore_na = request('req_fore_na');
                    $user->req_second_na = request('req_second_na');
                    $user->req_third_na = request('req_third_na');
                    $user->req_tit = request('req_tit');
                    $user->nationality_req_id = request('nationality_req_id');
                    $user->father_fore_na = request('father_fore_na');
                    $user->father_second_na = request('father_second_na');
                    $user->father_third_na = request('father_third_na');
                    $user->father_tit = request('father_tit');
                    $user->nationality_father_id = request('nationality_father_id');
                    $user->mother_fore_na = request('mother_fore_na');
                    $user->mother_second_na = request('mother_second_na');
                    $user->mother_third_na = request('mother_third_na');
                    $user->mother_tit = request('mother_tit');
                    $user->nationality_mother_id = request('nationality_mother_id');
                    $user->gender = request('gender');
                    $user->date_pirth_ad = request('date_pirth_ad');
                    $user->date_pirth_he = request('date_pirth_he');
                    $user->countrie_birth_id = request('countrie_birth_id');
                    $user->province_birth_id = request('province_birth_id');
                    $user->directorate_pirth_id = request('directorate_pirth_id');
                    $user->village_parth = request('village_parth');
                    $user->religions_id = request('religions_id');
                    $user->social_statu_id = request('social_statu_id');
                    $user->learning_condition = request('learning_condition');
                    $user->certificate_id = request('certificate_id');
                    $user->specialtie_id = request('specialtie_id');
                    $user->jihat_work_id = request('jihat_work_id');
                    $user->profession_id = request('profession_id');
                    $user->countrie_accom_id = request('countrie_accom_id');
                    $user->province_accom_id = request('province_accom_id');
                    $user->directorate_accom_id = request('directorate_accom_id');
                    $user->village_accom = request('village_accom');
                    $user->neigh_accom = request('neigh_accom');
                    $user->street_accom = request('street_accom');
                    $user->house_accom = request('house_accom');
                    $user->num_phone = request('num_phone');
                    $user->save();

                    DataWitnesse::create([
                        'req_id'=>$card->id,
                        'request_type_id'=>'1',
                        'foreNa_witn'=>request('foreNa_witn'),
                        'secondNa_witn'=>request('secondNa_witn'),
                        'thirdNa_witn'=>request('thirdNa_witn'),
                        'tit_witn'=>request('tit_witn'),
                        'work_head_witn'=>request('work_head_witn'),
                        'jihat_work_id'=>request('jihat_work_id'),
                        'phone_witn'=>request('phone_witn'),
                        'ty_document_witn_id'=>request('ty_document_witn_id'),
                        'card_id'=>request('card_id'),
                        'card_version_center_id'=>request('card_version_center_id'),
                        'date_card_issuance'=>request('date_card_issuance'),
                        'address_witn'=>request('address_witn'),
                    ]);

                    DataWitnesse::create([
                        'req_id'=>$card->id,
                        'request_type_id'=>'1',
                        'foreNa_witn'=>request('foreNa_witn2'),
                        'secondNa_witn'=>request('secondNa_witn2'),
                        'thirdNa_witn'=>request('thirdNa_witn2'),
                        'tit_witn'=>request('tit_witn2'),
                        'work_head_witn'=>request('work_head_witn2'),
                        'jihat_work_id'=>request('jihat_work_id2'),
                        'phone_witn'=>request('phone_witn2'),
                        'ty_document_witn_id'=>request('ty_document_witn_id2'),
                        'card_id'=>request('card_id2'),
                        'card_version_center_id'=>request('card_version_center_id2'),
                        'date_card_issuance'=>request('date_card_issuance2'),
                        'address_witn'=>request('address_witn2'),
                    ]);
                    $time_attendees = request('time_attendees').'طلب بطاقة شخصية - رقم الطلب:'.$card->id;
                    $email = User::find(request('user_id'))->email;
                    Mail::to($email)->send(new TestMaile($time_attendees));
                    DB::commit();
                    return redirect()->route('newRequestsCards.index')->with('success', 'تمت عملية الحجز بنجاح');
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json([
                        'message' => 'An error occurred while processing your request. Please try again later.'
                    ], 500);
                }
            }
            return redirect()->route('newRequestsCards.index')->with('warning', " لقد قام هذا المستخدم بطلب بطاقة سخصية اليوم بالفعل يمكنه الطلب بعد:  $remainingTime");
        }
        // DB::beginTransaction();
        // try {
            
            $user = User::find(request('user_id'))->commondata;
            $card = new CardPersonaNew;
            $card->user_id = request('user_id');
            $card->common_data_id = request('id');
            $card->province_id = request('province_id');
            $card->directorate_id = request('directorate_id');
            $card->center_id = request('center_id');
            $card->blood_type_id = request('blood_type_id');
            $card->request_statu_id = '2';
            $card->time_attendees = request('time_attendees');
            $card->time_attendees_hijri = request('time_attendees_hijri');
            $card->save();

            $user->req_fore_na = request('req_fore_na');
            $user->req_second_na = request('req_second_na');
            $user->req_third_na = request('req_third_na');
            $user->req_tit = request('req_tit');
            $user->nationality_req_id = request('nationality_req_id');
            $user->father_fore_na = request('father_fore_na');
            $user->father_second_na = request('father_second_na');
            $user->father_third_na = request('father_third_na');
            $user->father_tit = request('father_tit');
            $user->nationality_father_id = request('nationality_father_id');
            $user->mother_fore_na = request('mother_fore_na');
            $user->mother_second_na = request('mother_second_na');
            $user->mother_third_na = request('mother_third_na');
            $user->mother_tit = request('mother_tit');
            $user->nationality_mother_id = request('nationality_mother_id');
            $user->gender = request('gender');
            $user->date_pirth_ad = request('date_pirth_ad');
            $user->date_pirth_he = request('date_pirth_he');
            $user->countrie_birth_id = request('countrie_birth_id');
            $user->province_birth_id = request('province_birth_id');
            $user->directorate_pirth_id = request('directorate_pirth_id');
            $user->village_parth = request('village_parth');
            $user->religions_id = request('religions_id');
            $user->social_statu_id = request('social_statu_id');
            $user->learning_condition = request('learning_condition');
            $user->certificate_id = request('certificate_id');
            $user->specialtie_id = request('specialtie_id');
            $user->jihat_work_id = request('jihat_work_id');
            $user->profession_id = request('profession_id');
            $user->countrie_accom_id = request('countrie_accom_id');
            $user->province_accom_id = request('province_accom_id');
            $user->directorate_accom_id = request('directorate_accom_id');
            $user->village_accom = request('village_accom');
            $user->neigh_accom = request('neigh_accom');
            $user->street_accom = request('street_accom');
            $user->house_accom = request('house_accom');
            $user->num_phone = request('num_phone');
            $user->save();

            DataWitnesse::create([
                'req_id'=>$card->id,
                'request_type_id'=>'1',
                'foreNa_witn'=>request('foreNa_witn'),
                'secondNa_witn'=>request('secondNa_witn'),
                'thirdNa_witn'=>request('thirdNa_witn'),
                'tit_witn'=>request('tit_witn'),
                'work_head_witn'=>request('work_head_witn'),
                'jihat_work_id'=>request('jihat_work_id'),
                'phone_witn'=>request('phone_witn'),
                'ty_document_witn_id'=>request('ty_document_witn_id'),
                'card_id'=>request('card_id'),
                'card_version_center_id'=>request('card_version_center_id'),
                'date_card_issuance'=>request('date_card_issuance'),
                'address_witn'=>request('address_witn'),
            ]);

            DataWitnesse::create([
                'req_id'=>$card->id,
                'request_type_id'=>'1',
                'foreNa_witn'=>request('foreNa_witn2'),
                'secondNa_witn'=>request('secondNa_witn2'),
                'thirdNa_witn'=>request('thirdNa_witn2'),
                'tit_witn'=>request('tit_witn2'),
                'work_head_witn'=>request('work_head_witn2'),
                'jihat_work_id'=>request('jihat_work_id2'),
                'phone_witn'=>request('phone_witn2'),
                'ty_document_witn_id'=>request('ty_document_witn_id2'),
                'card_id'=>request('card_id2'),
                'card_version_center_id'=>request('card_version_center_id2'),
                'date_card_issuance'=>request('date_card_issuance2'),
                'address_witn'=>request('address_witn2'),
            ]);
            $time_attendees = request('time_attendees').'طلب بطاقة شخصية - رقم الطلب:'.$card->id;
            $email = User::find(request('user_id'))->email;
            // Mail::to($email)->send(new TestMaile($time_attendees));
            // DB::commit();
            return redirect()->route('newRequestsCards.index')->with('success', 'تمت عملية الحجز بنجاح');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return response()->json([
        //         'message' => 'An error occurred while processing your request. Please try again later.'
        //     ], 500);
        // }
    }
    // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($encryptedId)
    {
        $id = decrypt($encryptedId);
        $provinces = DB::table('provinces')->get();
        $directorates = DB::table('directorates')->get();
        $blood_types = DB::table('blood_types')->get();
        $jihat_works = DB::table('jihat_works')->get();
        $ty_documents = DB::table('ty_documents')->get();
        $card_version_centers = DB::table('card_version_centers')->get();
        $social_status = DB::table('social_status')->get();
        $certificates = DB::table('certificates')->get();
        $specialties = DB::table('specialties')->get();
        $professions = DB::table('professions')->get();
        $countrie_nationalits = DB::table('countrie_nationalits')->get();
        $religionss = DB::table('religions')->get();
        
        $cardPersonaNew = CardPersonaNew::findOrFail($id);
        $common_data = CardPersonaNew::findOrFail($id)->common_data;
        $dataWitnesse = DataWitnesse::where('req_id',$cardPersonaNew->id)->first();
        $dataWitnesse2 = DataWitnesse::where('req_id',$cardPersonaNew->id)->skip(1)->take(1)->first();

        $jihat_work_w = $dataWitnesse->jihat_work->na_jihatw;
        $jihat_work_w_id = $dataWitnesse->jihat_work->id;
        $ty_document_witn = $dataWitnesse->tydocument->na_ty_doc;
        $ty_document_witn_id = $dataWitnesse->tydocument->id;
        $card_version_center_w = $dataWitnesse->cardversioncenter->na_center;
        $card_version_center_w_id = $dataWitnesse->cardversioncenter->id;
        
        $jihat_work_w2 = $dataWitnesse2->jihat_work->na_jihatw;
        $jihat_work_w_id2 = $dataWitnesse2->jihat_work->id;
        $ty_document_witn2 = $dataWitnesse2->tydocument->na_ty_doc;
        $ty_document_witn_id2 = $dataWitnesse2->tydocument->id;
        $card_version_center_w2 = $dataWitnesse2->cardversioncenter->na_center;
        $card_version_center_w_id2 = $dataWitnesse2->cardversioncenter->id;


        $province = $cardPersonaNew->province->na_prov;
        $province_id = $cardPersonaNew->province->id;
        $directorate = $cardPersonaNew->directorate->na_dire;
        $directorate_id = $cardPersonaNew->directorate->id;
        $center = $cardPersonaNew->center->na_center;
        $center_id = $cardPersonaNew->center->id;
        $blood_type = $cardPersonaNew->blood_type->na_bloodty;
        $blood_type_id = $cardPersonaNew->blood_type->id;

        $nationality_req = $common_data->nationality_req->nationality_na;
        $nationality_father = $common_data->nationality_father->nationality_na;
        $nationality_mother = $common_data->nationality_mother->nationality_na;
        $countrie_birth = $common_data->countrie_birth->countrie_na;
        $province_birth = $common_data->province_birth->na_prov;
        $directorate_pirth = $common_data->directorate_pirth->na_dire;
        $religions = $common_data->religions->na_relig;
        $social_statu = $common_data->social_statu->na_status;
        $social_statu_id = $common_data->social_statu->id;
        $certificate = $common_data->certificate->na_cert;
        $certificate_id = $common_data->certificate->id;
        $specialtie = $common_data->specialtie->na_spec;
        $specialtie_id = $common_data->specialtie->id;
        $profession = $common_data->profession->na_profes;
        $profession_id = $common_data->profession->id;
        $jihat_work = $common_data->jihat_work->na_jihatw;
        $jihat_work_id = $common_data->jihat_work->id;
        $countrie_accom = $common_data->countrie_accom->countrie_na;
        $countrie_accom_id = $common_data->countrie_accom->id;
        $province_accom = $common_data->province_accom->na_prov;
        $province_accom_id = $common_data->province_accom->id;
        $directorate_accom = $common_data->directorate_accom->na_dire;
        $directorate_accom_id = $common_data->directorate_accom->id;
        
        
        return view('requests.show_requests_card_pr',compact(
            'cardPersonaNew',
            'provinces',
            'directorates',
            'blood_types',
            'common_data',
            'dataWitnesse',
            'dataWitnesse2',
            'province',
            'province_id',
            'directorate',
            'directorate_id',
            'center',
            'center_id',
            'blood_type',
            'blood_type_id',
            'nationality_req',
            'nationality_father',
            'nationality_mother',
            'countrie_birth',
            'province_birth',
            'directorate_pirth',
            'religions',
            'religionss',
            'social_statu',
            'certificate',
            'specialtie',
            'profession',
            'jihat_work',
            'countrie_accom',
            'province_accom',
            'directorate_accom',
            'jihat_works',
            'ty_documents',
            'card_version_centers',
            'social_status',
            'social_statu_id',
            'certificate_id',
            'certificates',
            'specialtie_id',
            'specialties',
            'profession_id',
            'professions',
            'jihat_work_id',
            'countrie_accom_id',
            'province_accom_id',
            'directorate_accom_id',
            'countrie_nationalits',
            'jihat_work_w',
            'jihat_work_w_id',
            'ty_document_witn',
            'ty_document_witn_id',
            'card_version_center_w',
            'card_version_center_w_id',
            'jihat_work_w2',
            'jihat_work_w_id2',
            'ty_document_witn2',
            'ty_document_witn_id2',
            'card_version_center_w2',
            'card_version_center_w_id2',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
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
