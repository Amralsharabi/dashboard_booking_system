<?php

namespace App\Http\Controllers;

use App\Models\BirthRestriction;
use App\Models\FamilyCard;
use Illuminate\Http\Request;
use App\Models\CardPersonaNew;
use App\Models\CardDamageRenewal;
use App\Models\CorrectionInstRevConstr;
use App\Models\DeathStatement;
use App\Models\LogDivorce;
use App\Models\LogMarriage;

class RequestsCancelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CardPersonaNews = CardPersonaNew::onlyTrashed()->get();
        $CardDamageRenewals = CardDamageRenewal::onlyTrashed()->get();
        $FamilyCards = FamilyCard::onlyTrashed()->get();
        $BirthRestrictions = BirthRestriction::onlyTrashed()->get();
        $LogMarriages = LogMarriage::onlyTrashed()->get();
        $LogDivorces = LogDivorce::onlyTrashed()->get();
        $DeathStatements = DeathStatement::onlyTrashed()->get();
        $CorrectionInstRevConstrs = CorrectionInstRevConstr::onlyTrashed()->get();
        return view('requests.requests_cancel',compact('CardPersonaNews',
        'FamilyCards','CardDamageRenewals',
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
