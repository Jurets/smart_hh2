<div class="form">
<?php echo CHtml::beginForm(); ?>
 
<div class="row">
<?php echo CHtml::label('Input your Code','code'); ?>
<?php echo CHtml::textField('code'); ?>
</div>
    
<div class="row">
<?php echo CHtml::label("ID",'id'); ?>
<?php echo CHtml::textField('id'); ?>
</div>
 
<div class="row submit">
<?php echo CHtml::submitButton(); ?>
</div>
 
<?php echo CHtml::endForm(); ?>
</div><!-- form -->
