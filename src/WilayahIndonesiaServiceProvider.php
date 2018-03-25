<?php namespace Bantenprov\WilayahIndonesia;

use Illuminate\Support\ServiceProvider;
use Bantenprov\WilayahIndonesia\Console\Commands\WilayahIndonesiaCommand;

/**
 * The WilayahIndonesiaServiceProvider class
 *
 * @package Bantenprov\WilayahIndonesia
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class WilayahIndonesiaServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Bootstrap handles
        $this->routeHandle();
        $this->configHandle();
        $this->langHandle();
        $this->viewHandle();
        $this->assetHandle();
        $this->migrationHandle();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('wilayah-indonesia', function ($app) {
            return new WilayahIndonesia;
        });

        $this->app->singleton('command.wilayah-indonesia', function ($app) {
            return new WilayahIndonesiaCommand;
        });

        $this->commands('command.wilayah-indonesia');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'wilayah-indonesia',
            'command.wilayah-indonesia',
        ];
    }

    /**
     * Loading package routes
     *
     * @return void
     */
    protected function routeHandle()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
    }

    /**
     * Loading and publishing package's config
     *
     * @return void
     */
    protected function configHandle()
    {
        $packageConfigPath = __DIR__.'/config/config.php';
        $appConfigPath     = config_path('wilayah-indonesia.php');

        $this->mergeConfigFrom($packageConfigPath, 'wilayah-indonesia');

        $this->publishes([
            $packageConfigPath => $appConfigPath,
        ], 'config');
    }

    /**
     * Loading and publishing package's translations
     *
     * @return void
     */
    protected function langHandle()
    {
        $packageTranslationsPath = __DIR__.'/resources/lang';

        $this->loadTranslationsFrom($packageTranslationsPath, 'wilayah-indonesia');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/wilayah-indonesia'),
        ], 'lang');
    }

    /**
     * Loading and publishing package's views
     *
     * @return void
     */
    protected function viewHandle()
    {
        $packageViewsPath = __DIR__.'/resources/views';

        $this->loadViewsFrom($packageViewsPath, 'wilayah-indonesia');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/wilayah-indonesia'),
        ], 'views');
    }

    /**
     * Publishing package's assets (JavaScript, CSS, images...)
     *
     * @return void
     */
    protected function assetHandle()
    {
        $packageAssetsPath = __DIR__.'/resources/assets';

        $this->publishes([
            $packageAssetsPath => resource_path('assets'),
        ], 'wilayah-indonesia-assets');
    }

    /**
     * Publishing package's migrations
     *
     * @return void
     */
    protected function migrationHandle()
    {
        $packageMigrationsPath = __DIR__.'/database/migrations';

        $this->loadMigrationsFrom($packageMigrationsPath);

        $this->publishes([
            $packageMigrationsPath => database_path('migrations')
        ], 'migrations');
    }
}
