<?php

namespace App\Http\Controllers;

use App\Models\CardVersionCenter;
use App\Models\Directorate;
use App\Models\Province;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers = CardVersionCenter::all();
        $provinces = Province::all();
        $directorates = Directorate::all();
        return view('provinces.center',compact('centers','provinces','directorates',));
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
            'na_center' => 'required|max:255|unique:card_version_centers,na_center,province_id,directorate_id',
            'province_id' => 'required|max:255',
            'directorate_id' => 'required|max:255',
        ],[
            'na_center.required' => 'خطاء يرجى  ادخال اسم المركز',
            'na_center.unique' => 'خطاء المركز مسجل مسبقاً',
            'province_id.required' => 'خطاء يرجى  اختيار محافظة',
            'directorate_id.required' => 'خطاء يرجى  اختيار مديرية',
        ]);
        CardVersionCenter::create([
            'na_center' => $request->na_center,
            'province_id' => $request->province_id,
            'directorate_id' => $request->province_id,
        ]);
        return redirect('/center')->with('add','تم إضافة المركز بنجاح');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
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
            'na_center' => 'required|max:255|unique:card_version_centers,na_center,'.$id,
            'province_id' => 'required|max:255',
            'directorate_id' => 'required|max:255',
        ],[
            'na_center.required' => 'خطاء يرجى  ادخال اسم المركز',
            'na_center.unique' => 'خطاء المركز مسجل مسبقاً',
            'province_id.required' => 'خطاء يرجى  اختيار محافظة',
            'directorate_id.required' => 'خطاء يرجى  اختيار مديرية',
        ]);
        $centers = CardVersionCenter::find($id);
        $centers->update([
            'na_center' => $request->na_center,
            'province_id' => $request->province_id,
            'directorate_id' => $request->directorate_id,
        ]);
        return redirect('/center')->with('updated','تم تعديل المركز  بنجاح');
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
        CardVersionCenter::find($id)->delete();
        return redirect('/center')->with('deleted','تم حذف المركز  بنجاح');
    }
}
