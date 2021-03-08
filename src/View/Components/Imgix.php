<?php

namespace Astrotomic\Imgix\View\Components;

use Astrotomic\Imgix\ImgixManager;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Imgix extends Component implements Renderable, Htmlable
{
    protected ImgixManager $imgix;
    protected string $path;

    protected ?string $source = null;
    protected ?int $width = null;
    protected ?int $height = null;
    protected array $params = [];

    public function __construct(
        ImgixManager $imgix,
        string $path,
        ?string $source = null,
        ?int $width = null,
        ?int $height = null,
        array $params = []
    )
    {
        $this->imgix = $imgix;
        $this->path = $path;
        $this->source = $source;
        $this->width = $width;
        $this->height = $height;
        $this->params = $params;
    }

    public function src(): string
    {
        $params = $this->params;

        if ($this->height) {
            $params['h'] = $this->height;
        }

        if ($this->width) {
            $params['w'] = $this->width;
        }

        return $this->imgix->source($this->source)->createURL($this->path, $params);
    }

    public function srcSet(?string $format = null): string
    {
        $params = $this->params;

        if ($format) {
            $params['fm'] = $format;
        }

        if ($this->height) {
            $params['h'] = $this->height;
        }

        if ($this->width) {
            $params['w'] = $this->width;
        }

        return $this->imgix->source($this->source)->createSrcSet($this->path, $params);
    }

    public function render(): View
    {
        return view('imgix::components.imgix', [
            'width' => $this->width,
            'height' => $this->height,
        ]);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
