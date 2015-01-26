<?php
/* 
 * For use cabinet widget all forms must has :
 * 1) name php-file as a written in signature section
 * 2) data-submitter attribute for js-submit
 * 3) data-render="name_file_of_partial" - which allows to sign a parent block (as wrapper) for render after ajax request
 *  */
use yii\helpers\Html;
?>
<form method="post" action="/user/cabinet" data-render="user-item">
   <input type="hidden" name="signature" value="Spesialites">
   <fieldset>
<!--      <select class="">
          <option></option>
      </select>-->
    <input type="button" class="btn btn-average btn-width" value="SAVE">
   </fieldset>
</form>
