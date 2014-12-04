<?php

use yii\db\Schema;
use yii\db\Migration;

class m141204_192600_ticket_extence extends Migration
{
    public function up()
    {
        $this->dropForeignKey('FK_ticket_category_id', 'ticket');
        $this->createTable('category_bind',
                [
                    'category_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "link to category table"',
                    'ticket_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "link to ticket table"',
                ],
                'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->addPrimaryKey('pk_category_bind', 'category_bind', ['category_id', 'ticket_id']);
        $this->addForeignKey('fk_to_category', 'category_bind', 'category_id', 'category', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_to_ticket', 'category_bind', 'ticket_id', 'ticket', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_to_category', 'category_bind');
        $this->dropForeignKey('fk_to_ticket', 'category_bind');
        $this->dropTable('category_bind');
        $this->addForeignKey('FK_ticket_category_id', 'ticket', 'id_category', 'category', 'id', 'RESTRICT', 'RESTRICT');
    }
}
