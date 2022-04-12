<?php

namespace Astrotomic\Imgix;

use Astrotomic\Imgix\View\Components\Imgix;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Imgix\UrlBuilder;

class ImgixServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'imgix');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/imgix.php' => config_path('imgix.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/astrotomic/laravel-imgix'),
            ], 'views');
        }

        $this->callAfterResolving(BladeCompiler::class, static function (BladeCompiler $blade): void {
            $blade->component(Imgix::class, 'imgix');
        });
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
