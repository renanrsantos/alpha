<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Models\Cadastros;

/**
 * Description of Cliente
 *
 * @author renan
 */
class Cliente extends \App\Http\Models\Model{
    protected $connection = 'alpha';
    
    protected $fillable = [
        'clinome','cliconfig','clihost','clipassword','cliusername','clidatabase'
    ];
}
