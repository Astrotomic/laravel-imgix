<?php

namespace Astrotomic\Imgix;

use Illuminate\Support\Manager;
use Imgix\UrlBuilder;
use InvalidArgumentException;

class ImgixManager extends Manager
{
    public function source(?string $source = null): UrlBuilder
    {
        return $this->driver($source);
    }

    public function getDefaultDriver(): string
    {
        return config('imgix.default', 'default');
    }

    protected function createDriver($driver): UrlBuilder
    {
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        } elseif($this->config->has("imgix.sources.{$driver}")) {
            return $this->container->make(
                UrlBuilder::class,
                $this->config->get("imgix.sources.{$driver}")
            );
        }

        throw new InvalidArgumentException("Driver [{$driver}] not supported.");
    }
}
