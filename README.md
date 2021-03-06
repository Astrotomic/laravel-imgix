# Laravel Imgix

[![Latest Version](http://img.shields.io/packagist/v/astrotomic/laravel-imgix.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/astrotomic/laravel-imgix)
[![MIT License](https://img.shields.io/github/license/Astrotomic/laravel-imgix.svg?label=License&color=blue&style=for-the-badge)](https://github.com/Astrotomic/laravel-imgix/blob/master/LICENSE)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge)](https://plant.treeware.earth/Astrotomic/laravel-imgix)
[![Larabelles](https://img.shields.io/badge/Larabelles-%F0%9F%A6%84-lightpink?style=for-the-badge)](https://www.larabelles.com/)

[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/Astrotomic/laravel-imgix/run-tests?style=flat-square&logoColor=white&logo=github&label=Tests)](https://github.com/Astrotomic/laravel-imgix/actions?query=workflow%3Arun-tests)
[![StyleCI](https://styleci.io/repos/313743010/shield)](https://styleci.io/repos/313743010)
[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/laravel-imgix.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/astrotomic/laravel-imgix)

Laravel bindings and facade to generate [imgix](https://imgix.com) URLs and support for multiple sources.

## Installation

You can install the package via composer:

```bash
composer require astrotomic/laravel-imgix
```

## Configuration

First you have to publish the packages configuration file via artisan command.

```bash
php artisan vendor:publish --provider="Astrotomic\Imgix\ImgixServiceProvider"
```

After this you will have a `config/imgix.php` file.
The `default` key which contains the name of your source you want to use by default.
The `sources` key contains an array of your sources keyed by the name/identifier.

Each source must have a `domain`. The other keys are optional and you can even omit them.

```php
return [
    'default' => 'default',

    'sources' => [
        'default' => [
            'domain' => 'example.imgix.net', // domain only - without http(s)
            // 'useHttps' => true, // default is true - you shouldn't change this
            // 'signKey' => null, // your signing key for this domain
            // 'includeLibraryParam' => true, // if you want to remove the `ixlib` param
        ],
        'astrotomic' => [
            'domain' => 'img.astrotomic.info',
            'useHttps' => true,
            'signKey' => 'mySecretSignKey',
            'includeLibraryParam' => false,
        ],
    ],
];
```

## Usage

The package provides a facade and global function you can use to get the pre-configured `\Imgix\UrlBuilder`.

```php
use Astrotomic\Imgix\Facades\Imgix;

Imgix::createURL('my/cool/image.jpg');
// https://example.imgix.net/my/cool/image.jpg?ixlib=php-3.3.0

Imgix::source('astrotomic')->createURL('logo.png');
// https://img.astrotomic.info/logo.png?s=200c1c2065023265285dcbc4eff99955
```

If you don't want to import the facade, you can use the global function which is an alias to the `Imgix::source()` method.

```php
imgix()->createURL('my/cool/image.jpg');
// https://example.imgix.net/my/cool/image.jpg?ixlib=php-3.3.0

imgix('astrotomic')->createURL('logo.png');
// https://img.astrotomic.info/logo.png?s=200c1c2065023265285dcbc4eff99955
```

### Blade component 

There is a Blade component `x-imgix` included in this package:

```html
<x-imgix path="my-image.png" />
```

**Optinal parameters:**

* `source`: use one of the source defined in your `imgix.php` config
* `width`: define the output width
* `height`: define the output height

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/Astrotomic/.github/blob/master/CONTRIBUTING.md) for details. You could also be interested in [CODE OF CONDUCT](https://github.com/Astrotomic/.github/blob/master/CODE_OF_CONDUCT.md).

### Security

If you discover any security related issues, please check [SECURITY](https://github.com/Astrotomic/.github/blob/master/SECURITY.md) for steps to report it.

## Credits

-   [Tom Witkowski](https://github.com/Gummibeer)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment I would highly appreciate you buying the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at [offset.earth/treeware](https://plant.treeware.earth/Astrotomic/laravel-imgix)

Read more about Treeware at [treeware.earth](https://treeware.earth)
