<?php

namespace Astrotomic\Imgix\Tests;

use Astrotomic\Imgix\Facades\Imgix;
use Imgix\UrlBuilder;

class ImgixHelperTest extends TestCase
{
    /** @test */
    public function it_returns_default_url_builder(): void
    {
        $imgix = imgix();

        $this->assertInstanceOf(UrlBuilder::class, $imgix);
        $this->assertStringStartsWith('https://example.imgix.net/my/cool/image.jpg?ixlib=php-', $imgix->createURL('my/cool/image.jpg'));
    }

    /** @test */
    public function it_returns_requested_url_builder(): void
    {
        $imgix = imgix('astrotomic');

        $this->assertInstanceOf(UrlBuilder::class, $imgix);
        $this->assertSame('https://img.astrotomic.info/my/cool/image.jpg?s=cab11bba2eb7a640e8f597778b9bb3b6', $imgix->createURL('my/cool/image.jpg'));
    }
}
