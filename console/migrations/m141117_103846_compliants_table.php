<?php

use yii\db\Schema;
use yii\db\Migration;

class m141117_103846_compliants_table extends Migration
{
    public function up()
    {
        $this->createTable('compliant', [
            'id' => 'pk',
            'date_created' => Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP COMMENT "When compliant was create"',
            'from_user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "user id who complains"',
            'to_user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "user id whom complain"',
            'compliant_message' =>  Schema::TYPE_TEXT.' DEFAULT NULL COMMENT "compliants message"',
            'satisfaction' => Schema::TYPE_SMALLINT . ' DEFAULT 0 COMMENT "bann filter: if admin banned him - must be 1"', 
        ]);
        $this->addForeignKey('FK_compliant_fromuserid', 'compliant', 'from_user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_compliant_touserid', 'compliant', 'to_user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
       $this->dropForeignKey('FK_compliant_fromuserid', 'compliant');
       $this->dropForeignKey('FK_compliant_touserid', 'compliant');
       $this->dropTable('compliant');
    }
}
