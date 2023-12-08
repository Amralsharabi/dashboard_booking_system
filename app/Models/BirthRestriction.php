<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BirthRestriction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    protected $table = 'birth_restrictions';
    public function user(){
        return $this->hasMany(User::class);
    }
    public function requeststatu(){
        return $this->belongsTo(RequestStatu::class, 'request_statu_id');
    }
    public function birthtyp(){
        return $this->belongsTo(BirthTyp::class, 'birth_type_id');
    }
    public function generatedwho(){
        return $this->belongsTo(GeneratedWho::class, 'birth_type_id');
    }
    public function placebirth(){
        return $this->belongsTo(PlaceBirth::class, 'birth_type_id');
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
    public function countrieparthfather(){
        return $this->belongsTo(CountrieNationalit::class, 'countrie_parth_fath_id');
    }
    public function provinceparthfather(){
        return $this->belongsTo(Province::class, 'province_parth_father_id');
    }
    public function directorateparthfather(){
        return $this->belongsTo(Directorate::class, 'directorate_parth_father_id');
    }
    public function countrieaccomfather(){
        return $this->belongsTo(CountrieNationalit::class, 'countrie_accom_fath_id');
    }
    public function provinceaccomfather(){
        return $this->belongsTo(Province::class, 'prov_accom_fath_id');
    }
    public function directorateaccomfather(){
        return $this->belongsTo(Directorate::class, 'directorate_accom_fath_id');
    }
    public function religionsfath(){
        return $this->belongsTo(Religion::class, 'religions_fath_id');
    }
    public function professionfather(){
        return $this->belongsTo(Profession::class, 'profession_father_id');
    }
    public function tydocumentfath(){
        return $this->belongsTo(TyDocument::class, 'ty_document_fath_id');
    }
    public function cardverscentfath(){
        return $this->belongsTo(CardVersionCenter::class, 'card_vers_cent_fath_id');
    }

    public function countrieparthmother(){
        return $this->belongsTo(CountrieNationalit::class, 'countrie_parth_moth_id');
    }
    public function provinceparthmoth(){
        return $this->belongsTo(Province::class, 'province_parth_moth_id');
    }
    public function directorateparthmoth(){
        return $this->belongsTo(Directorate::class, 'directorate_parth_moth_id');
    }
    public function countrieaccommoth(){
        return $this->belongsTo(CountrieNationalit::class, 'countrie_accom_moth_id');
    }
    public function provinceaccommoth(){
        return $this->belongsTo(Province::class, 'prov_acom_moth_id');
    }
    public function directorateaccommoth(){
        return $this->belongsTo(Directorate::class, 'directorate_acom_moth_id');
    }
    public function religionsmoht(){
        return $this->belongsTo(Religion::class, 'religion_moth_id');
    }
    public function professionmoth(){
        return $this->belongsTo(Profession::class, 'profession_moth_id');
    }
    public function tydocumentmoth(){
        return $this->belongsTo(TyDocument::class, 'ty_document_moth_id');
    }
    public function cardverscentmoth(){
        return $this->belongsTo(CardVersionCenter::class, 'card_vers_cent_moth_id');
    }
}
