<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReqChangeDataCommonDa extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function tydatareqchange(){
        return $this->belongsTo(TyDataReqChange::class, 'ty_data_req_change_id');
    }
    public function reqChangeDataCommon(){
        return $this->belongsTo(ReqChangeDataCommon::class);
    }
}
