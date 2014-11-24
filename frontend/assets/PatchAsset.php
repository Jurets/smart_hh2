<?php 
namespace frontend\assets;
use yii\web\AssetBundle;

class PatchAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/sidebar-holder-patch.css',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
?>
    