<?php

use yii\db\Schema;
use yii\db\Migration;

class m150218_090230_add_comment_answer_to extends Migration
{
    public function safeUp()
    {
        $this->addColumn('ticket_comments', 'answer_to', Schema::TYPE_INTEGER . ' NULL');
        $this->addForeignKey('fk_ticket_comments_answer_to', 'ticket_comments', 'answer_to', 'ticket_comments', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_ticket_comments_answer_to', 'ticket_comments');
        $this->dropColumn('ticket_comments', 'answer_to');
    }
}
