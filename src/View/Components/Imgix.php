<?php

namespace Astrotomic\Imgix\View\Components;

use Astrotomic\Imgix\ImgixManager;
use Illuminate\View\Component;

class Imgix extends Component
{
    protected ImgixManager $imgixManager;
    protected string $path;

    protected ?string $source;
    protected ?int $imgWidth;
    protected ?int $imgHeight;
    protected ?array $params;

    public function __construct(
        ImgixManager $imgixManager,
        string $path,
        ?string $source = null,
        ?int $width = null,
        ?int $height = null,
        ?array $params = null
    )
    {
        $this->imgixManager = $imgixManager;
        $this->path = $path;
        $this->source = $source;
        $this->imgWidth = $width;
        $this->imgHeight = $height;
        $this->params = $params;
    }

    public function src(): string
    {
        $params = [];

        if($this->imgHeight) {
            $params['h'] = $this->imgHeight;
        }

        if($this->imgWidth) {
            $params['w'] = $this->imgWidth;
        }

        if($this->params) {
            $params = $params + $this->params;
        }

        return $this->imgixManager->source($this->source)->createURL($this->path, $params);
    }

    public function srcSet(?string $format = null): string
    {
        $params = [];

        if($format) {
            $params['fm'] = $format;
        }

        if($this->imgHeight) {
            $params['h'] = $this->imgHeight;
        }

        if($this->imgWidth) {
            $params['w'] = $this->imgWidth;
        }

        if($this->params) {
            $params = $params + $this->params;
        }

        return $this->imgixManager->source($this->source)->createSrcSet($this->path, $params);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('imgix::components.imgix', [
            'width' => $this->imgWidth,
            'height' => $this->imgHeight,
        ]);
    }
}
