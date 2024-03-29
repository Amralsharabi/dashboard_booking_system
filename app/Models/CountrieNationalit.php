<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountrieNationalit extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded=[];
    public function province(){
        return $this->hasMany(Province::class);
    }
}
