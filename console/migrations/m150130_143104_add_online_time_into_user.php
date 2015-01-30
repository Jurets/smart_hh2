<?php

use yii\db\Schema;
use yii\db\Migration;

class m150130_143104_add_online_time_into_user extends Migration
{
    public function up()
    {
        $this->addColumn('profile', 'online', Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "date-time status user online"');
    }

    public function down()
    {
        $this->dropColumn('profile', 'online');
    }
}
