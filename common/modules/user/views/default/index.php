<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
?>
<?php
$breadcrumb_title = Yii::t('app', 'All Users');
echo Html::a( Yii::t('app', 'Switch to tickets'), Url::to(['/ticket']), ['class'=>'btn-small'] );
$breadcrumb_title .= ( isset($_GET['cid']) && isset($categories[(int) $_GET['cid']]) ) ? ' ' . $categories[(int) $_GET['cid'] - 1]->name : '';
$this->title = $breadcrumb_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="left-column col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="sidebar">
<?= $this->render('//layouts/parts/sidebar', ['categories' => $categories, 'url_add' => '/user/']) ?>
        </div>
    </div>
    <div class="right-column col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="all-task">
            <h1><?php echo $breadcrumb_title ?></h1>
            <?php
            echo $this->render('_search_form', [
                'subcategories' => !empty($categories['subcategories']) ? $categories['subcategories'] : NULL,
            ])
            ?>
            <div class="user-holder">
                <div class="user-item  info-border row">
                <?php 
                    echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => ''],
                        'itemView' => '_user-item',
                        'viewParams' => [],
                        'summary' => '',
                        'pager' => [
                            'activePageCssClass' => '',
                            'prevPageLabel' => Yii::t('app', '<span class="color:#0d3f67;">' .Yii::t('app',"Page").':' . '</span>'),
                            'nextPageLabel' => '',
                        ],
                    ]);
                ?>
                </div>
            </div>
            <div id="offer-job-pop-up-container">
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>