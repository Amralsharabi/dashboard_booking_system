<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogMarriage extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    
    public function user(){
        return $this->hasMany(User::class);
    }
    public function requeststatu(){
        return $this->belongsTo(RequestStatu::class, 'request_statu_id');
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
    public function provincecontract(){
        return $this->belongsTo(Province::class, 'province_contract_id');
    }
    public function directoratecontract(){
        return $this->belongsTo(Directorate::class, 'directorate_contract_id');
    }
}
