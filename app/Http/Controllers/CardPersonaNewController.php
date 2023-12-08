<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\CommonData;
use App\Models\DataWitnesse;
use Illuminate\Http\Request;
use App\Models\CardPersonaNew;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class CardPersonaNewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = CommonData::where('user_id', Auth::id())->pluck('id')->first();
        $user = User::find(Auth::id())->commondata;
        $user1 = CommonData::find($q);
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

        $nationality_req = $user1->nationality_req->nationality_na;
        $nationality_father = $user1->nationality_father->nationality_na;
        $nationality_mother = $user1->nationality_mother->nationality_na;
        $countrie_birth = $user1->countrie_birth->countrie_na;
        $province_birth = $user1->province_birth->na_prov;
        $directorate_pirth = $user1->directorate_pirth->na_dire;
        $religions = $user1->religions->na_relig;
        $social_statu = $user1->social_statu->na_status;
        $social_statu_id = $user1->social_statu->id;
        $certificate = $user1->certificate->na_cert;
        $certificate_id = $user1->certificate->id;
        $specialtie = $user1->specialtie->na_spec;
        $specialtie_id = $user1->specialtie->id;
        $profession = $user1->profession->na_profes;
        $profession_id = $user1->profession->id;
        $jihat_work = $user1->jihat_work->na_jihatw;
        $jihat_work_id = $user1->jihat_work->id;
        $countrie_accom = $user1->countrie_accom->countrie_na;
        $countrie_accom_id = $user1->countrie_accom->id;
        $province_accom = $user1->province_accom->na_prov;
        $province_accom_id = $user1->province_accom->id;
        $directorate_accom = $user1->directorate_accom->na_dire;
        $directorate_accom_id = $user1->directorate_accom->id;
        

        return view('form_card_pers',compact(
                    'user',
                    'nationality_req',
                    'nationality_father',
                    'nationality_mother',
                    'countrie_birth',
                    'province_birth',
                    'directorate_pirth',
                    'religions',
                    'social_statu',
                    'certificate',
                    'specialtie',
                    'profession',
                    'jihat_work',
                    'countrie_accom',
                    'province_accom',
                    'directorate_accom',
                    'provinces',
                    'directorates',
                    'blood_types',
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
                )
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $user = User::find(Auth::id())->commondata;

            $card = new CardPersonaNew();
            $card->user_id = Auth::user()->id;
            $card->common_data_id = $user->id;
            $card->province_id = request('province_id');
            $card->directorate_id = request('directorate_id');
            $card->blood_type_id = request('blood_type_id');
            $card->request_statu_id = '1';
            $card->save();

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
            DB::commit();
            return redirect()->route('home')->with('success1', 'تم');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'An error occurred while processing your request. Please try again later.'
            ], 500);
        }
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
        $cardPersonaNew = CardPersonaNew::findOrFail($id);
        $common_data = CardPersonaNew::findOrFail($id)->common_data;
        $dataWitnesse = DataWitnesse::where('req_id',$cardPersonaNew->id)->first();
        $dataWitnesse2 = DataWitnesse::where('req_id',$cardPersonaNew->id)->skip(1)->take(1)->first();

        $jihat_work_w = $dataWitnesse->jihat_work->na_jihatw;
        $ty_document_witn = $dataWitnesse->tydocument->na_ty_doc;
        $card_version_center_w = $dataWitnesse->cardversioncenter->na_center;
        
        $jihat_work_w2 = $dataWitnesse2->jihat_work->na_jihatw;
        $ty_document_witn2 = $dataWitnesse2->tydocument->na_ty_doc;
        $card_version_center_w2 = $dataWitnesse2->cardversioncenter->na_center;


        $province = $cardPersonaNew->province->na_prov;
        $directorate = $cardPersonaNew->directorate->na_dire;
        $center = $cardPersonaNew->center->na_center;
        $blood_type = $cardPersonaNew->blood_type->na_bloodty;

        $nationality_req = $common_data->nationality_req->nationality_na;
        $nationality_father = $common_data->nationality_father->nationality_na;
        $nationality_mother = $common_data->nationality_mother->nationality_na;
        $countrie_birth = $common_data->countrie_birth->countrie_na;
        $province_birth = $common_data->province_birth->na_prov;
        $directorate_pirth = $common_data->directorate_pirth->na_dire;
        $religions = $common_data->religions->na_relig;
        $social_statu = $common_data->social_statu->na_status;
        $certificate = $common_data->certificate->na_cert;
        $specialtie = $common_data->specialtie->na_spec;
        $profession = $common_data->profession->na_profes;
        $jihat_work = $common_data->jihat_work->na_jihatw;
        $countrie_accom = $common_data->countrie_accom->countrie_na;
        $province_accom = $common_data->province_accom->na_prov;
        $directorate_accom = $common_data->directorate_accom->na_dire;
        
        return view('requests.print',compact(
            'id',
            'cardPersonaNew',
            'common_data',
            'dataWitnesse',
            'dataWitnesse2',
            'province',
            'directorate',
            'center',
            'blood_type',
            'nationality_req',
            'nationality_father',
            'nationality_mother',
            'countrie_birth',
            'province_birth',
            'directorate_pirth',
            'religions',
            'social_statu',
            'certificate',
            'specialtie',
            'profession',
            'jihat_work',
            'countrie_accom',
            'province_accom',
            'directorate_accom',
            'jihat_work_w',
            'ty_document_witn',
            'card_version_center_w',
            'jihat_work_w2',
            'ty_document_witn2',
            'card_version_center_w2',
        ));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($encryptedId)
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
        
        $cardPersonaNew = CardPersonaNew::findOrFail($id);
        $common_data = CardPersonaNew::findOrFail($id)->common_data;
        $dataWitnesse = DataWitnesse::where('req_id',$cardPersonaNew->id)->first();
        $dataWitnesse2 = DataWitnesse::where('req_id',$cardPersonaNew->id)->skip(1)->take(1)->first();

        $jihat_work_w = $dataWitnesse->jihat_work->na_jihatw;
        $jihat_work_w_id = $dataWitnesse->jihat_work->id;
        $ty_document_witn = $dataWitnesse->tydocument->na_ty_doc;
        $ty_document_witn_id = $dataWitnesse->tydocument->id;
        $card_version_center_w = $dataWitnesse->cardversioncenter->na_centrer;
        $card_version_center_w_id = $dataWitnesse->cardversioncenter->id;
        
        $jihat_work_w2 = $dataWitnesse2->jihat_work->na_jihatw;
        $jihat_work_w_id2 = $dataWitnesse2->jihat_work->id;
        $ty_document_witn2 = $dataWitnesse2->tydocument->na_ty_doc;
        $ty_document_witn_id2 = $dataWitnesse2->tydocument->id;
        $card_version_center_w2 = $dataWitnesse2->cardversioncenter->na_centrer;
        $card_version_center_w_id2 = $dataWitnesse2->cardversioncenter->id;


        $province = $cardPersonaNew->province->na_prov;
        $province_id = $cardPersonaNew->province->id;
        $directorate = $cardPersonaNew->directorate->na_dire;
        $directorate_id = $cardPersonaNew->directorate->id;
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
        
        
        return view('edit_form_card_pers',compact(
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
            'blood_type',
            'blood_type_id',
            'nationality_req',
            'nationality_father',
            'nationality_mother',
            'countrie_birth',
            'province_birth',
            'directorate_pirth',
            'religions',
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encryptedId)
    {
        $id = decrypt($encryptedId);
        DB::beginTransaction();
        try {
            $cardPersonaNew = CardPersonaNew::findOrFail($id);
            $cardPersonaNew->province_id = request('province_id');
            $cardPersonaNew->directorate_id = request('directorate_id');
            $cardPersonaNew->blood_type_id = request('blood_type_id');
            $cardPersonaNew->save();
            
            $common_data = CardPersonaNew::findOrFail($id)->common_data;
            $common_data->social_statu_id = request('social_statu_id');
            $common_data->learning_condition = request('learning_condition');
            $common_data->certificate_id = request('certificate_id');
            $common_data->specialtie_id = request('specialtie_id');
            $common_data->jihat_work_id = request('jihat_work_id');
            $common_data->profession_id = request('profession_id');
            $common_data->countrie_accom_id = request('countrie_accom_id');
            $common_data->province_accom_id = request('province_accom_id');
            $common_data->directorate_accom_id = request('directorate_accom_id');
            $common_data->village_accom = request('village_accom');
            $common_data->neigh_accom = request('neigh_accom');
            $common_data->street_accom = request('street_accom');
            $common_data->house_accom = request('house_accom');
            $common_data->num_phone = request('num_phone');
            $common_data->save();
            
            $dataWitnesse = DataWitnesse::where('req_id',$cardPersonaNew->id)->first();
            $dataWitnesse->foreNa_witn = request('foreNa_witn');
            $dataWitnesse->secondNa_witn = request('secondNa_witn');
            $dataWitnesse->thirdNa_witn = request('thirdNa_witn');
            $dataWitnesse->tit_witn = request('tit_witn');
            $dataWitnesse->work_head_witn = request('work_head_witn');
            $dataWitnesse->jihat_work_id = request('jihat_work_id_w');
            $dataWitnesse->phone_witn = request('phone_witn');
            $dataWitnesse->ty_document_witn_id = request('ty_document_witn_id');
            $dataWitnesse->card_id = request('card_id');
            $dataWitnesse->card_version_center_id = request('card_version_center_id');
            $dataWitnesse->date_card_issuance = request('date_card_issuance');
            $dataWitnesse->address_witn = request('address_witn');
            $dataWitnesse->save();

            $dataWitnesse2 = DataWitnesse::where('req_id',$cardPersonaNew->id)->skip(1)->take(1)->first();
            $dataWitnesse2->foreNa_witn = request('foreNa_witn2');
            $dataWitnesse2->secondNa_witn = request('secondNa_witn2');
            $dataWitnesse2->thirdNa_witn = request('thirdNa_witn2');
            $dataWitnesse2->tit_witn = request('tit_witn2');
            $dataWitnesse2->work_head_witn = request('work_head_witn2');
            $dataWitnesse2->jihat_work_id = request('jihat_work_id_w2');
            $dataWitnesse2->phone_witn = request('phone_witn2');
            $dataWitnesse2->ty_document_witn_id = request('ty_document_witn_id2');
            $dataWitnesse2->card_id = request('card_id2');
            $dataWitnesse2->card_version_center_id = request('card_version_center_id2');
            $dataWitnesse2->date_card_issuance = request('date_card_issuance2');
            $dataWitnesse2->address_witn = request('address_witn2');
            $dataWitnesse2->save();

            DB::commit();
            return redirect()->route('demand_mang.index')->with('updated', 'تم تعديل الطلب بنجاح');

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'An error occurred while processing your request. Please try again later.'
            ], 500);
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
        CardPersonaNew::destroy($id);
        return redirect()->route('demand_mang.index')->with('deleted','تم إلغاء الطلب بنجاح');
    }
}
