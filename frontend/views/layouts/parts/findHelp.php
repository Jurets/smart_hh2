<?php
//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="find-help row">
 <h2><?=Yii::t('app','Find')?><span class="red"><?=Yii::t('app','Help')?></span><br/><span class="small"><?=Yii::t('app','save some time')?></span></h2>
    <div class="find-help-content col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!--<a href="#" class="btn btn-help">Create a Task</a>-->
        <?php
            echo Html::a(
                    Yii::t('app', 'Create a Task'),
                    Url::to(['ticket/create'],true),
                    ['class'=>'btn btn-help']
                    );
        ?>
        <p><?=Yii::t('app', 'Request people to do what you need.')?></p>
        <!--<a href="#" class="btn btn-help">Find a Helper</a>-->
        <?php
            echo Html::a(
                    Yii::t('app', 'Find a Helper'),
                    Url::to(['/user'],true),
                    ['class' => 'btn btn-help']
                    );
        ?>
        <p><?=Yii::t('app', 'Find someone special for you task')?></p>
    </div>

</div>