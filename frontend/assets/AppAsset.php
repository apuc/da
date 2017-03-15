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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        /*'css/site.css',*/
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'theme/portal-donbassa/css/libs.min.css',
        'theme/portal-donbassa/css/datepicker.min.css',
        'theme/portal-donbassa/css/fancybox/jquery.fancybox.css',
        'theme/portal-donbassa/css/fancybox/jquery.fancybox-thumbs.css',
        'theme/portal-donbassa/css/fancybox/jquery.fancybox-buttons.css',
        'theme/portal-donbassa/css/styles.min.css',
    ];
    public $js = [
        'http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU',
        'theme/portal-donbassa/js/jquery-2.1.3.min.js',
        'theme/portal-donbassa/js/libs.min.js',
        'theme/portal-donbassa/js/owl.carousel.min.js',
        'theme/portal-donbassa/js/datepicker.min.js',
        'theme/portal-donbassa/js/fancybox/jquery.fancybox.js',
        'theme/portal-donbassa/js/fancybox/jquery.fancybox-buttons.js',
        'theme/portal-donbassa/js/fancybox/jquery.fancybox-media.js',
        'theme/portal-donbassa/js/fancybox/jquery.fancybox-thumbs.js',
        'theme/portal-donbassa/js/fancybox/jquery.fancybox.pack.js',
        'theme/portal-donbassa/js/script.min.js',
        'theme/portal-donbassa/js/jquery.hc-sticky.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
