<?php

namespace Astrotomic\Imgix\Tests;

use Astrotomic\Imgix\ImgixServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ImgixServiceProvider::class,
        ];
    }
}
