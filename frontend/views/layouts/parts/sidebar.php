<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<ul class="sidebar-holder">
<?php if(is_array($categories)) { ?>
    <li class="<?php echo ( isset($_GET['cid']) ) ? '' : 'active' ?>">
        <?php
        $AllTitle = ( strpos($url_add,'ticket') !== FALSE) ? Yii::t('app', 'All Tasks') : Yii::t('app', 'All Helpers');
            echo Html::a(
                  Html::img(Yii::$app->params['url.categories'].'/AllTask.png', 
                  ['alt'=>'icon']) .
                  $AllTitle,
                  Url::to([$url_add], true)
            );
        ?>
    </li>
    
    <?php foreach($categories as $cat_id=>$category) { ?>
        <?php if($cat_id === 'subcategories') continue;?>
    <li class="<?php echo ( isset($_GET['cid']) && $category->id == $_GET['cid'] ) ? 'active' : '' ?>">
        <?php 
            echo Html::a(
                  Html::img(Yii::$app->params['url.categories'].'/'.$category->picture, ['alt'=>'icon']) .
                  Yii::t('app', $category->name),
                  Url::to([$url_add, 'cid' => $category->id], true)
                  );
        
        ?>
    </li>
    <?php } ?>
<?php } ?>    
</ul>

<?php if(Yii::$app->user->isGuest) { ?>
<a href="<?=Url::to('registration/performer')?>" class="btn btn-big btn-width"><?=Yii::t('app', 'WANNA BE A HELPER'.'?')?></a>
<?php }else{ ?>
<a href="<?=Url::to('/user')?>" class="btn btn-big btn-width"><?=Yii::t('app', 'BROWSE HELPERS')?></a>
<?php }?>

<a href="<?=Url::to(['ticket/create'],true)?>" class="btn btn-big btn-width btn-red"><?=Yii::t('app', 'CREATE A TASK')?></a>
