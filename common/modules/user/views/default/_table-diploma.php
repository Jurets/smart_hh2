<?php
use Yii;
?>
            <?php if(!empty($userDiploma)) { ?>
              <?php foreach($userDiploma as $ind=>$model) { ?>
                <tr>
                    <td class="number-in-order"><?=($ind+1)?></td>
                    <td class="title"><?php echo $model->name .'.'.str_replace('image/','',$model->mimetype)?></td>
                    <td class="image"><?php echo  substr($model->mimetype, 0, strpos($model->mimetype, '/'));?></td>
                    <td class="size"><?php echo round(($model->size/1024),1)?> Kb</td>
                    <td class="size"><?php echo ($model->moderate === 0) ? Yii::t('app', 'under moderate') : Yii::t('app', 'moderated')?></td>
                    <td class="delete">
                        <a data-diploma-dell="<?=$model->id?>" href="#" class="delete">
                            <img src="/images/icon-delete.png" alt="delete">
                        </a>
                    </td>
                </tr>
              <?php } ?>
            <?php } ?>