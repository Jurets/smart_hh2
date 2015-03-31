<?php

use yii\db\Schema;
use yii\db\Migration;

class m150331_135307_create_table_withdrawal extends Migration
{
    public function up()
    {
        $this->createTable('withdrawal', [
            'id' => 'pk',
            'data' => Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP',
            'from_user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "fk to user (id)"',
            'method' => Schema::TYPE_TEXT . ' NOT NULL COMMENT "collection from payment_profile by choise value"',
            'amount' => Schema::TYPE_FLOAT . ' NOT NULL COMMENT "amount for withdraw"',
            'completed' => Schema::TYPE_BOOLEAN . ' DEFAULT 0 COMMENT "admin status operation complete"',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->addForeignKey('fk_withdrawal_to_from_user_id', 'withdrawal', 'from_user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
       $this->dropForeignKey('fk_withdrawal_to_from_user_id', 'withdrawal');
       $this->dropTable('withdrawal');
    }
}
