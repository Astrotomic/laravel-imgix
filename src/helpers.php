<?php

use Astrotomic\Imgix\Facades\Imgix;
use Imgix\UrlBuilder;

if (! function_exists('imgix')) {
    function imgix(?string $source = null): UrlBuilder
    {
        return Imgix::source($source);
    }
}
