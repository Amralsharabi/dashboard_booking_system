<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HusbandWifeData extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function user(){
        return $this->hasMany(User::class);
    }
    public function nationality(){
        return $this->belongsTo(CountrieNationalit::class, 'nationality_id');
    }
    public function countrieparth(){
        return $this->belongsTo(CountrieNationalit::class, 'countrie_parth_id');
    }
    public function provinceparth(){
        return $this->belongsTo(Province::class, 'province_parth_id');
    }
    public function directorateparth(){
        return $this->belongsTo(Directorate::class, 'directorate_parth_id');
    }
    public function countrieacom(){
        return $this->belongsTo(CountrieNationalit::class, 'countrie_acom_id');
    }
    public function provinceacom(){
        return $this->belongsTo(Province::class, 'province_acom_id');
    }
    public function directorateacom(){
        return $this->belongsTo(Directorate::class, 'directorate_acom_id');
    }
    public function religion(){
        return $this->belongsTo(Religion::class, 'religion_id');
    }
    public function profession(){
        return $this->belongsTo(Profession::class, 'profession_id');
    }
    public function social_statu(){
        return $this->belongsTo(SocialStatu::class, 'social_statu_forme_id');
    }
    public function ty_document(){
        return $this->belongsTo(TyDocument::class, 'ty_documents_id');
    }
    public function card_version_center(){
        return $this->belongsTo(CardVersionCenter::class, 'card_version_center_id');
    }
}
