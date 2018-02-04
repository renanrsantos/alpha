<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $request;

    public function __construct(\Illuminate\Http\Request $request){
       $this->request = $request;
    }
    
    public function view($view, $data = []){
        $modulo = $this->request->route('modulo');
        $rotina = $this->request->route('rotina');
        
        return view($view,$data, compact('modulo','rotina'));
    }
    
    public function index($params = []){
        return $this->view('layouts.index',['params'=>$params]);
    }
    
    public function dataTablesColumns(){
        return [];
    }
    
    public function dataTablesData(){
        return ['teste'=>1];
    }
}
