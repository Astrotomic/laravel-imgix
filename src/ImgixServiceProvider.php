<?php

namespace Astrotomic\Imgix;

use Astrotomic\Imgix\View\Components\Imgix;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Imgix\UrlBuilder;

class ImgixServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/imgix.php' => config_path('imgix.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'imgix');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/astrotomic/laravel-imgix'),
        ], 'views');

        Blade::component('imgix', Imgix::class);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/imgix.php', 'imgix');

        $this->app->singleton(ImgixManager::class);

        $this->app->bind(UrlBuilder::class, static function (Container $app, array $params): UrlBuilder {
            return new UrlBuilder(
                $params['domain'],
                $params['useHttps'] ?? true,
                $params['signKey'] ?? '',
                $params['includeLibraryParam'] ?? true
            );
        });
    }
}
