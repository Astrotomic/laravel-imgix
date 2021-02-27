<?php

namespace Astrotomic\Imgix\Facades;

use Astrotomic\Imgix\ImgixManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Imgix\UrlBuilder source(?string $source = null)
 * @method static string createURL(string $path, array $params = [])
 * @method static string createSrcSet(string $path, array $params = [], array $options = [])
 */
class Imgix extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ImgixManager::class;
    }
}
