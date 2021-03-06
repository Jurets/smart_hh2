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
        #'//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css',
        #'//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css',
        'js/jquery-ui-1.11.4.custom/jquery-ui.css', // patch-include jquery-ui styles
        'css/styles.css',
        'css/styles-responsive.css',
        'css/font-open-sans/stylesheet.css',
    ];
    public $js = [
        'js/ddslick.js',
        'jquery.bxslider/jquery.bxslider.min.js',
        '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js',
        'js/engine.js',
        'js/softscroll.js',
        // temporary in this section
        'js/ticket_creation.js',
        'js/googleapi.js',
        'js/cabinet.js',
        'js/complain_script.js',
        'js/profile-jobs.js',
        'js/header-login.js',
        'js/offer-job.js',
        'js/payment_profile_switch.js',
        'js/withdrawals.js',
        'js/dropdown-zip.js',
        'js/lang_popup_fix.js',
        'js/jquery-ui-1.11.4.custom/jquery-ui.js',
        'js/registration-popup.js'
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
