<?php

namespace App\Http\Controllers;

use App\Models\CountrieNationalit;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::all();
        return view('provinces.provinces',compact('provinces'));
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
            $this->validate($request,[
                'na_prov' => 'required|max:255|unique:provinces',
            ],[
                'na_prov.required' => 'يرجى إدخال اسم المحافظة',
                'na_prov.unique' => 'خطاء المحافظة مسجلة مسبقاً',
            ]);
            Province::create([
                'na_prov' => $request->na_prov,
                'countrie_nationalit_id' => 1,
            ]);
            return redirect('/provinces')->with('add','تم إضافة المحافظة  بنجاح');
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
    public function update(Request $request)
    {
        $id = $request->id;
        $this->validate($request,[
            'na_prov' => 'required|max:255|unique:provinces,na_prov,'.$id
        ],[
            'na_prov.required' => 'خطاء يرجى  ادخال اسم المحافظة',
            'na_prov.unique' => 'خطاء المحافظة مسجلة مسبقاً',
        ]);
        $provinces = Province::find($id);
        $provinces->update([
            'na_prov' => $request->na_prov,
        ]);
        return redirect('/provinces')->with('updated','تم تعديل المحافظة  بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Province::find($id)->delete();
        return redirect('/provinces')->with('deleted','تم حذف المحافظة  بنجاح');

    }
}
