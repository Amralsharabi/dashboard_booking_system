<?php

namespace App\Http\Controllers;

use App\Models\CommonData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReqChangeDataCommon;

class CommonDataController extends Controller
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
    public function edit($encryptedId)
    {
        $id = decrypt($encryptedId);
        $countrie_nationalits = DB::table('countrie_nationalits')->get();
        $religions = DB::table('religions')->get();
        $provinces = DB::table('provinces')->get();
        $directorates = DB::table('directorates')->get();
        $ReqChangeDataCommons = ReqChangeDataCommon::with('reqChangeDataCommonDas')
        ->where('id', $id)
        ->get();
        return view('requests.edit_data_common',compact(
            'countrie_nationalits',
            'religions',
            'provinces',
            'directorates',
            'ReqChangeDataCommons',
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
        ],[
            'required'=> 'خطاء يرجى تعبئة كل الحقول',
        ]);
        $req_fore_na = request('req_fore_na');
        $req_second_na = request('req_second_na');
        $req_third_na = request('req_third_na');
        $req_tit = request('req_tit');
        $encrypted_commondata_id = request('encrypted_commondata_id');
        $commondata_id = decrypt($encrypted_commondata_id);
        if (CommonData::where('req_fore_na', $req_fore_na)->where('req_second_na', $req_second_na)->where('req_third_na', $req_third_na)->where('req_tit', $req_tit)->where('id','!=',$commondata_id)->count() > 0) {
            $ReqChangeDataCommon = ReqChangeDataCommon::find($id);
            $ReqChangeDataCommon->update([
                'request_statu_id' => 3,
            ]);
            return back()->withInput()->withErrors(['message'=>'تم رفض  الطلب هناك نفس هذا الاسم بالفعل. ']);
            return back()->withErrors(['error'=>' تم رفض الطلب هناك نفس هذا الاسم بالفعل.']);
        }else{
            $CommonData = CommonData::find($commondata_id);
            $CommonData->update([
                'req_fore_na' => $request->req_fore_na,
                'req_second_na' => $request->req_second_na,
                'req_third_na' => $request->req_third_na,
                'req_tit' => $request->req_tit,
                'nationality_req_id' => $request->nationality_req_id,
                'father_fore_na' => $request->father_fore_na,
                'father_second_na' => $request->father_second_na,
                'father_third_na' => $request->father_third_na,
                'father_tit' => $request->father_tit,
                'nationality_father_id' => $request->nationality_father_id,
                'mother_fore_na' => $request->mother_fore_na,
                'mother_second_na' => $request->mother_second_na,
                'mother_third_na' => $request->mother_third_na,
                'mother_tit' => $request->mother_tit,
                'nationality_mother_id' => $request->nationality_mother_id,
                'gender' => $request->gender,
                'date_pirth_ad' => $request->date_pirth_ad,
                'date_pirth_he' => $request->date_pirth_he,
                'countrie_birth_id' => $request->countrie_birth_id,
                'province_birth_id' => $request->province_birth_id,
                'directorate_pirth_id' => $request->directorate_pirth_id,
                'village_parth' => $request->village_parth,
                'religions_id' => $request->religions_id,
            ]);
            $ReqChangeDataCommon = ReqChangeDataCommon::find($id);
            $ReqChangeDataCommon->update([
                'request_statu_id' => 2,
            ]);
            return redirect('/requests/change/data')->with('updated','تم تعديل البيانات  بنجاح');
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
