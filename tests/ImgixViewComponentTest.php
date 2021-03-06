<?php

declare(strict_types=1);

namespace Astrotomic\Imgix\Tests;

use Astrotomic\Imgix\ImgixManager;
use Astrotomic\Imgix\View\Components\Imgix;

class ImgixViewComponentTest extends TestCase
{
    /** @test  */
    public function it_can_get_src_with_default_source(): void
    {
        $component = new Imgix(resolve(ImgixManager::class), 'my-demo-image.png');

        $this->assertTrue((bool) strpos($component->src(), config('imgix.sources.default.domain')));
        $this->assertTrue((bool) filter_var($component->src(), FILTER_VALIDATE_URL));
    }

    /** @test  */
    public function it_can_get_src_with_custom_source(): void
    {
        $component = new Imgix(resolve(ImgixManager::class), 'my-demo-image.png', 'astrotomic');

        $this->assertStringContainsString(config('imgix.sources.astrotomic.domain'), $component->src());
        $this->assertTrue((bool) filter_var($component->src(), FILTER_VALIDATE_URL));
    }

    /** @test  */
    public function it_can_get_srcset_with_different_formats(): void
    {
        $component = new Imgix(resolve(ImgixManager::class), 'my-demo-image.png');

        $this->assertStringContainsString('webp', $component->srcSet());
        $this->assertStringContainsString('png', $component->srcSet('png'));
        $this->assertStringContainsString('jpg', $component->srcSet('jpg'));
        $this->assertStringContainsString('jm2', $component->srcSet('jm2'));
    }
}
