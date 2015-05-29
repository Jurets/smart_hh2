<?php
/* withdrawal mech */
use yii\helpers\Url;
?>
<div class='user-additional-info' style='margin-right:0px;'>
<?=Yii::t('app', 'BALANCE').' '?>&dollar;
<?= is_null($profile->user->balance) ? 0 : $profile->user->balance?>
</div>
<a href='#' id="withdrawals" class='btn-small'><?=Yii::t('app','withdrawals')?></a>

