<?php

use yii\db\Schema;
use yii\db\Migration;

class m150211_065352_create_table_comments extends Migration
{
    public function safeUp()
    {
        $this->createTable('ticket_comments', [
            'id' => 'pk',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "user who wrote the comment"',
            'ticket_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "ticket which was commented"',
            'text' => Schema::TYPE_TEXT . ' NOT NULL COMMENT "comment text"',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0 COMMENT "0-new 1-read"',
            'date' => Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP COMMENT "when this comment was created"'
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        
        $this->addForeignKey('fk_ticket_comments_user', 'ticket_comments', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_ticket_comments_ticket', 'ticket_comments', 'ticket_id', 'ticket', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('ticket_comments');
    }
}
