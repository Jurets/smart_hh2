<?php

use yii\db\Schema;
use yii\db\Migration;

class m150116_102812_add_hourly_rate_to_user_profile extends Migration
{
    public function up()
    {
        $this->addColumn('profile', 'hourly_rate', Schema::TYPE_FLOAT.' DEFAULT NULL COMMENT "user hourly rate"');
    }

    public function down()
    {
        $this->dropColumn('profile', 'hourly_rate');
    }
}
