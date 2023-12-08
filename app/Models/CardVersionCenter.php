<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardVersionCenter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded=[];

    public function province(){
        return $this->belongsTo(Province::class, 'province_id');
    }
    // public function directorate(){
    //     return $this->belongsTo(Directorate::class, 'directorate_id');
    // }
    public function directorate(){
        return $this->belongsTo(Directorate::class);
    }
}
