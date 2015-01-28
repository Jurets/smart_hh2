<?php
/* 
 * For use cabinet widget all forms must has :
 * 1) name php-file as a written in signature section
 * 2) data-submitter attribute for js-submit
 * 3) data-render="name_file_of_partial" - which allows to sign a parent block (as wrapper) for render after ajax request
 *  */
?>
<form method="post" action="/user/popup_runtime" data-render="user-contact">
   <input type="hidden" name="signature" value="russian">
   <fieldset>
       <input type="text" name="russian" value="<?=$dataSet?>" style="margin-bottom: 15px;">
    <input type="button" data-submitter="" class="btn btn-average btn-width" value="SAVE">
   </fieldset>
</form>