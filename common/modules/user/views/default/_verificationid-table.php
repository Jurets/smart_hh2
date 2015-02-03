<!--
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
            </tr>-->

<?php
use Yii;
?>
            <?php if(!empty($userVerid)) { ?>
              <?php foreach($userVerid as $ind=>$model) { ?>
                <tr>
                    <td class="number-in-order"><?=($ind+1)?></td>
                    <td class="title"><?php echo $model->name .'.'.str_replace('image/','',$model->mimetype)?></td>
                    <td class="image"><?php echo  substr($model->mimetype, 0, strpos($model->mimetype, '/'));?></td>
                    <td class="size"><?php echo round(($model->size/1024),1)?> Kb</td>
                    <td class="size"><?php echo ($model->moderate === 0) ? Yii::t('app', 'under moderate') : Yii::t('app', 'moderated')?></td>
                    <td class="delete">
                        <a data-verid-dell="<?=$model->id?>" href="#" class="delete">
                            <img src="/images/icon-delete.png" alt="delete">
                        </a>
                    </td>
                </tr>
              <?php } ?>
            <?php } ?>