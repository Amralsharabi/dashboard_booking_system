<?php

namespace App\Http\Controllers;

use App\Models\DeathStatement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DeathStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id',Auth::id())->first();
        $ty_documents = DB::table('ty_documents')->get();
        $card_version_centers = DB::table('card_version_centers')->get();

        return view('death_statements',compact('user','ty_documents','card_version_centers'));
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
        $user = User::where('id',Auth::id())->first();
        $deathStatement = new DeathStatement();
        $deathStatement->user_id = Auth::user()->id;
        $deathStatement->common_data_id = $user->commondata->id;
        $deathStatement->province_id = request('province_id');
        $deathStatement->directorate_id = request('directorate_id');
        $deathStatement->center_id = request('center_id');
        $deathStatement->date_death = request('date_death');
        $deathStatement->ty_document_id = request('ty_document_id');
        $deathStatement->card_No_decea = request('card_No_decea');
        $deathStatement->date_card_issuance_dec = request('date_card_issuance_dec');
        $deathStatement->card_version_center_id = request('card_version_center_id');
        $deathStatement->request_statu_id = '1';
        $deathStatement->save();
        return redirect()->route('home')->with('success1', 'تم');

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
        $death_statements = DeathStatement::findOrFail($id);
        return view('requests.print_death_statement',compact(
            'id',
            'death_statements',
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
