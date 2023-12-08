<?php

namespace App\Models;

use App\Models\CommonData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReqChangeDataCommon extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    // public function tydatareqchange(){
    //     return $this->belongsTo(TyDataReqChange::class, 'ty_data_req_change_id');
    // }
    public function requeststatu(){
        return $this->belongsTo(RequestStatu::class, 'request_statu_id');
    }
    public function user(){
        return $this->belongsTo(User::class ,'user_id');
    }
    public function reqChangeDataCommonDas(){
        return $this->hasMany(ReqChangeDataCommonDa::class, 'req_change_data_common_id');
    }
}
