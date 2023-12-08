<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CommonData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = CommonData::where('user_id',Auth::id())->pluck('user_id')->first();
        $provinces = DB::table('provinces')->get();
        $directorates = DB::table('directorates')->get();
        $countrie_nationalits = DB::table('countrie_nationalits')->get();
        $religions = DB::table('religions')->get();
        $social_status = DB::table('social_status')->get();
        $certificates = DB::table('certificates')->get();
        $specialties = DB::table('specialties')->get();
        $professions = DB::table('professions')->get();
        $jihat_works = DB::table('jihat_works')->get();
    
        // if(!empty($user)){
        //         if ($user == Auth::id()) {
        //             return view('index');
        //         }
        // }
        return view('auth.register', compact(
            'provinces',
            'directorates',
            'countrie_nationalits',
            'religions',
            'social_status',
            'certificates',
            'specialties',
            'professions',
            'jihat_works',
            'user',
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
        $this->validate($request,[
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $req_fore_na = request('req_fore_na');
        $req_second_na = request('req_second_na');
        $req_third_na = request('req_third_na');
        $req_tit = request('req_tit');
        
        if (CommonData::where('req_fore_na', $req_fore_na)->where('req_second_na', $req_second_na)->where('req_third_na', $req_third_na)->where('req_tit', $req_tit)->count() > 0) {
            // return back()->with('error', 'معلومات هذا الشخص موجودة مسبقاً');
            return back()->withInput()->withErrors(['message'=>'هناك نفس هذا الاسم بالفعل.']);
            return back()->withErrors(['error'=>'هناك نفس هذا الاسم بالفعل.']);
            
        }else{
    DB::beginTransaction();
    try {
        $userreq_fore_na = CommonData::where('user_id',Auth::id())->pluck('req_fore_na')->first();
        $user = new User();
        $user->req_fore_na = request('req_fore_na');
        $user->email = request('email');
        $user->password = Hash::make(request('password'));
        $user->save();

        CommonData::create([
            'user_id' => $user->id,
            'req_fore_na'=>request('req_fore_na'),
            'req_second_na'=>request('req_second_na'),
            'req_third_na'=>request('req_third_na'),
            'req_tit'=>request('req_tit'),
            'nationality_req_id'=>request('nationality_req_id'),
            'father_fore_na'=>request('father_fore_na'),
            'father_second_na'=>request('father_second_na'),
            'father_third_na'=>request('father_third_na'),
            'father_tit'=>request('father_tit'),
            'nationality_father_id'=>request('nationality_father_id'),
            'mother_fore_na'=>request('mother_fore_na'),
            'mother_second_na'=>request('mother_second_na'),
            'mother_third_na'=>request('mother_third_na'),
            'mother_tit'=>request('mother_tit'),
            'nationality_mother_id'=>request('nationality_mother_id'),
            'gender'=>request('gender'),
            'date_pirth_ad'=>request('date_pirth_ad'),
            'date_pirth_he'=>request('date_pirth_he'),
            'countrie_birth_id'=>request('countrie_birth_id'),
            'province_birth_id'=>request('province_birth_id'),
            'directorate_pirth_id'=>request('directorate_pirth_id'),
            'village_parth'=>request('village_parth'),
            'religions_id'=>request('religions_id'),
            'social_statu_id'=>request('social_statu_id'),
            'learning_condition'=>request('learning_condition'),
            'certificate_id'=>request('certificate_id'),
            'specialtie_id'=>request('specialtie_id'),
            'profession_id'=>request('profession_id'),
            'jihat_work_id'=>request('jihat_work_id'),
            'countrie_accom_id'=>request('countrie_accom_id'),
            'province_accom_id'=>request('province_accom_id'),
            'directorate_accom_id'=>request('directorate_accom_id'),
            'village_accom'=>request('village_accom'),
            'neigh_accom'=>request('neigh_accom'),
            'street_accom'=>request('street_accom'),
            'house_accom'=>request('house_accom'),
            'num_phone'=>request('num_phone'),


        ]);
        DB::commit();
        event(new Registered($user));
        $this->guard()->login($user);
        // return redirect()->route('form_card_pers.index');
        return redirect()->route('home')->with('success', 'تم انشاء الحساب بنجاح');

    } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'message' => 'An error occurred while processing your request. Please try again later.'
        ], 500);
    }
}
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
