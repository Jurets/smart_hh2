<?php

use yii\db\Schema;
use yii\db\Migration;

class m141111_141147_return_performer_id_into_tickets extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk0001_userid', 'offer');
        $this->dropForeignKey('fk0002_ticketid', 'offer');
        $this->addForeignKey('fk0001_userid', 'offer', 'user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk0002_ticketid', 'offer', 'ticket_id', 'ticket', 'id', 'RESTRICT', 'RESTRICT');
        
        $this->addColumn('ticket', 'performer_id', Schema::TYPE_INTEGER . ' DEFAULT NULL COMMENT "user-choised-worker-id" AFTER user_id');
        $this->addForeignKey('fk0003_return_performer_id', 'ticket', 'performer_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk0003_return_performer_id', 'ticket');
        $this->dropColumn('ticket', 'performer_id');
    }
}
