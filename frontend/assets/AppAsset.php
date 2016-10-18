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
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
        'theme/portal-donbassa/css/jquery.fancybox.css',
        'theme/portal-donbassa/css/jquery.fancybox-buttons.css',
        'theme/portal-donbassa/css/jquery.fancybox-thumbs.css',
        'theme/portal-donbassa/css/datepicker.min.css',
        'css/lightbox.css',
        'theme/portal-donbassa/css/style.min.css',
    ];
    public $js = [
        'theme/portal-donbassa/js/jquery.mousewheel-3.0.6.pack.js',
        'theme/portal-donbassa/js/jquery.fancybox.pack.js',
        'theme/portal-donbassa/js/jquery.fancybox-buttons.js',
        'theme/portal-donbassa/js/jquery.fancybox-media.js',
        'theme/portal-donbassa/js/flipclock.min.js',
        'theme/portal-donbassa/js/datepicker.min.js',
        'js/lightbox.js',
        'theme/portal-donbassa/js/script.min.js',
        'theme/portal-donbassa/js/script.js',
        '//vk.com/js/api/openapi.js?133',
        'js/script.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
