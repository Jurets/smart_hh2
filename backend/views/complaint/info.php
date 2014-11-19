<?php 
use Yii;
use yii\widgets\DetailView;
use yii\helpers\Html;
?>
<?php
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complains'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = Yii::t('app', 'Info');
?>
<?php if(!empty($model)) { ?>
<?php
foreach($model as $i=>$item){
    echo '<hr>';
    echo '<h2>'.($i+1).'</h2>';
    echo DetailView::widget([
        'model' => $item,
        'attributes' =>[
        'ticket_id',
        [
            'label' => Yii::t('app', 'User ID who complains'),
            'value' => $item->from_user_id,
        ],
                'category',
        'message'
        ],
    ]);
    echo '<hr>';
}
?>
<?php }else{ ?>
<h1>No Results</h1>
<?php } ?>

