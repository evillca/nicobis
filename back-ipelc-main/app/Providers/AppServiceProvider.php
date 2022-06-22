<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; 
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use \App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        //
        Paginator::useBootstrap();
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('Administration');
            $menus = Menu::join('menus_usuario','menus.id_menu', '=', 'menus_usuario.id_menus')
            ->where('menus_usuario.id_usuario',  Auth::id())
            ->get(['menus.*']);

            foreach($menus as $menu)
            {
                $event->menu->add([
                    'text' => $menu->nombre_menu,
                    'url'  => $menu->ruta_menu,
                    'icon' => $menu->icono_menu,
                ]);
            }
            
        });
    }
}
