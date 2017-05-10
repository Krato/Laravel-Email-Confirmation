<?php
namespace Infinety\EmailConfirmation\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class EmailConfirmationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @param Router $router
     */
    public function boot(Router $router)
    {
        $this->loadTranslationsFrom(realpath(__DIR__.'/../../resources/lang'), 'LEC');

        $this->loadViewsFrom(realpath(__DIR__.'/../../resources/views'), 'LEC');

        $router->group([
            'prefix'    => config('email-confirmation.route_prefix', 'confirm'),
            'namespace' => 'Infinety\\EmailConfirmation\\Controllers',
        ], function () {
            if (!$this->app->routesAreCached()) {
                require __DIR__.'/../routes.php';
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
        $this->mergeConfigFrom(__DIR__.'/../../config/email-confirmation.php', 'EmailConfirmation');
        $this->registerResources();
    }

    /**
     * @return void
     */
    protected function registerResources()
    {
        $this->publishes([
            realpath(__DIR__.'/../../config/email-confirmation.php') => config_path('email-confirmation.php'),
        ], 'config');
        $this->publishes([
            realpath(__DIR__.'/../../database/migrations/') => database_path('migrations'),
        ], 'migrations');
        $this->publishes([
            realpath(__DIR__.'/../../resources/views-bs3/') => resource_path('views'),
        ], 'views');
        $this->publishes([
            realpath(__DIR__.'/../../resources/views-bs4/') => resource_path('views'),
        ], 'views4');
        $this->publishes([
            realpath(__DIR__.'/../../resources/lang/') => resource_path('lang'),
        ], 'lang');
    }
}
