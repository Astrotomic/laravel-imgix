<?php

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
