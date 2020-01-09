<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Composers\Backend\SidebarComposer;

/**
 * Class ComposerServiceProvider.
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot()
    {
        // Global
        View::composer(
            '*', 'App\Http\ViewComposers\SharedDataViewComposer'
        );
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }
}
