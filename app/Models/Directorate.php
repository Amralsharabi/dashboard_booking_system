<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directorate extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded=[];

    // public function province(){
    //     return $this->belongsTo(Province::class, 'province_id');
    // }
    public function province(){
        return $this->belongsTo(Province::class);
    }
    
    public function cardVersionCenter()
    {
        return $this->hasMany(CardVersionCenter::class);
    }
}
