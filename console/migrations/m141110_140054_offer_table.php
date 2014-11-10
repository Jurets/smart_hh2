<?php

use yii\db\Schema;
use yii\db\Migration;

class m141110_140054_offer_table extends Migration
{
    public function up()
    {
        $this->createTable('offer', [
            'id' => 'pk',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "foreign key  thisDB.user.id"',
            'ticket_id' => Schema::TYPE_INTEGER. ' NOT NULL COMMENT "foreign key to thisDB.ticket.id"',
            'price' => Schema::TYPE_FLOAT . ' DEFAULT NULL COMMENT "offer price"',
            'offer_date' => Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP COMMENT "when this record was created"',
            'status_agree' => Schema::TYPE_SMALLINT . ' DEFAULT NULL',
        ],
        'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'
        );
        $this->addForeignKey('fk0001_userid', 'offer', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk0002_ticketid', 'offer', 'ticket_id', 'ticket', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
       $this->dropForeignKey('fk0001_userid', 'offer');
       $this->dropForeignKey('fk0002_ticketid', 'offer');
       $this->dropTable('offer');
    }
}
