<?php
return [
    'modules' => [
        'sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',

            'urls'=> [
                // your additional urls
                [
                    'loc' => '/',
                    'lastmod' => time(),
                    'priority' => 1,
                ],
                [
                    'loc' => '/all-news',
                    'lastmod' => time(),
                    'priority' => 1,
                ],
                [
                    'loc' => '/all-company',
                    'lastmod' => time(),
                    'priority' => 1,
                ],
                [
                    'loc' => '/all-poster',
                    'lastmod' => time(),
                    'priority' => 1,
                ],
                [
                    'loc' => '/all-poster',
                    'lastmod' => time(),
                    'priority' => 1,
                ],
                [
                    'loc' => '/stream',
                    'lastmod' => time(),
                    'priority' => 1,
                ],
                [
                    'loc' => '/finance',
                    'lastmod' => time(),
                    'priority' => 1,
                ],
                [
                    'loc' => '/finance',
                    'lastmod' => time(),
                    'priority' => 1,
                ],
                [
                    'loc' => '/currency',
                    'lastmod' => time(),
                    'priority' => 1,
                ],
                [
                    'loc' => '/currency/converter',
                    'lastmod' => time(),
                    'priority' => 1,
                ],
            ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
        'news-sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',
            'models' => [
                'frontend\models\sitemap\CategoryNews',
                'frontend\models\sitemap\News',
            ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
        'company-sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',
            'models' => [
                'frontend\models\sitemap\CategoryCompany',
                'frontend\models\sitemap\Company',
            ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
        'poster-sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',
            'models' => [
                'frontend\models\sitemap\CategoryPoster',
                'frontend\models\sitemap\Poster'
            ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
        'stream-sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',
            'models' => [
                'frontend\models\sitemap\Stream'
            ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],

    ],
];