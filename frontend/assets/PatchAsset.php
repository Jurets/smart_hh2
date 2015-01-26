<?php 
namespace frontend\assets;
use yii\web\AssetBundle;

class PatchAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/patch.css',
    ];
    public $js = [
        'js/patch.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
?>
    
    