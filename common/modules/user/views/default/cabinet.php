<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
?>
<?php
$ticket_title = Yii::t('app', 'User Cabinet');
$this->title = $ticket_title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="person-profile row">
    <div class="info-1 col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <?php echo $this->render('_cabinet-user-item', [
            'profile' => $profile,
        ])?>
    </div>

    <div class="info-2 col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <?php echo $this->render('_user-contacts', [
            'profile' => $profile,
        ]) ?>
    </div>   

</div>
<div class="user-cabinet-content">
    
            <?php
            echo $this->render('_cabinet-category-item', [
                'userSpecialities' => $userSpecialities,
            ])
            ?>
 </div>    
     <div class="clearfix"></div>    

</div>       
<section>
    <h1 class="left">My <span class="red">Diplomas</span></h1>
    <a href="#" class="btn btn-average right">NEW LICENSE / DIPLOMA</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Type</th>
                <th>Size</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="number-in-order">1.</td>
                <td class="title">University degree - Bachelor in IT sciences.jpg</td>
                <td class="image">Image</td>
                <td class="size">450 Kb</td>
                <td class="delete"><a href="#" class="delete"/><img src="/images/icon-delete.png" alt="delete"/></a></td>
            </tr>
            <tr>
                <td class="number-in-order">1.</td>
                <td class="title">University degree - Bachelor in IT sciences.jpg</td>
                <td class="image">Image</td>
                <td class="size">450 Kb</td>
                <td class="delete"><a href="#" class="delete"/><img src="/images/icon-delete.png" alt="delete"/></a>    </td>
            </tr>
            <tr>
                <td class="number-in-order">1.</td>
                <td class="title">University degree - Bachelor in IT sciences.jpg</td>
                <td class="image">Image</td>
                <td class="size">450 Kb</td>
                <td class="delete"><a href="#" class="delete"/><img src="/images/icon-delete.png" alt="delete"/></a>    </td>
            </tr>
            <tr>
                <td class="number-in-order">1.</td>
                <td class="title">University degree - Bachelor in IT sciences.jpg</td>
                <td class="image">Image</td>
                <td class="size">450 Kb</td>
                <td class="delete"><a href="#" class="delete"/><img src="/images/icon-delete.png" alt="delete"/></a>    </td>
            </tr>
        </tbody>
    </table>
</section>
<section>
    <h1 class="left">My <span class="red">Verification Docs</span></h1>
    <a href="#" class="btn btn-average right">NEW DOCUMENT</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Type</th>
                <th>Size</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="number-in-order">1.</td>
                <td class="title">Password</td>
                <td class="image">Image</td>
                <td class="size">450 Kb</td>
                <td class="delete"><a href="#" class="delete"/><img src="/images/icon-delete.png" alt="delete"/></a>    </td>
            </tr>
            <tr>
                <td class="number-in-order">1.</td>
                <td class="title">Driver License</td>
                <td class="image">Image</td>
                <td class="size">450 Kb</td>
                <td class="delete"><a href="#" class="delete"/><img src="/images/icon-delete.png" alt="delete"/></a>    </td>
            </tr>                                                                       
        </tbody>
    </table>
</section>



<div class="clear"></div>