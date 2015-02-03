<?php

use yii\db\Schema;
use yii\db\Migration;

class m150203_171855_add_online_status_to_user_profile extends Migration
{
    public function up()
    {
        $this->addColumn('profile', 'online_status', Schema::TYPE_SMALLINT . ' DEFAULT 0 COMMENT "When user is online - 1 othervise - 0"');
    }

    public function down()
    {
        $this->dropColumn('profile', 'online_status');
    }
}
