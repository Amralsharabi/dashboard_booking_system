<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardPersonaNew extends Model
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
    public function center(){
        return $this->belongsTo(CardVersionCenter::class, 'center_id');
    }
    public function blood_type(){
        return $this->belongsTo(BloodType::class, 'blood_type_id');
    }

}
