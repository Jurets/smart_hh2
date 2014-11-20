<?php

use yii\db\Schema;
use yii\db\Migration;

class m141118_193615_complaint_table_create extends Migration
{
    public function up()
    {
        $this->createTable('complaint', [
            'id' => 'pk',
            'ticket_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "reffered to the tikets table"',
            'from_user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "reffered to the user table who author of complaint"',
            'category' => Schema::TYPE_STRING . ' NOT NULL COMMENT "category of complaint"',
            'message' => Schema::TYPE_STRING . ' NOT NULL COMMENT "message of complaint"',
            'status' => Schema::TYPE_SMALLINT .' DEFAULT 0 COMMENT "0 - must show othervice - 1"',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->addForeignKey('fk_complaint_ticket', 'complaint', 'ticket_id', 'ticket', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_complaint_fromuser', 'complaint', 'from_user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
       $this->dropForeignKey('fk_complaint_ticket', 'complaint');
       $this->dropForeignKey('fk_complaint_fromuser', 'complaint');
       $this->dropTable('complaint');
    }
}
