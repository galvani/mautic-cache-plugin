<?php

/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

return [
    'routes' => [
        'main' => [],
        'public' => [],
        'api' => []
    ],
    'menu' => [],
    'services' => [
        'events' => [],
        'forms' => [],
        'helpers' => [],
        'menus' => [],
        'other' => [
            'mautic.cache.provider' => [
                'class' => \MauticPlugin\MauticCacheBundle\Cache\CacheProvider::class,
                'arguments' => [
                ]
            ],
            'mautic.cache.adapter.filesystem' => [
                'class' => \MauticPlugin\MauticCacheBundle\Cache\Adapter\FilesystemAdapter::class,
                'arguments' => [
                    '%mautic.cache_prefix%',
                    '%mautic.cache_lifetime%',
                    '%mautic.cache_path%',
                ],
                'tag'  => 'mautic.cache.adapter'
            ]
        ],
        'models' => [],
        'validator' => [],
    ],

    'parameters' => [
        'cache_adapter'        => 'mautic.cache.adapter.filesystem',
        'cache_prefix'         => 'app_cache',
        'cache_lifetime'       => 86400
    ],
];
