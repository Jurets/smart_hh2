<?php

use yii\db\Schema;
use yii\db\Migration;

class m150429_101759_table_user_before_register extends Migration
{
    public function up()
    {
        $this->createTable('user_beforeregister', [
            'id' => 'pk',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "fk to user id"',
            'stage' => Schema::TYPE_SMALLINT . ' DEFAULT NULL COMMENT "number of stage user registration"',
            'date' => Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP COMMENT "date record creation"',
            'code' => Schema::TYPE_STRING . ' DEFAULT NULL COMMENT " user hash code"',
            'completed' => Schema::TYPE_SMALLINT . ' DEFAULT 0 COMMENT "0 - stage open, 1 - stage closed"',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->addForeignKey('fk-beforereg-to-user-id', 'user_beforeregister', 'user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk-beforereg-to-user-id', 'user_beforeregister');
        $this->dropTable('user_beforeregister');
    }
    
}
