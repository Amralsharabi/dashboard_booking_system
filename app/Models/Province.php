<?php

namespace App\Models;

use App\Models\CountrieNationalit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded=[];

    // public function countrienationalit(){
    //     return $this->belongsTo(CountrieNationalit::class, 'countrie_nationalit_id');
    // }
    public function countrieNationalit(){
        return $this->belongsTo(CountrieNationalit::class);
    }
    public function directorate()
    {
        return $this->hasMany(Directorate::class);
    }
}
