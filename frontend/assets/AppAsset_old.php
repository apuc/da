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
class AppAsset_old extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        /*'css/site.css',*/
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
        'theme/portal-donbassa_second/css/jquery.fancybox.css',
        'theme/portal-donbassa_second/css/jquery.fancybox-buttons.css',
        'theme/portal-donbassa_second/css/jquery.fancybox-thumbs.css',
        'theme/portal-donbassa_second/css/datepicker.min.css',
        'css/lightbox.css',
        'theme/portal-donbassa_second/css/jquery-ui.min.css',
        'theme/portal-donbassa_second/css/style.min.css',
    ];
    public $js = [
        'theme/portal-donbassa_second/js/jquery.mousewheel-3.0.6.pack.js',
        'theme/portal-donbassa_second/js/jquery.fancybox.pack.js',
        'theme/portal-donbassa_second/js/jquery.fancybox-buttons.js',
        'theme/portal-donbassa_second/js/jquery.fancybox-media.js',
        'theme/portal-donbassa_second/js/flipclock.min.js',
        'theme/portal-donbassa_second/js/datepicker.min.js',
        'js/lightbox.js',
        'theme/portal-donbassa_second/js/script.min.js',
        'theme/portal-donbassa_second/js/script.js',
        'theme/portal-donbassa_second/js/jquery-ui.min.js',
        '//vk.com/js/api/openapi.js?133',
        '//api-maps.yandex.ru/2.1/?lang=ru_RU',
        'js/map.js',
        'js/yandex_options.js',
        'js/jquery.columnlist.js',
        'js/poll_ajax.js',
        'js/script.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
