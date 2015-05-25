<div class="seo-block-2">
    <?php echo Yii::t('app', 'Find helpers at').':'?><br><br>
    <?php foreach($list as $item){ ?>
    <a href="<?=$item['reference']?>"><?=$item['content']?></a>&nbsp;
    <?php } ?>
</div>
<br><br>