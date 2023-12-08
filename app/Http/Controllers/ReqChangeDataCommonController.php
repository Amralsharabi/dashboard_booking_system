<?php

namespace App\Http\Controllers;

use App\Models\ReqChangeDataCommon;
use Illuminate\Http\Request;

class ReqChangeDataCommonController extends Controller
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
     * @param  \App\Models\ReqChangeDataCommon  $reqChangeDataCommon
     * @return \Illuminate\Http\Response
     */
    public function show(ReqChangeDataCommon $reqChangeDataCommon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReqChangeDataCommon  $reqChangeDataCommon
     * @return \Illuminate\Http\Response
     */
    public function edit(ReqChangeDataCommon $reqChangeDataCommon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReqChangeDataCommon  $reqChangeDataCommon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $encrypted_id = request('encrypted_id');
        $id = decrypt($encrypted_id);
        $this->validate($request,[
            'encrypted_id' => 'required'
        ]);
        $ReqChangeDataCommon = ReqChangeDataCommon::find($id);
        $ReqChangeDataCommon->update([
            'request_statu_id' => 3,
        ]);
        return redirect('/requests/change/data')->with('rejected','تم رفض الطلب رقم :'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReqChangeDataCommon  $reqChangeDataCommon
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReqChangeDataCommon $reqChangeDataCommon)
    {
        //
    }
}
