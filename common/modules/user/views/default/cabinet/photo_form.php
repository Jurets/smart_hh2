<?php
use kartik\widgets\FileInput;
?>
<form id="phf" method="post" enctype="multipart/form-data" action="/user/popup_runtime" data-render="user-item">
    <input type="hidden" name="signature" value="PhotoUploads">
    <fieldset>
        <?php
        echo FileInput::widget([
            'name' => 'photoFile',
            'options' => [
                'multiple' => false,
            ],
            'pluginOptions' => [
                'showPreview' => true,
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
            ],
        ]);
        ?>
        <input type="button" data-submitter="" class="btn btn-average btn-width" value="SAVE">
    </fieldset>
</form>
