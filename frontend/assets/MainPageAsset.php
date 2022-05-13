<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MainPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.min.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        '/theme/portal-donbassa/css/libs.min.css',
        '/theme/portal-donbassa/css/datepicker.min.css',
        '/theme/portal-donbassa/css/fancybox/jquery.fancybox.min.css',
        '/theme/portal-donbassa/css/fancybox/jquery.fancybox-thumbs.min.css',
        '/theme/portal-donbassa/css/fancybox/jquery.fancybox-buttons.min.css',
//        '/css/lightbox.min.css',
        '/theme/portal-donbassa/css/styles.min.css',

    ];

    /** Подключение js по endBody() */
    public $js = [
        'https://api-maps.yandex.ru/2.1/?lang=ru_RU',
//        '/theme/portal-donbassa/js/countdown.min.js',

//        '/theme/portal-donbassa/js/map.min.js',
        '/theme/portal-donbassa/js/libs.min.js',
        '/theme/portal-donbassa/js/owl.carousel.min.js',
         '/theme/portal-donbassa/js/datepicker.min.js',
         '/theme/portal-donbassa/js/jquery.fancybox.min.js',
         '/theme/portal-donbassa/js/headhesive.min.js',
        '/theme/portal-donbassa/js/jquery.hc-sticky.min.js',
        '/theme/portal-donbassa/js/script.min.js',
        '/theme/portal-donbassa/js/raw/ajax.js',
        '/theme/portal-donbassa/js/raw/ajax-modals.js',

//        '/js/poll_ajax.min.js',
        '/js/comments.min.js',
        '/js/share.min.js',
        '/js/main.min.js',
        '/js/main_page_ajax.min.js',
        '/js/raw/search-missing-person.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
