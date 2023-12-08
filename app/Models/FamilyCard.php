<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyCard extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public function datawitnesse(){
        return $this->hasMany(DataWitnesse::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }
    public function requeststatu(){
        return $this->belongsTo(RequestStatu::class, 'request_statu_id');
    }

    public function common_data(){
        return $this->belongsTo(CommonData::class, 'common_data_id');
    }
    public function province(){
        return $this->belongsTo(Province::class, 'province_id');
    }
    public function directorate(){
        return $this->belongsTo(Directorate::class, 'directorate_id');
    }

    public function countrieaccomform(){
        return $this->belongsTo(CountrieNationalit::class, 'countrie_accom_form_id');
    }
    public function provinceacomform(){
        return $this->belongsTo(Province::class, 'province_acom_form_id');
    }
    public function directorateacomform(){
        return $this->belongsTo(Directorate::class, 'directorate_acom_form_id');
    }
    public function center(){
        return $this->belongsTo(CardVersionCenter::class, 'center_id');
    }
    public function CardVersionCenter(){
        return $this->belongsTo(CardVersionCenter::class, 'card_version_center_id');
    }
    public function blood_type(){
        return $this->belongsTo(BloodType::class, 'blood_type_id');
    }

}
