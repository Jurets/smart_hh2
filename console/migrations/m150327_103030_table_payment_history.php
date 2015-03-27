<?php

use yii\db\Schema;
use yii\db\Migration;

class m150327_103030_table_payment_history extends Migration
{
    public function up()
    {
        $this->createTable('payment_history', [
            'id' => 'pk',
            'from_user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "foreign key to customers"',
            'to_user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "foregn key to performers"',
            'date' => Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP',
            'type' => Schema::TYPE_SMALLINT . ' NOT NULL COMMENT "1 - income 0 - consumption"',
            'details' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT " foreign key to ticket id bot output - must be ticket title"',
            'amount' => Schema::TYPE_FLOAT . ' NOT NULL COMMENT " how much money performer resieved from customer"'
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->addForeignKey('fk_payment_transaction__cust', 'payment_history', 'from_user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_payment_transaction__perf', 'payment_history', 'to_user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_payment_transaction__ticket', 'payment_history', 'details', 'ticket', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_payment_transaction__cust', 'payment_history');
        $this->dropForeignKey('fk_payment_transaction__perf', 'payment_history');
        $this->dropForeignKey('fk_payment_transaction__ticket', 'payment_history');
        $this->dropTable('payment_history');
    }
}
