<?php

namespace App\Models;

use App\Models\CountrieNationalit;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Contracts\Auth\Authenticatable;

class CommonData extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function nationality_req(){
        return $this->belongsTo(CountrieNationalit::class, 'nationality_req_id');
    }
    public function nationality_father(){
        return $this->belongsTo(CountrieNationalit::class, 'nationality_father_id');
    }
    public function nationality_mother(){
        return $this->belongsTo(CountrieNationalit::class, 'nationality_mother_id');
    }
    public function countrie_birth(){
        return $this->belongsTo(CountrieNationalit::class, 'countrie_birth_id');
    }
    public function province_birth(){
        return $this->belongsTo(Province::class, 'province_birth_id');
    }
    public function directorate_pirth(){
        return $this->belongsTo(Directorate::class, 'directorate_pirth_id');
    }
    public function religions(){
        return $this->belongsTo(Religion::class, 'religions_id');
    }
    public function social_statu(){
        return $this->belongsTo(SocialStatu::class, 'social_statu_id');
    }
    public function certificate(){
        return $this->belongsTo(Certificate::class, 'certificate_id');
    }
    public function specialtie(){
        return $this->belongsTo(Specialtie::class, 'specialtie_id');
    }
    public function profession(){
        return $this->belongsTo(Profession::class, 'profession_id');
    }
    public function jihat_work(){
        return $this->belongsTo(JihatWork::class, 'jihat_work_id');
    }
    public function countrie_accom(){
        return $this->belongsTo(CountrieNationalit::class, 'countrie_accom_id');
    }
    public function province_accom(){
        return $this->belongsTo(Province::class, 'province_accom_id');
    }
    public function directorate_accom(){
        return $this->belongsTo(Directorate::class, 'directorate_accom_id');
    }
    
    public function Card_persona_new(){
        return $this->belongsTo(CardPersonaNew::class);
    }
    public static function getNames($term)
    {
        return CommonData::where('req_fore_na', 'LIKE', '%'.$term.'%')
            ->orWhere('req_second_na', 'LIKE', '%'.$term.'%')
            ->orWhere('req_third_na', 'LIKE', '%'.$term.'%')
            ->orWhere('req_tit', 'LIKE', '%'.$term.'%')
            ->select(DB::raw("CONCAT(req_fore_na, ' - ',req_second_na, ' - ',req_third_na, ' - ',req_tit) AS value"), 
            // 'req_third_na', 
            // 'req_tit', 
            'nationality_req_id', 
            'father_fore_na', 
            'father_second_na',
            'father_third_na',
            'father_tit',
            'nationality_father_id',
            'mother_fore_na',
            'mother_second_na',
            'mother_third_na',
            'mother_tit',
            'nationality_mother_id',
            'gender',
            'date_pirth_ad',
            'date_pirth_he',
            'countrie_birth_id',
            'province_birth_id',
            'directorate_pirth_id',
            'village_parth',
            'religions_id',
            'social_statu_id',
            'learning_condition',
            'certificate_id',
            'specialtie_id',
            'profession_id',
            'jihat_work_id',
            'countrie_accom_id',
            'province_accom_id',
            'directorate_accom_id',
            'village_accom',
            'neigh_accom',
            'street_accom',
            'house_accom',
            'num_phone',
            'id',
            'user_id',
            )
            ->get();
    }

    public static function getUserData($name)
    {
        return CommonData::where('req_fore_na', $name)->first();
    }

}
