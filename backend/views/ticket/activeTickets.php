<?php
/*
 * to display active tickets
 */
use backend\assets\ActiveTicketAsset;
ActiveTicketAsset::register($this);
?>
<?php if(!empty($tickets)) { 
     
?>
<?php foreach($tickets as $ticket) { ?>
<div>
        <hr>
        <p>Info about ticket with ID - <span class="id-ticket"><?php echo $ticket['id']?></span></p>
        <ul>
            <li>ID - <?php echo $ticket['id'] ?></li>
            <li>Price - <?php echo $ticket['price'] ?></li>
            <li>Description - <?php echo $ticket['description'] ?></li>
            <label><b>If you get a system key from employer, type system key here:</b></label>
            <input class="input input-medium" type="text" placeholder="type system key" />
            <a class="btn btn-danger complate-ticket" href="#"> Complete the work  </a>
        </ul>
        <hr>
</div>
<?php } ?>
<?php }else{ ?>
<hr>
<h2>No active Tickets found </h2>
<hr>
<?php } ?>
