<?php

use yii\db\Schema;
use yii\db\Migration;

class m150331_125859_create_table_payment_profile extends Migration
{
    public function up()
    {
        $this->createTable('payment_profile', [
            'id' => 'pk', 
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "FK to user (id)"',
            'choise' => Schema::TYPE_SMALLINT . ' NOT NULL COMMENT "users payment preference"',
            'ach_routing_number' => Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "ACH routing number v1"',
            'ach_account_number' => Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "ACH account number v1"',
            'ach_account_name' => Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "ACH account name v1"',
            'paypal' => Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "paypal requisit number or email v2"',
            'mailing_address' => Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "mailing address v3"',
            'fullname' => Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "full payee name v3"'
            
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->addForeignKey('fk_payment_profile_to_user', 'payment_profile', 'user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_payment_profile_to_user', 'payment_profile');
        $this->dropTable('payment_profile');
    }
}
