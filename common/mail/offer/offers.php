<?php
<h4>Dear {$userName}</h4>
<p>Your ad {$ticketId} ($ticketDescription) responded potential performers.
To view them go to {$referTo}
Best Regards

/*
 * params list:
 * 
 * $userName - through model User as username
 * $ticketId - directly  as ticket_id
 * $ticketDescription - through model Ticket as description
 * $link - just link through project configuration
 * 
 * realisation:
 * 
 * Yii::$app->mailer->compose('offer/offers', [
 * 			'userName' => $userName,
 * 			'ticketId' => $ticketId,
 * 			'ticketDescription' => $ticketDescription,
 * 			'link' => $link,
 * 		])
                        ->setTo($ticket->user->email)
                        ->setSubject('sorry')
                        ->send();
 * */
