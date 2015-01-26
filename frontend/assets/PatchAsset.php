<?php 
namespace frontend\assets;
use yii\web\AssetBundle;

class PatchAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/patch.css',
    ];
    public $js = [
        //'js/jquery-1.11.1.min.js',
        //'js/patch.js',
        
        //'js/bootstrap-fileinput/js/fileinput.js',
    ];
    public $depends = [
        //'frontend\assets\AppAsset',
    ];
}
?>
    