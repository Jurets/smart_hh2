<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
?>
<?php
$breadcrumb_title  = Yii::t('app', 'All Users');
$breadcrumb_title .= ( isset($_GET['cid']) && isset($categories[(int)$_GET['cid']]) ) ? $categories[(int)$_GET['cid']-1]->name : '';
$this->title = $breadcrumb_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="left-column col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="sidebar">
            <?php echo $this->render('//layouts/parts/sidebar', ['categories' => $categories, 'url_add'=>'/user/']) ?>
        </div>
    </div>
    <div class="right-column col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <h1><?php echo $breadcrumb_title?></h1>
    </div>
</div>