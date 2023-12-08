<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\BirthTyp;
use App\Models\Province;
use App\Models\ReqStatu;
use App\Models\BloodType;
use App\Models\CommonData;
use App\Models\Profession;
use App\Models\Certificate;
use App\Models\Directorate;
use Illuminate\Http\Request;
use App\Models\CardNewPersona;
use App\Models\CardPersonaNew;
use App\Models\CardVersionCenter;
use App\Models\CountrieNationalit;
use App\Models\DataWitnesse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return $countrienationalit = CountrieNationalit::all()->province;
        $provinces = Province::all();
        foreach ($provinces as $province) {
            $nationality_req = $province->countrienationalit->countrie_na;
        }

        // return $common_data = CardPersonaNew::findOrFail(4)->common_data;

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
