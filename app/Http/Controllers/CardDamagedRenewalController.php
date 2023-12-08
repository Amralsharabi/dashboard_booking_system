<?php

namespace App\Http\Controllers;

use App\Models\CardDamageRenewal;
use Illuminate\Http\Request;

class CardDamagedRenewalController extends Controller
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
    public function create($encryptedId)
    {
        $id = decrypt($encryptedId);
        $CardDamageRenewal = CardDamageRenewal::findOrFail($id);
        $common_data = CardDamageRenewal::findOrFail($id)->common_data;
        return view('requests.printcarddmag','CardDamageRenewal','common_data','id');
    }

    /** $id = decrypt($encryptedId);
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $id = decrypt($encryptedId);
        
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
        $CardDamageRenewal = CardDamageRenewal::findOrFail($id);
        $common_data = CardDamageRenewal::findOrFail($id)->common_data;
        return view('requests.show_card_damaged_renewal',compact('CardDamageRenewal','common_data'));
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
        $CardDamageRenewal = CardDamageRenewal::findOrFail($id);
        $common_data = CardDamageRenewal::findOrFail($id)->common_data;
        return view('requests.printcarddmag',compact('CardDamageRenewal','common_data','id'));
        // return $common_data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$encryptedId)
    {
        $id = decrypt($encryptedId);
        $CardDamageRenewal = CardDamageRenewal::findOrFail($id);
        $CardDamageRenewal->time_attendees = request('time_attendees');
        $CardDamageRenewal->time_attendees_hijri = request('time_attendees_hijri');
        $CardDamageRenewal->save();
        return redirect()->route('/requests/cards.index')->with('success', 'تمت عملية الحجز بنجاح');
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
