<?php

namespace Astrotomic\Imgix\Tests;

use Astrotomic\Imgix\Facades\Imgix;
use Imgix\UrlBuilder;

class ImgixManagerTest extends TestCase
{
    /** @test */
    public function it_returns_default_url_builder(): void
    {
        $imgix = Imgix::source();

        $this->assertInstanceOf(UrlBuilder::class, $imgix);
        $this->assertStringStartsWith('https://example.imgix.net/my/cool/image.jpg', $imgix->createURL('my/cool/image.jpg'));
    }

    /** @test */
    public function it_returns_requested_url_builder(): void
    {
        $imgix = Imgix::source('astrotomic');

        $this->assertInstanceOf(UrlBuilder::class, $imgix);
        $this->assertSame('https://img.astrotomic.info/my/cool/image.jpg?s=cab11bba2eb7a640e8f597778b9bb3b6', $imgix->createURL('my/cool/image.jpg'));
    }

    /** @test */
    public function it_can_create_url_with_default_source(): void
    {
        $this->assertStringStartsWith('https://example.imgix.net/my/cool/image.jpg', Imgix::createURL('my/cool/image.jpg'));
    }
}
