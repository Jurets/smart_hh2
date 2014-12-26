<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<ul class="sidebar-holder">
<?php if(is_array($categories)) { ?>
    <li class="<?php echo ( isset($_GET['cid']) ) ? '' : 'active' ?>">
        <?php
            echo Html::a(
                  Html::img(Yii::$app->params['url.categories'].'/AllTask.png', 
                  ['alt'=>'icon']) .
                  Yii::t('app', 'All Tasks'),
                  Url::to(['ticket/'], true)
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
                  Url::to(['ticket/', 'cid' => $category->id], true)
                  );
        
        ?>
    </li>
    <?php } ?>
<?php } ?>    
</ul>
    
<a href="<?=Url::to('registration/performer')?>" class="btn btn-big btn-width"><?=Yii::t('app', 'WANNA BE A HELPER'.'?')?></a>
<a href="<?=Url::to('ticket/create')?>" class="btn btn-big btn-width btn-red"><?=Yii::t('app', 'CREATE A TASK')?></a>