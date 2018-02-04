<?php

function callController($controller,$method = 'index',$params = []){
    return app()->make($controller)->callAction($method,$params);
}

function convertParams($params){
    if($params == ''){
        return [];
    }
    $paramsAux = [];
    foreach(explode('&',$params) as $param){
        $key = substr($param, 0, strpos($param, '='));
        $value = substr($param, strpos($param, '='));
        $paramsAux[$key] = $value;
    }
    return $paramsAux;
}

Route::get('/',function(){return view('error.cliente');});

Route::group(['middleware' => ['tenant']], function () {
    Route::group(['middleware'=>['auth']],function(){
        Route::prefix('{cliente}')->group(function () {
            Route::get('/', function () {
                return view('home');
            });
            Route::get('/{modulo}/{rotina}/{params?}',function($cliente,$modulo,$rotina,$params = ''){
                return callController("App\\Http\\Controllers\\".ucfirst($modulo)."\\". ucfirst($rotina)."Controller",'index',convertParams($params));
            });
        });
        
        
    });
    
    Route::get('/{cliente}/login','Auth\LoginController@showLoginForm');
    Route::get('/{cliente}/logout','Auth\LoginController@logout');
    Route::post('/{cliente}/login','Auth\LoginController@login');    
});