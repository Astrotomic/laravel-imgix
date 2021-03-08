<?php

declare(strict_types=1);

namespace Astrotomic\Imgix\Tests;

use Astrotomic\Imgix\ImgixManager;
use Astrotomic\Imgix\View\Components\Imgix;
use Spatie\Snapshots\MatchesSnapshots;

class ImgixViewComponentTest extends TestCase
{
    use MatchesSnapshots;

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

    /** @test  */
    public function it_can_handle_params(): void
    {
        $params = [
            'crop' => 'edges',
            'fit' => 'crop',
        ];

        $component = new Imgix(
            resolve(ImgixManager::class), 'my-demo-image.png', 'default', 640, 480, $params
        );

        $this->assertStringContainsString('fit=crop', $component->src());
        $this->assertStringContainsString('crop=edges', $component->src());
        $this->assertStringContainsString('fit=crop', $component->srcSet());
        $this->assertStringContainsString('crop=edges', $component->srcSet());

        $params = [];

        $component = new Imgix(
            resolve(ImgixManager::class), 'my-demo-image.png', 'default', 640, 480, $params
        );

        $this->assertStringNotContainsString('fit=crop', $component->src());
        $this->assertStringNotContainsString('crop=edges', $component->src());
        $this->assertStringNotContainsString('fit=crop', $component->srcSet());
        $this->assertStringNotContainsString('crop=edges', $component->srcSet());
    }

    /** @test  */
    public function it_can_render_blade_with_component(): void
    {
        $html = $this->blade(<<<HTML
            <div>
                <x-imgix
                    path="posts/my-cool-blog-post.png"
                    width="768"
                    height="432"
                    :params="['crop' => 'edges', 'fit' => 'crop']"
                    class="rounded"
                    alt="My cool Blog-Post"
                />
                <h1>My cool Blog-Post</h1>
            </div>
        HTML);

        $this->assertMatchesHtmlSnapshot($html);
    }
}
