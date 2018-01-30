<?php

namespace App\Http\Models\Cadastros;

/**
 * Description of Perfilusuario
 *
 * @author renan
 */
class Perfilusuario extends \App\Http\Models\Model{
    protected $fillable = ['idusuario','idperfil'];
    
    public function perfil(){
        return $this->belongsTo(Perfil::class,'idperfil');
    }
}
