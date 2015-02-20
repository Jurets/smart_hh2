<?php

use yii\db\Schema;
use yii\db\Migration;

class m150220_065828_review_add_ticket_id extends Migration
{
    public function safeUp()
    {
        $this->addColumn('review', 'ticket_id', Schema::TYPE_INTEGER . ' NULL DEFAULT NULL');
        $this->addForeignKey('fk_review_ticket', 'review', 'ticket_id', 'ticket', 'id', 'SET NULL', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_review_ticket', 'review');
        $this->dropColumn('review', 'ticket_id');
    }
}
