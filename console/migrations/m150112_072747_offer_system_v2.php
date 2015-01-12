<?php

use yii\db\Schema;
use yii\db\Migration;

class m150112_072747_offer_system_v2 extends Migration
{
    public function up()
    {
       $this->dropForeignKey('fk0001_userid', 'offer');
       $this->dropForeignKey('fk0002_ticketid', 'offer');
       $this->dropTable('offer');
       // create offer table for offer_sys_v2
       $this->createTable('offer', [
           'id' => 'pk',
           'performer_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "foreign key to users - performers"',
           'ticket_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "foregn key to tickets"',
           'stage' => Schema::TYPE_INTEGER . ' DEFAULT NULL COMMENT "stage agreement in 	bidding process between customer and performer"',
       ],
       'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'
       );
       // FK to user table
       $this->addForeignKey('fk_to_users-performers', 'offer', 'performer_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
       $this->addForeignKey('fk_to_tickets', 'offer', 'ticket_id', 'ticket', 'id', 'RESTRICT', 'RESTRICT');
       // create offer_history for offer_sys_v2
       $this->createTable('offer_history', [
           'id' => 'pk',
           'offer_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "foreign key to offer table"',
           'price' => Schema::TYPE_FLOAT . ' NOT NULL COMMENT "price in current stage"',
           'date' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
           'note' => Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "just annotation"',
       ], 
       'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'
       );
       // FK to offer table 
       $this->addForeignKey('fk_to_offer', 'offer_history', 'offer_id', 'offer', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_to_offer', 'offer_history');
        $this->dropForeignKey('fk_to_tickets', 'offer');
        $this->dropForeignKey('fk_to_users-performers', 'offer');
        $this->dropTable('offer_history');
        $this->dropTable('offer');
       // reborn offer table
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
}
