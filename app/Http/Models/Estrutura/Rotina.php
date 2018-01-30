<?php

namespace App\Http\Models\Estrutura;

/**
 * Description of Rotina
 *
 * @author renan
 */
class Rotina extends \App\Http\Models\Model{
    protected $fillable = [
        'rotordem','idmodulo','rotnome','rotdescricao','rotpath','roticone'
    ];
    
    public function modulo(){
        return $this->belongsTo(Modulo::class,'idmodulo');
    }
}
