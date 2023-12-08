<?php

namespace App\Http\Controllers;

use App\Models\LogDivorce;
use Illuminate\Http\Request;
use App\Models\HusbandWifeData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogDivorceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countrie_nationalits = DB::table('countrie_nationalits')->get();
        $religions = DB::table('religions')->get();
        $professions = DB::table('professions')->get();
        $card_version_centers = DB::table('card_version_centers')->get();
        $ty_documents = DB::table('ty_documents')->get();
        return view('divorce-form',compact('countrie_nationalits','religions','professions','card_version_centers','ty_documents'));
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
        DB::beginTransaction();
        try {

            $LogDivorce = new LogDivorce();
            $LogDivorce->user_id = Auth::user()->id;
            $LogDivorce->province_id = request('province_id');
            $LogDivorce->directorate_id = request('directorate_id');
            $LogDivorce->center_id = request('center_id');
            $LogDivorce->date_contract_ad = request('date_contract_ad');
            $LogDivorce->date_contract_he = request('date_contract_he');
            $LogDivorce->province_contract_id = request('province_contract_id');
            $LogDivorce->directorate_contract_id = request('directorate_contract_id');
            $LogDivorce->divor_type = request('divor_type');
            $LogDivorce->divorce_reason = request('divorce_reason');
            $LogDivorce->no_births_levi_husw_male = request('no_births_levi_husw_male');
            $LogDivorce->no_births_levi_husw_fem = request('no_births_levi_husw_fem');
            $LogDivorce->no_births_live_wife_male = request('no_births_live_wife_male');
            $LogDivorce->no_births_live_wife_fem = request('no_births_live_wife_fem');
            $LogDivorce->date_marriage = request('date_marriage');
            $LogDivorce->date_marriage_hj = request('date_marriage_hj');
            $LogDivorce->status_wife_after_divo = request('status_wife_after_divo');
            $LogDivorce->Court_na = request('Court_na');
            $LogDivorce->document_no = request('document_no');
            $LogDivorce->date_document = request('date_document');
            $LogDivorce->request_statu_id = '1';
            $LogDivorce->save();

            HusbandWifeData::create([
                'user_id'=>Auth::user()->id,
                'constraint_id'=>$LogDivorce->id,
                'type_constraint'=>'2',
                'type_husb_wife'=>'1',
                'forena'=>request('forena'),
                'secondna'=>request('secondna'),
                'thirdna'=>request('thirdna'),
                'Tit'=>request('Tit'),
                'date_pirth_Ad'=>request('date_pirth_Ad'),
                'date_pirth_hegira'=>request('date_pirth_hegira'),
                'countrie_parth_id'=>request('countrie_parth_id'),
                'province_parth_id'=>request('province_parth_id'),
                'directorate_parth_id'=>request('directorate_parth_id'),
                'village_parth'=>request('village_parth'),
                'countrie_acom_id'=>request('countrie_acom_id'),
                'province_acom_id'=>request('province_acom_id'),
                'directorate_acom_id'=>request('directorate_acom_id'),
                'village_accomm'=>request('village_accomm'),
                'nationality_id'=>request('nationality_id'),
                'religion_id'=>request('religion_id'),
                'profession_id'=>request('profession_id'),
                'educational_level'=>request('educational_level'),
                'age_first_marri'=>request('age_first_marri'),
                'social_statu_forme_id'=>2,
                'former_no'=>request('former_no'),
                'forena_moth'=>request('forena_moth'),
                'secondna_moth'=>request('secondna_moth'),
                'thirdna_moth'=>request('thirdna_moth'),
                'tit_moth'=>request('tit_moth'),
                'no_form_biths_live_male'=>request('no_form_biths_live_male'),
                'no_form_biths_live_female'=>request('no_form_biths_live_female'),
                'ty_documents_id'=>request('ty_documents_id'),
                'card_No'=>request('card_No'),
                'date_card_version'=>request('date_card_version'),
                'card_version_center_id'=>request('card_version_center_id'),
            ]);

            HusbandWifeData::create([
                'user_id'=>Auth::user()->id,
                'constraint_id'=>$LogDivorce->id,
                'type_constraint'=>'2',
                'type_husb_wife'=>'2',
                'forena'=>request('forenaw'),
                'secondna'=>request('secondnaw'),
                'thirdna'=>request('thirdnaw'),
                'Tit'=>request('Titw'),
                'date_pirth_Ad'=>request('date_pirth_Adw'),
                'date_pirth_hegira'=>request('date_pirth_hegiraw'),
                'countrie_parth_id'=>request('countrie_parth_idw'),
                'province_parth_id'=>request('province_parth_idw'),
                'directorate_parth_id'=>request('directorate_parth_idw'),
                'village_parth'=>request('village_parthw'),
                'countrie_acom_id'=>request('countrie_acom_idw'),
                'province_acom_id'=>request('province_acom_idw'),
                'directorate_acom_id'=>request('directorate_acom_idw'),
                'village_accomm'=>request('village_accommw'),
                'nationality_id'=>request('nationality_idw'),
                'religion_id'=>request('religion_idw'),
                'profession_id'=>request('profession_idw'),
                'educational_level'=>request('educational_levelw'),
                'age_first_marri'=>request('age_first_marriw'),
                'social_statu_forme_id'=>2,
                'former_no'=>request('former_now'),
                'forena_moth'=>request('forena_mothw'),
                'secondna_moth'=>request('secondna_mothw'),
                'thirdna_moth'=>request('thirdna_mothw'),
                'tit_moth'=>request('tit_mothw'),
                'no_form_biths_live_male'=>request('no_form_biths_live_malew'),
                'no_form_biths_live_female'=>request('no_form_biths_live_femalew'),
                'ty_documents_id'=>request('ty_documents_idw'),
                'card_No'=>request('card_Now'),
                'date_card_version'=>request('date_card_versionw'),
                'card_version_center_id'=>request('card_version_center_idw'),
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
        $LogDivorce = LogDivorce::findOrFail($id);
        $HusbandData = HusbandWifeData::where('constraint_id',$LogDivorce->id)->where('type_constraint',1)->where('type_husb_wife','1')->first();
        $WifeData = HusbandWifeData::where('constraint_id',$LogDivorce->id)->where('type_constraint',1)->where('type_husb_wife','2')->first();
        return view('requests.print_log_divorce',compact(
            'id',
            'LogDivorce',
            'HusbandData',
            'WifeData',
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
