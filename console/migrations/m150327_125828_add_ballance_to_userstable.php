<?php

use yii\db\Schema;
use yii\db\Migration;

class m150327_125828_add_ballance_to_userstable extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'balance', Schema::TYPE_FLOAT . ' DEFAULT NULL COMMENT "users amount balance in site system" AFTER id');
    }

    public function down()
    {
        $this->dropColumn('user', 'balance');
    }
}
