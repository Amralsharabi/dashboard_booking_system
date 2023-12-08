<?php

namespace App\Http\Controllers;

use App\Models\FamilyCard;
use App\Models\DataWitnesse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($encryptedId)
    {
        $id = decrypt($encryptedId);
        $FamilyCard = FamilyCard::findOrFail($id);
        $common_data = FamilyCard::findOrFail($id)->common_data;
        $dataWitnesse = DataWitnesse::where('req_id',$FamilyCard->id)->where('request_type_id',2)->first();
        $dataWitnesse2 = DataWitnesse::where('req_id',$FamilyCard->id)->where('request_type_id',2)->skip(1)->take(1)->first();

        $jihat_work_w = $dataWitnesse->jihat_work->na_jihatw;
        $ty_document_witn = $dataWitnesse->tydocument->na_ty_doc;
        $card_version_center_w = $dataWitnesse->cardversioncenter->na_center;
        
        $jihat_work_w2 = $dataWitnesse2->jihat_work->na_jihatw;
        $ty_document_witn2 = $dataWitnesse2->tydocument->na_ty_doc;
        $card_version_center_w2 = $dataWitnesse2->cardversioncenter->na_center;


        $province = $FamilyCard->province->na_prov;
        $directorate = $FamilyCard->directorate->na_dire;
        $center = $FamilyCard->center->na_center;
        $blood_type = $FamilyCard->blood_type->na_bloodty;

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
        
        return view('requests.print_card_famliy',compact(
            'id',
            'FamilyCard',
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
        $religionss = DB::table('religions')->get();
        
        $FamilyCard = FamilyCard::findOrFail($id);
        $common_data = FamilyCard::findOrFail($id)->common_data;
        $dataWitnesse = DataWitnesse::where('req_id',$FamilyCard->id)->first();
        $dataWitnesse2 = DataWitnesse::where('req_id',$FamilyCard->id)->skip(1)->take(1)->first();

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


        $province = $FamilyCard->province->na_prov;
        $province_id = $FamilyCard->province->id;
        $directorate = $FamilyCard->directorate->na_dire;
        $directorate_id = $FamilyCard->directorate->id;
        $center = $FamilyCard->center->na_center;
        $center_id = $FamilyCard->center->id;
        $blood_type = $FamilyCard->blood_type->na_bloodty;
        $blood_type_id = $FamilyCard->blood_type->id;

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
        
        
        return view('requests.show_requests_card_family',compact(
            'FamilyCard',
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
        ));//
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
