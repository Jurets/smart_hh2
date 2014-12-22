<?php

//    use frontend\assets\PatchAsset;
//    PatchAsset::register($this);

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;
?>
<?php
$this->title = Yii::t('app', 'All Task');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="left-column col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="sidebar">
            <?= $this->render('/layouts/parts/sidebar', ['categories' => $categories]) ?>
            <a href="#" class="btn btn-big btn-width">WANNA BE A HELPER?</a>
            <a href="#" class="btn btn-big btn-width btn-red">CREATE A TASK</a>
        </div>
    </div>  

    <div class="right-column col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="all-task">
            <h1>ALL Task</h1>
            <?php
            echo $this->render('_search_form', [
                'subcategories' => !empty($categories['subcategories']) ? $categories['subcategories'] : NULL,
            ])
            ?>
            <div class="tasks-holder all-tasks">
                <nav>
                    <?php
                    echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => ''],
                        'itemView' => '_tisket',
                        'viewParams' => [],
                        'summary' => '',
                        'pager' => [
                            'activePageCssClass' => '',
                            'prevPageLabel' => Yii::t('app', '<span class="color:#0d3f67;">' . 'Page:' . '</span>'),
                            'nextPageLabel' => '',
                        ],
                    ])
                    ?>
                </nav>
            </div>
        </div>

    </div>


</div>


<div class="clear"></div>	
