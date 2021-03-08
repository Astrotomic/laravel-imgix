<?php

namespace Astrotomic\Imgix\Tests;

use Illuminate\Support\Facades\View;
use Astrotomic\Imgix\ImgixServiceProvider;
use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [ImgixServiceProvider::class];
    }

    protected function blade(string $template, array $data = []): string
    {
        $tempDirectory = sys_get_temp_dir();

        if (! in_array($tempDirectory, View::getFinder()->getPaths())) {
            View::addLocation(sys_get_temp_dir());
        }

        $tempFile = tempnam($tempDirectory, 'laravel-blade').'.blade.php';

        file_put_contents($tempFile, $template);

        return View::make(Str::before(basename($tempFile), '.blade.php'), $data)->render();
    }
}
