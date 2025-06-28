<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Repositories\Contracts\JpenjualanRepositoryInterface;
use App\Repositories\Eloquent\JpenjualanRepository;

use Illuminate\Support\Facades\View;
use App\View\Composers\MenuComposer;
use App\Traits\AksesMenuTrait;

use App\Models\Menus;
use App\Models\MenusAction;

class AppServiceProvider extends ServiceProvider
{
    use AksesMenuTrait;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(JpenjualanRepositoryInterface::class, JpenjualanRepository::class);
        View::composer('layouts.navbar-vertical-inject', MenuComposer::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        Gate::before(function ($user, $ability) {
            $this->setGatesAksesMenu();
        });
    }

    private function setGatesAksesMenu() : void
    {
        $actions = MenusAction::orderBy('key', 'asc')
                            ->where(function ($query) {
                                $query->where('Status', 'active');
                            })
                            ->get();

        $getMenus = Menus::orderBy('label', 'asc')
                            ->where(function ($query) {
                                $query->where('Status', 'active')
                                    ->whereNotIn('key', ['dashboard', 'setting_user', 'setting_menu', 'export_data', 'logout']);
                            })
                            ->get();

        foreach ($getMenus as $key => $dataMenus) 
        {
            $keyRoute = $dataMenus->key;

            foreach ($actions as $key => $dataAction) {
                $akses = $this->settingAksesMenu($keyRoute);

                $action = $dataAction->key;
                Gate::define("{$action}_{$keyRoute}", function ($user) use ($akses, $action) {
                    return $akses[$action] ?? false;
                });
            }
        }
    }
}