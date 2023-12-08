<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataWitnesse extends Model
{
    use HasFactory;
    // public $id = false;
    public $timestamps = false;
    protected $guarded=[];
    public function cardpersonanew(){
        return $this->belongsTo(CardPersonaNew::class);
    }
    public function jihat_work(){
        return $this->belongsTo(JihatWork::class, 'jihat_work_id');
    }
    public function tydocument(){
        return $this->belongsTo(TyDocument::class, 'ty_document_witn_id');
    }
    public function cardversioncenter(){
        return $this->belongsTo(CardVersionCenter::class, 'card_version_center_id');
    }
}
