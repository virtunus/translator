<?php

namespace Virtunus\Translator;

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
        $this->rootPath = realpath(__DIR__.'/../');

        $this->mergeConfigFrom($this->rootPath.'/config/v-translator.php', self::NAMESPACE);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
