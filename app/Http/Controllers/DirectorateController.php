<?php

namespace App\Http\Controllers;

use App\Models\Directorate;
use App\Models\Province;
use Illuminate\Http\Request;

class DirectorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::all();
        $directorates = Directorate::all();

        return view('provinces.directorate',compact('provinces','directorates'));
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
                'na_dire' => 'required|max:255|unique:directorates,na_dire,province_id',
                'province_id' => 'required|max:255',
            ],[
                'na_dire.required' => 'خطاء يرجى  ادخال اسم المديرية',
                'na_dire.unique' => 'خطاء المديرية مسجلة مسبقاً',
                'province_id.required' => 'خطاء يرجى  اختيار محافظة',
            ]);
            Directorate::create([
                'na_dire' => $request->na_dire,
                'province_id' => $request->province_id,
            ]);
            return redirect('/directorate')->with('add','تم إضافة المديرية  بنجاح');
        
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
            'na_dire' => 'required|max:255|unique:directorates,na_dire,'.$id,
            'province_id' => 'required|max:255',
        ],[
            'na_dire.required' => 'خطاء يرجى  ادخال اسم المديرية',
            'na_dire.unique' => 'خطاء المديرية مسجلة مسبقاً',
            'province_id.required' => 'خطاء يرجى  اختيار محافظة',
        ]);
        $directorates = Directorate::find($id);
        $directorates->update([
            'na_dire' => $request->na_dire,
            'province_id' => $request->province_id,
        ]);
        return redirect('/directorate')->with('updated','تم تعديل المحافظة  بنجاح');
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
        Directorate::find($id)->delete();
        return redirect('/directorate')->with('deleted','تم حذف المديرية  بنجاح');
    }
}
