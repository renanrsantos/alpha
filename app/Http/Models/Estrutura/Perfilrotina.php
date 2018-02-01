<?php

namespace App\Http\Models\Estrutura;

/**
 * Description of Perfilrotina
 *
 * @author renan
 */
class Perfilrotina extends \App\Http\Models\Model{
    protected $fillable = [
        'idrotina','idperfil','idmodulo','perpermissao'
    ];
    
    public function rotina(){
        return $this->belongsTo(Rotina::class,'idrotina');
    }
    
    public function modulo(){
        return $this->belongsTo(Modulo::class,'idmodulo');
    }
}
