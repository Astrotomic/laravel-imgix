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

        $this->assertStringNotContainsString('fm=', $component->srcSet());
        $this->assertStringContainsString('fm=webp', $component->srcSet('webp'));
        $this->assertStringContainsString('fm=png', $component->srcSet('png'));
        $this->assertStringContainsString('fm=jpg', $component->srcSet('jpg'));
        $this->assertStringContainsString('fm=jm2', $component->srcSet('jm2'));
    }

    /** @test  */
    public function it_can_set_width_and_height(): void
    {
        $component = new Imgix(
            resolve(ImgixManager::class), 'my-demo-image.png', 'default', 640, 480
        );

        $this->assertStringContainsString('w=640', $component->src());
        $this->assertStringContainsString('h=480', $component->src());
        $this->assertStringContainsString('w=640', $component->srcSet());
        $this->assertStringContainsString('h=480', $component->srcSet());
    }
}
