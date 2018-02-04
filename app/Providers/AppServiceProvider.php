<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use \Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            foreach(Auth::user()->getModulos() as $modulo){
                $rotinas = [];
                foreach(Auth::user()->getRotinas($modulo) as $rotina){
                    $rotinas[] = [
                        'text' => $rotina->rotnome,
                        'hint' => $rotina->rotdescricao,
                        'icon' => $rotina->roticone,
                        'url' => $this->app->request->route('cliente').$modulo->modpath.$rotina->rotpath
                    ];
                }
                $event->menu->add([
                    'text'=> $modulo->modnome,
                    'hint'=>$modulo->moddescricao,
                    'icon'=>$modulo->modicone,
                    'submenu'=>$rotinas
                ]);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
