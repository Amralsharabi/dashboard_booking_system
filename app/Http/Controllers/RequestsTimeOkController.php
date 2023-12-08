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

class RequestsTimeOkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CardPersonaNews = CardPersonaNew::all()->whereNotNull('time_attendees');
        $CardDamageRenewals = CardDamageRenewal::all()->whereNotNull('time_attendees');
        $FamilyCards = FamilyCard::all()->whereNotNull('time_attendees');
        $BirthRestrictions = BirthRestriction::all()->whereNotNull('time_attendees');
        $LogMarriages = LogMarriage::all()->whereNotNull('time_attendees');
        $LogDivorces = LogDivorce::all()->whereNotNull('time_attendees');
        $DeathStatements = DeathStatement::all()->whereNotNull('time_attendees');
        $CorrectionInstRevConstrs = CorrectionInstRevConstr::all()->whereNotNull('time_attendees');
        return view('requests.requests_time_ok',compact(
            'CardPersonaNews',
            'CardDamageRenewals',
            'FamilyCards',
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
