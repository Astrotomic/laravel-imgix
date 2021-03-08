<?php /** @var Illuminate\View\ComponentAttributeBag $attributes */ ?>
<?php /** @var Closure $src */ ?>
<?php /** @var Closure $srcSet */ ?>
<?php /** @var int|null $width */ ?>
<?php /** @var int|null $height */ ?>

<picture>
    <source type="image/webp" srcset="{{ $srcSet('webp') }}"/>
    <img
        src="{{ $src() }}"
        srcset="{{ $srcSet() }}"
        @if($width) width="{{ $width }}" @endif
        @if($height) height="{{ $height }}" @endif
        {{ $attributes->merge(['loading' => 'lazy']) }}
    />
</picture>
