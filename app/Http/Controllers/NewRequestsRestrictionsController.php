<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewRequestsRestrictionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = DB::table('provinces')->get();
        $directorates = DB::table('directorates')->get();
        $blood_types = DB::table('blood_types')->get();
        $card_version_centers = DB::table('card_version_centers')->get();
        $countrie_nationalits = DB::table('countrie_nationalits')->get();
        $religions = DB::table('religions')->get();
        $social_status = DB::table('social_status')->get();
        $certificates = DB::table('certificates')->get();
        $specialties = DB::table('specialties')->get();
        $professions = DB::table('professions')->get();
        $jihat_works = DB::table('jihat_works')->get();
        $ty_documents = DB::table('ty_documents')->get();

        return view('requests.new_requests_restrictions', compact(
            'provinces',
            'directorates',
            'blood_types',
            'card_version_centers',
            'countrie_nationalits',
            'social_status',
            'certificates',
            'specialties',
            'professions',
            'jihat_works',
            'religions',
            'ty_documents',
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
