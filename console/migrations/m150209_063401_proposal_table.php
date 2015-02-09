<?php

use yii\db\Schema;
use yii\db\Migration;

class m150209_063401_proposal_table extends Migration
{
    public function up()
    {
        $this->createTable('proposal', 
        [
            'id' => 'pk',
            'performer_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "fk to user table"',
            'ticket_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "fk to ticket table"',
            'date' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'message' => Schema::TYPE_TEXT . ' DEFAULT NULL COMMENT "proposal text message"',
            'archived' => Schema::TYPE_SMALLINT. ' DEFAULT 0 COMMENT "0-used 1-dont used - archived"',
        ],
                'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->addForeignKey('fk_proposal_to_user', 'proposal', 'performer_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_proposal_to_ticket', 'proposal', 'ticket_id', 'ticket', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_proposal_to_user', 'proposal');
        $this->dropForeignKey('fk_proposal_to_ticket', 'proposal');
        $this->dropTable('proposal');
    }
}
