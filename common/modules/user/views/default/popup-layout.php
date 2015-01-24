<div class="pop-up pop-up-edit <?=$destinationClass?>">
    <a href="#" class="close">&times;</a>
    <div class="pop-up-errors"></div>
    <p class="title"><?=$title?></p>
    <?php echo (!empty($form)) ? $this->render($form, ['dataSet' => $dataSet]) : ''?>
</div>