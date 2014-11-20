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
        'http://fonts.googleapis.com/css?family=Montserrat:400,700',
        'jquery.bxslider/jquery.bxslider.css',
        '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css',
        '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css',
        'css/styles.css',
        'css/styles-responsive.css'
    ];
    public $js = [
        'js/ddslick.js',
        'jquery.bxslider/jquery.bxslider.min.js',
        '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js',
        'js/engine.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}