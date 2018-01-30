<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

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
//            $event->menu = new \JeroenNoten\LaravelAdminLte\Menu\Builder;
            $event->menu->add([
                'text'=>'CADASTROS',
                'icon'=>'globe',
                'submenu'=>
                    [
                        [
                            'text' => 'Igrejas',
                            'url' => 'cadastros/igrejas',
                            'icon' => 'building'
                        ],
                    ]
                ]);
//            foreach(Auth::user()->rotinas as $rotina){
//                
//            }
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
