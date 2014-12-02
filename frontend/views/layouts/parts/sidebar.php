<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<ul class="sidebar-holder">
<?php if(is_array($categories)) { ?>
    
    <li><a href="<?php echo Yii::$app->urlManager->baseUrl.'/ticket' ?>"><img src="images/icon-allTask.png" alt="icon"/>All Tasks</a></li>
    
    <?php foreach($categories as $cat_id=>$category) { ?>
    <li>
        <?php if($cat_id === 'subcategories') continue;?>
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
    
