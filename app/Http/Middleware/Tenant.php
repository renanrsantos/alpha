<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Models\Cadastros\Cliente;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class Tenant {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cliente = Cliente::where('cliconfig',$request->segment(1))->first();  

        if(!$cliente){
            return Redirect::to('/')->withErrors(['message'=>'Cliente "'.$request->segment(1).'" não encontrado']);
        }
        if(!$cliente->cliativo){
            Redirect::to('/')->withErrors(['message'=>'Cliente "'.$request->segment(1).'" desativado']);
        }
        
        Config::set('database.connections.mysql.host', $cliente->clihost);
        Config::set('database.connections.mysql.username', $cliente->cliusername);
        Config::set('database.connections.mysql.password', $cliente->clipassword);
        Config::set('database.connections.mysql.database', $cliente->clidatabase);
        Config::set('app.cliente', $cliente->clinome);

        return $next($request);
    }
}