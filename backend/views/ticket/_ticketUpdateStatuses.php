<?php foreach($ticketUpdateStatuses as $current) { ?>
<p>USER: <?php echo $current->user_id; ?></p>
<p>Title: <?php echo $current->ticket->title; ?></p>
<p>Description: <?php echo $current->ticket->description; ?></p>
<p>Start day: <?php echo $current->ticket->start_day; ?></p>
<p>Finish day: <?php echo $current->ticket->finish_day; ?></p>
<p>Ticket price: <?php echo $current->ticket->price; ?></p>
<p>Your price: <?php echo $current->price; ?></p>
<hr>
<?php } ?>