<?php

namespace Astrotomic\Imgix\View\Components;

use Astrotomic\Imgix\ImgixManager;
use Illuminate\View\Component;

class Imgix extends Component
{
    protected ImgixManager $imgixManager;
    protected string $path;

    protected ?string $source;
    protected ?string $imgWidth;
    protected ?string $imgHeight;

    public function __construct(
        ImgixManager $imgixManager,
        string $path,
        ?string $source = null,
        ?string $width = null,
        ?string $height = null
    )
    {
        $this->imgixManager = $imgixManager;
        $this->path = $path;
        $this->source = $source;
        $this->imgWidth = $width;
        $this->imgHeight = $height;
    }

    public function src(): string
    {
        return $this->imgixManager->source($this->source)->createURL($this->path);
    }

    public function srcSet(string $format = 'webp'): string
    {
        return $this->imgixManager->source($this->source)->createSrcSet($this->path, [
            'fm' => $format,
        ]);
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
