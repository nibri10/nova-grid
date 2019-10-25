<?php

namespace Nibri10\NovaGrid;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Nibri10\NovaGrid\Http\Middleware\Authorize;
use Laravel\Nova\Fields\Field;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        $this->app->booted(function () {

            Field::macro('size', function ($size = 'w-full') {
                return $this->withMeta(['size' => $size]);
            });
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
