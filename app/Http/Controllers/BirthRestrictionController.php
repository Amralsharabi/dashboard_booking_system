<?php

namespace App\Http\Controllers;

use App\Models\BirthRestriction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BirthRestrictionController extends Controller
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
        $BirthRestriction = BirthRestriction::findOrFail($id);
        $common_data = BirthRestriction::findOrFail($id)->common_data;


        $province = $BirthRestriction->province->na_prov;
        $directorate = $BirthRestriction->directorate->na_dire;
        $center = $BirthRestriction->center->na_center;

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
        
        return view('requests.print_birth_restriction',compact(
            'id',
            'BirthRestriction',
            'common_data',
            'province',
            'directorate',
            'center',
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
        $jihat_works = DB::table('jihat_works')->get();
        $ty_documents = DB::table('ty_documents')->get();
        $card_version_centers = DB::table('card_version_centers')->get();
        $social_status = DB::table('social_status')->get();
        $certificates = DB::table('certificates')->get();
        $specialties = DB::table('specialties')->get();
        $professions = DB::table('professions')->get();
        $countrie_nationalits = DB::table('countrie_nationalits')->get();
        $religionss = DB::table('religions')->get();
        
        $BirthRestriction = BirthRestriction::findOrFail($id);
        $common_data = BirthRestriction::findOrFail($id)->common_data;

        $province = $BirthRestriction->province->na_prov;
        $province_id = $BirthRestriction->province->id;
        $directorate = $BirthRestriction->directorate->na_dire;
        $directorate_id = $BirthRestriction->directorate->id;
        $center = $BirthRestriction->center->na_center;
        $center_id = $BirthRestriction->center->id;

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
        
        
        return view('requests.show_request__birth_restriction',compact(
            'BirthRestriction',
            'provinces',
            'directorates',
            'common_data',
            'province',
            'province_id',
            'directorate',
            'directorate_id',
            'center',
            'center_id',
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
