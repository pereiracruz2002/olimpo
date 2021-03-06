<?php

namespace PET\Modules;



class ModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // For each of the registered modules, include their routes and Views
                $modules = config("module.modules");

                while (list(,$module) = each($modules)) {

                    // Load the routes for each of the modules
                    if(file_exists(__DIR__.'/'.$module.'/routes.php')) {
                        include __DIR__.'/'.$module.'/routes.php';
                    }

                    // Load the views
                    if(is_dir(__DIR__.'/'.$module.'/Views')) {
                        $this->loadViewsFrom(__DIR__.'/'.$module.'/Views', $module);
                    }
                }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
