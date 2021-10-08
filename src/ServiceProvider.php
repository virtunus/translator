<?php

namespace Virtunus\Translator;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class ServiceProvider extends SupportServiceProvider
{
    public const NAMESPACE = 'v-translator';

    /**
     * Root path of package
     *
     * @var string
     */
    private $rootPath;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->rootPath = realpath(__DIR__ . '/../');

        $this->mergeConfigFrom($this->rootPath . '/config/v-translator.php', self::NAMESPACE);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadRoutes();
    }

    /**
     * Register the package routes.
     */
    private function loadRoutes(): void
    {
        Route::group($this->routeConfiguration(), function (): void {
            Route::group(['middleware' => 'api'], function (): void {
                $this->loadRoutesFrom($this->rootPath . '/routes/api.php');
            });

            Route::group(['middleware' => 'web'], function (): void {
                $this->loadRoutesFrom($this->rootPath . '/routes/web.php');
            });
        });
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration(): array
    {
        return [
            'namespace' => 'Virtunus\Tips\Http\Controllers',
        ];
    }
}
